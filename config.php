<?php
/* =========================================================
   Elite Parke — Site Ayarları
   Veri data/site.json'dan gelir (admin panelden yönetilir).
   ========================================================= */
if (!defined('GUVENLIK')) { die('Direkt erişim yok.'); }

/* Uygulama kök URL'i — temiz URL'ler <base href> ile buna göre çözülür.
   Alt klasörde /elite-parke/, canlı kökte / olur. */
define('BASE', rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/') . '/');

require_once __DIR__ . '/store.php';

$SITE = store_load();
$A    = $SITE['ayarlar'];

/* --- Firma bilgileri (store'dan) --- */
define('SITE_AD',     $A['site_ad']);
define('FIRMA_TAM',   $A['firma_tam']);
define('TAGLINE',     $A['tagline']);
define('TELEFON',     $A['telefon']);
define('TELEFON_RAW', preg_replace('/\D+/', '', $A['telefon']));
/* WhatsApp: panelde ayrı numara girilmişse onu, boşsa telefonu kullanır */
$waNum = preg_replace('/\D+/', '', $A['whatsapp'] ?? '');
if ($waNum === '') { $waNum = TELEFON_RAW; }
define('WA_LINK', 'https://wa.me/90' . ltrim($waNum, '0'));
define('EMAIL',       $A['email']);
define('ADRES',       $A['adres']);
define('ADRES2',      $A['adres2'] ?? '');
define('CALISMA',     $A['calisma']);
define('YIL',         date('Y'));

/* --- Üst menü (sabit) — key = ?sayfa= değeri --- */
$MENU = [
    ['key' => 'urunler',     'baslik' => 'Ürünlerimiz'],
    ['key' => 'hakkimizda',  'baslik' => 'Hakkımızda'],
    ['key' => 'referanslar', 'baslik' => 'Referanslar'],
    ['key' => 'iletisim',    'baslik' => 'İletişim'],
];

/* --- Ürün ve referanslar (store'dan) --- */
$URUNLER     = $SITE['urunler'];
$REFERANSLAR = $SITE['referanslar'];

/* --- Yardımcı: güvenli çıktı --- */
if (!function_exists('e')) {
    function e($s){ return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
}

/* --- Yardımcı: Türkçe uyumlu slug (ürün URL'i için) --- */
if (!function_exists('slugla')) {
    function slugla($s){
        $tr = ['ç','Ç','ş','Ş','ı','İ','ğ','Ğ','ü','Ü','ö','Ö'];
        $en = ['c','c','s','s','i','i','g','g','u','u','o','o'];
        $s = str_replace($tr, $en, $s);
        $s = mb_strtolower($s, 'UTF-8');
        $s = preg_replace('/[^a-z0-9]+/', '-', $s);
        return trim($s, '-');
    }
}

/* --- Yardımcı: ürünü slug'a göre bul --- */
if (!function_exists('urun_bul')) {
    function urun_bul($slug){
        global $URUNLER;
        foreach ($URUNLER as $u) {
            if (slugla($u['baslik']) === $slug) { return $u; }
        }
        return null;
    }
}
