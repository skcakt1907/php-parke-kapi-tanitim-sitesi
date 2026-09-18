<?php
if (!defined('GUVENLIK')) { die('Direkt erişim yok.'); }
/* Ürün index.php'de çözüldü (404 durumu çıktıdan önce ayarlanır) */
$u = $urunAktif ?? urun_bul($_GET['u'] ?? '');
if (!$u) { require __DIR__ . '/404.php'; return; }
?>
<div class="urun-detay">
  <div class="wrap">
    <div class="ud-grid">
      <div class="ud-gorsel <?= e($u['sinif']) ?>">
        <?php if (!empty($u['gorsel'])): ?><img src="assets/img/<?= e($u['gorsel']) ?>" alt="<?= e($u['baslik']) ?>"><?php endif; ?>
      </div>
      <div class="ud-bilgi">
        <a class="geri" href="urunler">← Tüm ürünler</a>
        <div class="no">№ <?= e($u['no']) ?> · Ürün</div>
        <h1><?= e($u['baslik']) ?></h1>
        <p><?= e($u['aciklama']) ?></p>

        <ul class="ozellik-liste">
          <li>Ölçü, üretim ve montaj tek elden</li>
          <li>Sertifikalı, dayanıklı malzeme</li>
          <li>Geniş renk ve model seçeneği</li>
          <li>2 yıl işçilik garantisi</li>
          <li>Marmaris & Bodrum'da ücretsiz keşif</li>
        </ul>

        <p style="color:var(--muted)">Renk, ölçü ve model seçenekleri için ücretsiz keşif talep edebilir ya da bizi hemen arayabilirsiniz.</p>
        <div class="ud-cta">
          <a class="btn-ana" href="iletisim">Teklif / Keşif İste</a>
          <a class="btn-cizgi" href="tel:<?= e(TELEFON_RAW) ?>">Hemen Ara</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ===== DİĞER ÜRÜNLER ===== -->
<?php
$digerleri = array_filter($URUNLER, fn($x) => slugla($x['baslik']) !== slugla($u['baslik']));
$digerleri = array_slice($digerleri, 0, 3);
?>
<?php if ($digerleri): ?>
<section class="section-paper">
  <div class="wrap">
    <div class="sec-head">
      <div class="rule"></div>
      <div class="label">Diğer ürünlerimiz</div>
      <h2>Bunlara da göz atın</h2>
    </div>
    <div class="ilgili">
      <?php foreach ($digerleri as $d): ?>
        <a href="urun/<?= e(slugla($d['baslik'])) ?>">
          <div class="kk <?= e($d['sinif']) ?>">
            <?php if (!empty($d['gorsel'])): ?><img src="assets/img/<?= e($d['gorsel']) ?>" alt="<?= e($d['baslik']) ?>"><?php endif; ?>
          </div>
          <div class="num">№ <?= e($d['no']) ?></div>
          <h3><?= e($d['baslik']) ?></h3>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="cta-serit">
  <div class="wrap">
    <h2>Bu ürün için teklif alın</h2>
    <p>Ücretsiz keşif ve net fiyat için bize ulaşın.</p>
    <a class="btn-ana" href="iletisim">İletişime Geç</a>
  </div>
</section>
