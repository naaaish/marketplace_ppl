<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin - Pending Sellers</title>
</head>
<body>
    <h2>Pending Sellers</h2>
    @if(session('status'))
        <p style="color:green">{{ session('status') }}</p>
    @endif
    <ul>
    @foreach($sellers as $s)
        <li>
            <strong>{{ $s->store_name }}</strong> by {{ $s->pic_name }} ({{ $s->pic_email }})
            <form method="POST" action="{{ route('admin.sellers.approve', $s->id) }}" style="display:inline">
                @csrf
                <button type="submit">Approve</button>
            </form>
            <a href="{{ route('admin.sellers.show', $s->id) }}">View</a>
        </li>
    @endforeach
    </ul>
</body>
</html>
