<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Order</title>
</head>
<body class="p-4">
@include('partials.navbar')
<div class="container">
    <h1>Order #{{ $order->id }}</h1>
    <p><strong>User:</strong> <a href="/users/{{ $order->user->id }}">{{ $order->user->name }}</a></p>
    <p><strong>Total:</strong> ${{ $order->total }}</p>
    <p><strong>Status:</strong> {{ $order->status }}</p>
    <a href="/orders" class="btn btn-secondary">Back</a>
</div>
</body>
</html>
