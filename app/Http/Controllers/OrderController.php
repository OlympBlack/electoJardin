<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Shipping;
use App\User;
use PDF;
use Notification;
use Helper;
use Illuminate\Support\Str;
use App\Notifications\StatusNotification;
use App\Models\OrderItem;
use App\Models\Product;
use App\Mail\CommandeEffectuee;
use App\Mail\CommandeValide;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->paginate(10);
        return view('backend.order.index')->with('orders', $orders);
    }

    public function store(Request $request)
    {
        //dd('Commande enregistrée');
        $this->validate($request, [
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'address1' => 'string|required',
            'address2' => 'string|nullable',
            'coupon' => 'nullable|numeric',
            'phone' => 'numeric|required',
            'post_code' => 'string|nullable',
            'email' => 'string|required'
        ]);

        if (empty(Cart::where('user_id', auth()->user()->id)->where('order_id', null)->first())) {
            request()->session()->flash('error', 'Votre panier est vide !');
            return back();
        }

        $order = new Order();
        $order_data = $request->all();
        $order_data['order_number'] = 'CMD-' . strtoupper(Str::random(10));
        $order_data['user_id'] = $request->user()->id;
        $order_data['shipping_id'] = $request->shipping;

        $shipping = Shipping::where('id', $order_data['shipping_id'])->pluck('price');

        $order_data['sub_total'] = Helper::totalCartPrice();
        $order_data['quantity'] = Helper::cartCount();

        if (session('coupon')) {
            $order_data['coupon'] = session('coupon')['value'];
        }

        // Calcul du total
        $order_data['total_amount'] = Helper::totalCartPrice() + ($shipping[0] ?? 0);
        if (session('coupon')) {
            $order_data['total_amount'] -= session('coupon')['value'];
        }

        // Statut de commande et paiement : uniquement virement bancaire
        $order_data['status'] = "new";
        $order_data['payment_method'] = 'bank_transfer';
        $order_data['payment_status'] = 'pending';

        $order->fill($order_data);
        $order->save();;

        Mail::to($order->email)->send(new CommandeEffectuee($order));

        //return redirect()->back()->with('success', 'Paiement confirmé et mail envoyé au client.');


        // Associer les articles du panier à la commande
        Cart::where('user_id', auth()->user()->id)->where('order_id', null)->update(['order_id' => $order->id]);

        // Récupérer tous les produits du panier non encore associés
                $cart_items = Cart::where('user_id', auth()->user()->id)
                                    ->where('order_id', $order->id)
                                    ->get();

        foreach ($cart_items as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->price,
                'amount'     => $item->price * $item->quantity
            ]);
        }
        // Notifications
        $admin = User::where('role', 'admin')->first();
        $details = [
            'title' => 'Nouvelle commande créée',
            'actionURL' => route('order.show', $order->id),
            'fas' => 'fa-file-alt'
        ];
        Notification::send($admin, new StatusNotification($details));

        // Vider le panier et le coupon
        session()->forget('cart');
        session()->forget('coupon');

        request()->session()->flash('success', 'Commande enregistrée. Veuillez suivre les instructions pour le virement bancaire.');
        //add('ok');
        return redirect()->route('order.track');

    }

    public function show($id)
    {
        $order = Order::find($id);
        return view('backend.order.show')->with('order', $order);
    }

    public function edit($id)
    {
        $order = Order::find($id);
        return view('backend.order.edit')->with('order', $order);
    }

    public function update(Request $request, $id)
    {
    $order = Order::findOrFail($id);

    $this->validate($request, [
        'payment_status' => 'required|in:paid,unpaid,pending',
    ]);

    $order->payment_status = $request->payment_status;
    $order->save();

    // Si paiement validé, décrémenter le stock des produits
    if ($request->payment_status === 'paid') {
        foreach ($order->carts as $cart) {
            $product = $cart->product;
            if ($product) {
                $product->stock -= $cart->quantity;
                $product->save();
            }
        }

        // Envoi de l'email de confirmation
            Mail::to($order->email)->send(new \App\Mail\PaiementValide($order));
        }

        return redirect()->back()->with('success', 'Commande mise à jour avec succès.');
    }


    public function destroy($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            request()->session()->flash('success', 'Commande supprimée avec succès.');
        } else {
            request()->session()->flash('error', 'Commande introuvable.');
        }
        return redirect()->route('order.index');
    }

    public function orderTrack()
    {
        $order = Order::where('user_id', auth()->user()->id)->latest()->first();

        return view('confirmation')->with([
            'order_number' => $order->order_number,
            'total_amount' => $order->total_amount,
        ]);
    }

    public function productTrackOrder(Request $request)
    {
        $order = Order::where('user_id', auth()->user()->id)
            ->where('order_number', $request->order_number)
            ->first();

        if ($order) {
            $messages = [
                'new' => 'Votre commande a bien été enregistrée. Merci de patienter.',
                'process' => 'Votre commande est en cours de traitement.',
                'delivered' => 'Votre commande a été livrée avec succès.',
                'cancel' => 'Votre commande a été annulée. Veuillez réessayer.'
            ];
            $message = $messages[$order->status] ?? 'Statut inconnu.';
            request()->session()->flash('success', $message);
            return redirect()->route('home');
        } else {
            request()->session()->flash('error', 'Numéro de commande invalide.');
            return back();
        }
    }

    public function pdf(Request $request)
    {
        $order = Order::getAllOrder($request->id);
        $file_name = $order->order_number . '-' . $order->first_name . '.pdf';
        $pdf = PDF::loadview('backend.order.pdf', compact('order'));
        return $pdf->download($file_name);
    }

    public function incomeChart(Request $request)
    {
        $year = \Carbon\Carbon::now()->year;

        $items = Order::with(['cart_info'])
            ->whereYear('created_at', $year)
            ->where('status', 'delivered')
            ->get()
            ->groupBy(function ($d) {
                return \Carbon\Carbon::parse($d->created_at)->format('m');
            });

        $result = [];

        foreach ($items as $month => $item_collections) {
            foreach ($item_collections as $item) {
                $amount = $item->cart_info->sum('amount');
                $m = intval($month);
                $result[$m] = ($result[$m] ?? 0) + $amount;
            }
        }

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthName = date('F', mktime(0, 0, 0, $i, 1));
            $data[$monthName] = isset($result[$i]) ? number_format($result[$i], 2, '.', '') : 0.0;
        }

        return $data;
    }
}
