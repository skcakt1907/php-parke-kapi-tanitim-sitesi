<?php
if (!defined('GUVENLIK')) { die('Direkt erişim yok.'); }

/* Metin panelden gelir; boşsa varsayılana düşer */
$metin = trim($SITE['ayarlar']['gizlilik'] ?? '');
if ($metin === '') { $metin = gizlilik_varsayilan(); }

/* Yer tutucuları güncel ayarlarla değiştir */
$metin = strtr($metin, [
    '{FIRMA}'   => e(FIRMA_TAM),
    '{ADRES}'   => e(ADRES),
    '{ADRES2}'  => e(ADRES2),
    '{TELEFON}' => '<a href="tel:' . e(TELEFON_RAW) . '">' . e(TELEFON) . '</a>',
    '{EPOSTA}'  => '<a href="mailto:' . e(EMAIL) . '">' . e(EMAIL) . '</a>',
]);

$tarih = trim($SITE['ayarlar']['gizlilik_tarih'] ?? '');
?>

<div class="ph ph-dark">
  <div class="wrap">
    <div class="label">Yasal</div>
    <h1>Gizlilik Politikası</h1>
    <div class="alt">KVKK · Kişisel Verilerin Korunması</div>
  </div>
</div>

<section style="border-top:none">
  <div class="wrap metin">
    <?php if ($tarih !== ''): ?>
      <p class="metin-tarih">Son güncelleme: <?= e($tarih) ?></p>
    <?php endif; ?>
    <?= $metin ?>
  </div>
</section>
