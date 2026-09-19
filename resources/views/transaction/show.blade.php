<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Status Transaksi {{ $transaction->invoice_id }}</title>
</head>
<body>
    <h1>Transaksi {{ $transaction->invoice_id }}</h1>
    <p>Status: <strong>{{ $transaction->status }}</strong></p>
    <p>Produk: {{ $transaction->product_name }} - {{ $transaction->product_item_name }}</p>
    <p>Total: Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</p>
    @if($transaction->sn)
        <p>SN: {{ $transaction->sn }}</p>
    @endif
</body>
</html>
