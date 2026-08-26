<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Order</title>
</head>
<body class="p-4">
@include('partials.navbar')
<div class="container w-50">
    <h1>Edit Order</h1>
    <form method="POST" action="/orders/{{ $order->id }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">User</label>
            <select name="user_id" class="form-select">
                @foreach($users as $u)
                    <option value="{{ $u->id }}" {{ $order->user_id == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Total</label>
            <input name="total" class="form-control" value="{{ old('total', $order->total) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <input name="status" class="form-control" value="{{ old('status', $order->status) }}">
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
</body>
</html>
