<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Orders</title>
</head>
<body class="p-4">
@include('partials.navbar')
<div class="container">
    <h1>Orders</h1>
    <a href="/orders/create" class="btn btn-primary mb-3">Create Order</a>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <table class="table">
        <thead><tr><th>ID</th><th>User</th><th>Total</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
        @foreach($orders as $o)
            <tr>
                <td>{{ $o->id }}</td>
                <td><a href="/users/{{ $o->user->id }}">{{ $o->user->name }}</a></td>
                <td>${{ $o->total }}</td>
                <td>{{ $o->status }}</td>
                <td>
                    <a href="/orders/{{ $o->id }}" class="btn btn-sm btn-info">View</a>
                    <a href="/orders/{{ $o->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                    <form action="/orders/{{ $o->id }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
