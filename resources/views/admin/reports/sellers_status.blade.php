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
        
        /* Tabel */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 6px; text-align: left; font-size: 11pt; }
        th { text-align: center; font-weight: bold; background-color: #f2f2f2; }
        
        /* Kolom No kecil */
        th:first-child, td:first-child { width: 30px; text-align: center; }
        
        .footer-note { margin-top: 10px; font-size: 10pt; font-style: italic; }
    </style>
</head>
<body>
    <div class="header">
        <div class="srs-code">({{ $code }})</div>
        <div class="title">{{ $title }}</div>
        <div class="meta">
            Tanggal dibuat: {{ $tanggal }} oleh {{ $pemroses }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Nama PIC</th>
                <th>Nama Toko</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sellers as $index => $seller)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $seller->user->name ?? '-' }}</td>
                <td>{{ $seller->pic_name }}</td>
                <td>{{ $seller->store_name }}</td>
                <td>
                    @if($seller->status == 'active') Aktif
                    @elseif($seller->status == 'pending') Pending
                    @else Tidak Aktif
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer-note">
        ***) urutkan berdasarkan status (aktif dulu baru tidak aktif)
    </div>
</body>
</html>