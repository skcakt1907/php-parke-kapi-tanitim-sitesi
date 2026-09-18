<?php
/* =========================================================
   Elite Parke — Front Controller
   ?sayfa=... ile pages/ altındaki sayfayı yükler.
   ÖNEMLİ: HTTP durum kodu, çıktı basılmadan ÖNCE belirlenir.
   ========================================================= */
define('GUVENLIK', true);
require_once __DIR__ . '/config.php';

$sayfa = $_GET['sayfa'] ?? 'anasayfa';

$rotalar = [
    'anasayfa'    => 'anasayfa.php',
    'urunler'     => 'urunler.php',
    'urun'        => 'urun.php',
    'hakkimizda'  => 'hakkimizda.php',
    'referanslar' => 'referanslar.php',
    'iletisim'    => 'iletisim.php',
    'gizlilik'    => 'gizlilik.php',
];

/* --- Rota ve ürün çözümü (çıktıdan önce) --- */
$bulunamadi = false;
$urunAktif  = null;

if (!isset($rotalar[$sayfa])) {
    $bulunamadi = true;
} elseif ($sayfa === 'urun') {
    $urunAktif = urun_bul($_GET['u'] ?? '');
    if (!$urunAktif) { $bulunamadi = true; }
}

if ($bulunamadi) { http_response_code(404); }

/* --- Render --- */
require_once __DIR__ . '/partials/header.php';

if ($bulunamadi) {
    require __DIR__ . '/pages/404.php';
} else {
    require __DIR__ . '/pages/' . $rotalar[$sayfa];
}

require_once __DIR__ . '/partials/footer.php';
