<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body { font-family: 'Times New Roman', serif; font-size: 12pt; }
        .header { margin-bottom: 20px; }
        .srs-code { font-size: 10pt; color: #555; }
        .title { font-weight: bold; font-size: 14pt; margin: 5px 0; }
        .meta { font-style: italic; font-size: 10pt; margin-bottom: 15px;}
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 6px; text-align: left; font-size: 11pt; }
        th { text-align: center; font-weight: bold; background-color: #f2f2f2; }
        th:first-child, td:first-child { width: 30px; text-align: center; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .footer-note { margin-top: 10px; font-size: 10pt; font-style: italic; }
    </style>
</head>
<body>
    <div class="header">
        <div class="srs-code">({{ $code }})</div>
        <div class="title">{{ $title }}</div>
        <div class="meta">
            Nama Toko: {{ Auth::user()->seller->store_name ?? 'Toko Saya' }} <br>
            Tanggal dibuat: {{ $tanggal }} oleh {{ $pemroses }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga (Rp)</th>
                <th>Jumlah Stok</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category }}</td>
                <td class="text-right">{{ number_format($product->price, 0, ',', '.') }}</td>
                <td class="text-center">{{ $product->stock }}</td>
                <td>{{ $product->status == 'active' ? 'Aktif' : 'Nonaktif' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer-note">***) Diurutkan berdasarkan jumlah stok terbanyak.</div>
</body>
</html>