<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Create Student</title>
</head>
<body class="p-4">
@include('partials.navbar')
<div class="container w-50">
    <h1>Create Student</h1>
    <form method="POST" action="/students">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" class="form-control" value="{{ old('name') }}">
            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" class="form-control" value="{{ old('email') }}">
            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">User (optional, user id)</label>
            <input name="user_id" class="form-control" value="{{ old('user_id') }}">
            @error('user_id')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <button class="btn btn-primary">Create</button>
    </form>
</div>
</body>
</html>
