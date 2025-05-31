<h2>Facture: {{ $order->order_number }}</h2>
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
        @foreach ($order->cart as $item)
            <tr>
                <td>{{ $item->product->title }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->price }} €</td>
            </tr>
        @endforeach
    </tbody>
</table>
