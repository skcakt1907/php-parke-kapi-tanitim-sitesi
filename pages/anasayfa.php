<?php if (!defined('GUVENLIK')) { die('Direkt erişim yok.'); } ?>

<!-- ===== KAPAK / HERO ===== -->
<header class="feature">
  <div class="wrap">
    <div class="feat-img"></div>
    <div class="feat-cap">
      <span>Kapak · Meşe Doğal laminant parke uygulaması</span>
      <span>Marmaris · Bodrum</span>
    </div>
    <div class="feat-head">
      <h1>Zemininiz ve kapınız, mekânınızın <i>karakteri</i>.</h1>
      <div>
        <p class="lead"><span class="drop">Y</span>angın kapısı, çelik kapı, iç oda kapısı ve parkede; üretimden montaja kadar tek elden çalışıyoruz. Marmaris ve Bodrum'da hizmetinizdeyiz.</p>
        <a href="iletisim" class="btn">Ücretsiz Keşif İste</a>
      </div>
    </div>
  </div>
</header>

<!-- ===== ÜRÜNLER (özet) ===== -->
<section>
  <div class="wrap">
    <div class="sec-head">
      <div class="rule"></div>
      <div class="label">Ürünlerimiz</div>
      <h2>Dört bölümde uzmanlık</h2>
      <p>Her ürün, kendi başlığında özenle ele alınır.</p>
    </div>
    <div class="articles">
      <?php foreach ($URUNLER as $u): ?>
        <a class="art" href="urun/<?= e(slugla($u['baslik'])) ?>">
          <div class="thumb <?= e($u['sinif']) ?>">
            <?php if (!empty($u['gorsel'])): ?><img src="assets/img/<?= e($u['gorsel']) ?>" alt="<?= e($u['baslik']) ?>"><?php endif; ?>
          </div>
          <div>
            <div class="num">№ <?= e($u['no']) ?></div>
            <h3><?= e($u['baslik']) ?></h3>
            <p><?= e($u['aciklama']) ?></p>
            <span class="read">Devamını oku</span>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
    <div style="text-align:center;margin-top:44px">
      <a class="btn-cizgi" href="urunler">Tüm ürünler</a>
    </div>
  </div>
</section>

<!-- ===== NEDEN ELITE PARKE ===== -->
<section class="section-paper">
  <div class="wrap">
    <div class="sec-head">
      <div class="rule"></div>
      <div class="label">Neden Elite Parke?</div>
      <h2>Söz verdiğimiz gibi teslim</h2>
    </div>
    <div class="ozellikler">
      <div class="oz-kart"><div class="ico">✓</div><h3>Tek elden çözüm</h3><p>Ölçü, üretim ve montaj aynı ekipte; tek muhatap, net sorumluluk.</p></div>
      <div class="oz-kart"><div class="ico">🛡</div><h3>Sertifikalı ürün</h3><p>Yangın ve güvenlik standartlarına uygun, belgeli malzeme.</p></div>
      <div class="oz-kart"><div class="ico">★</div><h3>2 yıl garanti</h3><p>İşçilik güvencesi; ilk günkü kalite yıllarca korunur.</p></div>
      <div class="oz-kart"><div class="ico">⚡</div><h3>48 saatte keşif</h3><p>Hızlı yerinde ölçü ve net fiyat teklifi.</p></div>
    </div>
  </div>
</section>

<!-- ===== RAKAMLAR ===== -->
<section>
  <div class="wrap">
    <div class="rakamlar">
      <div class="r"><b>2011</b><small>yılından beri</small></div>
      <div class="r"><b>4.500+</b><small>Tamamlanan proje</small></div>
      <div class="r"><b>2</b><small>Showroom · Marmaris & Bodrum</small></div>
      <div class="r"><b>%98</b><small>Müşteri memnuniyeti</small></div>
    </div>
  </div>
</section>

<!-- ===== ALT CTA ===== -->
<section class="cta-serit" style="border-top:none">
  <div class="wrap">
    <h2>Projenizi konuşalım</h2>
    <p>Ücretsiz yerinde keşif ve ölçü için bize ulaşın; 24 saat içinde dönelim.</p>
    <a class="btn-ana" href="iletisim">İletişime Geç</a>
  </div>
</section>
