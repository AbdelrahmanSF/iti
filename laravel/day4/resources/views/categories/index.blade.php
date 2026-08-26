<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Categories</title>
</head>
<body class="p-4">
@include('partials.navbar')
<div class="container">
    <h1>Categories</h1>
    <a href="/categories/create" class="btn btn-primary mb-3">Create Category</a>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <ul class="list-group">
        @foreach($categories as $category)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="/categories/{{ $category->id }}">{{ $category->name }}</a>
                <span>
                    <a href="/categories/{{ $category->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                    <form action="/categories/{{ $category->id }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </span>
            </li>
        @endforeach
    </ul>
</div>
</body>
</html>
