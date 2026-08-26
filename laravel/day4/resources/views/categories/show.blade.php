<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Category</title>
</head>
<body class="p-4">
@include('partials.navbar')
<div class="container">
    <h1>Category: {{ $category->name }}</h1>
    <a href="/categories" class="btn btn-secondary mb-3">Back</a>
    <h3>Products in this category</h3>
    <ul class="list-group">
        @foreach($category->products as $product)
            <li class="list-group-item">
                <a href="/products/{{ $product->id }}">{{ $product->name }}</a> — ${{ $product->price }}
            </li>
        @endforeach
    </ul>
</div>
</body>
</html>
