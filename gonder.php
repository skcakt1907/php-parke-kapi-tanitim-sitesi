<?php
/* =========================================================
   Elite Parke — İletişim formu işleyici
   POST verisini doğrular, data/mesajlar.csv'ye kaydeder,
   (SMTP varsa) mail atar ve ana sayfaya geri yönlendirir.
   ========================================================= */
define('GUVENLIK', true);
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$ad      = trim($_POST['ad'] ?? '');
$telefon = trim($_POST['telefon'] ?? '');
$urun    = trim($_POST['urun'] ?? '');
$mesaj   = trim($_POST['mesaj'] ?? '');

/* --- Doğrulama --- */
if ($ad === '' || $telefon === '' || $urun === '') {
    $q = http_build_query(['hata' => 1, 'ad' => $ad, 'tel' => $telefon]);
    header('Location: iletisim?' . $q . '#iletisim');
    exit;
}

/* --- Kaydet (veritabanı) --- */
try {
    $st = db()->prepare("INSERT INTO mesajlar (tarih, ad, telefon, urun, mesaj, ip)
                         VALUES (?, ?, ?, ?, ?, ?)");
    $st->execute([date('Y-m-d H:i:s'), $ad, $telefon, $urun, $mesaj, $_SERVER['REMOTE_ADDR'] ?? '']);
} catch (Throwable $e) {
    // Kayıt hatası akışı bozmasın; yine de teşekkür sayfasına dön
}

/* --- Mail (SMTP yapılandırılınca otomatik gönderir; WAMP'ta sessizce geçer) --- */
$konu = 'Yeni Keşif Talebi — ' . SITE_AD;
$govde = "Ad: $ad\nTelefon: $telefon\nÜrün: $urun\nMesaj: $mesaj\nTarih: " . date('Y-m-d H:i:s');
$baslik = 'From: ' . SITE_AD . ' <' . EMAIL . ">\r\nReply-To: $ad <" . EMAIL . ">\r\nContent-Type: text/plain; charset=UTF-8";
@mail(EMAIL, $konu, $govde, $baslik);

/* --- Geri dön --- */
header('Location: iletisim?gonderildi=1#iletisim');
exit;
