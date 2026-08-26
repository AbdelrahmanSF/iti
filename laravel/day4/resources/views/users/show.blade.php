<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>User Detail</title>
</head>
<body class="p-4">
@include('partials.navbar')
<div class="container">
    <h1>User #{{ $user->id }}</h1>
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <a href="/users" class="btn btn-secondary">Back</a>

    <h3 class="mt-4">Orders</h3>
    @if($user->orders->isEmpty())
        <p>No orders for this user.</p>
    @else
        <ul class="list-group">
            @foreach($user->orders as $order)
                <li class="list-group-item">
                    <a href="/orders/{{ $order->id }}">Order #{{ $order->id }}</a> — ${{ $order->total }} — {{ $order->status }}
                </li>
            @endforeach
        </ul>
    @endif
</div>
</body>
</html>
