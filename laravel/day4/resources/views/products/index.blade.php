<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Products</title>
</head>
<body class="p-4">
@include('partials.navbar')
<div class="container">
    <h1>Products</h1>
    <a href="/products/create" class="btn btn-primary mb-3">Create Product</a>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <table class="table">
        <thead><tr><th>ID</th><th>Name</th><th>Category</th><th>Price</th><th>Actions</th></tr></thead>
        <tbody>
        @foreach($products as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td><a href="/products/{{ $p->id }}">{{ $p->name }}</a></td>
                <td>@if($p->category)<a href="/categories/{{ $p->category->id }}">{{ $p->category->name }}</a>@else - @endif</td>
                <td>${{ $p->price }}</td>
                <td>
                    <a href="/products/{{ $p->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                    <form action="/products/{{ $p->id }}" method="POST" style="display:inline-block">
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
