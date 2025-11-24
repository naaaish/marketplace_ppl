<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin - Seller Detail</title>
</head>
<body>
    <h2>Seller: {{ $seller->store_name }}</h2>
    <p>PIC: {{ $seller->pic_name }} ({{ $seller->pic_email }})</p>
    <p>Address: {{ $seller->pic_address }}</p>
    <p>Status: {{ $seller->status }}</p>

    <form method="POST" action="{{ route('admin.sellers.approve', $seller->id) }}">
        @csrf
        <button type="submit">Approve Seller</button>
    </form>

    <p><a href="{{ route('admin.sellers.index') }}">Back to list</a></p>
</body>
</html>
