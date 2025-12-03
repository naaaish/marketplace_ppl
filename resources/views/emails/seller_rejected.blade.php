<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Ditolak</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333;">
    
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
        <h2 style="color: #d33;">Mohon Maaf, Pendaftaran Ditolak</h2>
        
        <p>Halo, <strong>{{ $user->name }}</strong>.</p>
        
        <p>Terima kasih telah mengajukan pendaftaran toko di platform <strong>tukutuku</strong>.</p>
        
        <p>Setelah melalui proses verifikasi oleh tim Admin kami, dengan berat hati kami sampaikan bahwa pendaftaran toko Anda <strong>BELUM DAPAT KAMI SETUJUI</strong> saat ini.</p>
        
        <p>Hal ini mungkin dikarenakan data yang kurang lengkap atau dokumen tidak valid. Silakan hubungi admin jika Anda merasa ini adalah kesalahan.</p>
        
        <br>
        <p>Salam,</p>
        <p><strong>Tim Admin tukutuku</strong></p>
    </div>

</body>
</html>