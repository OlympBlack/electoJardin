<h2>Facture : {{ $order->order_number }}</h2>
<p>Client : {{ $order->first_name }} {{ $order->last_name }}</p>
<p>Montant total : {{ number_format($order->total_amount, 2) }} €</p>

<table>
    <thead>
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix</th>
        </tr>
    </thead>
    <tbody>
    @if(!empty($order->orderItems) && count($order->orderItems) > 0)
        @foreach ($order->orderItems as $item)
            <tr>
                <td>{{ $item->product->title ?? 'Produit inconnu' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price, 2) }} €</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="3" class="text-center">Aucun produit trouvé pour cette commande.</td>
        </tr>
    @endif
    </tbody>
</table>
