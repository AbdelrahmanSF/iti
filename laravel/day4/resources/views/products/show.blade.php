<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Product</title>
</head>
<body class="p-4">
@include('partials.navbar')
<div class="container">
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p><strong>Price:</strong> ${{ $product->price }}</p>
    <p><strong>Category:</strong> @if($product->category)<a href="/categories/{{ $product->category->id }}">{{ $product->category->name }}</a>@else - @endif</p>
    <a href="/products" class="btn btn-secondary">Back</a>
</div>
</body>
</html>
