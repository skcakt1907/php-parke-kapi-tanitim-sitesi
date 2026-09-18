<?php if (!defined('GUVENLIK')) { die('Direkt erişim yok.'); } ?>

<div class="ph ph-dark">
  <div class="wrap">
    <div class="label">Ürünlerimiz</div>
    <h1>Kapı ve parkede uzmanlık</h1>
    <div class="alt">Yangın Kapısı · Çelik Kapı · İç Oda Kapısı · Parke</div>
  </div>
</div>

<section style="border-top:none">
  <div class="wrap">
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
  </div>
</section>

<!-- ===== ÇALIŞMA SÜRECİMİZ ===== -->
<section class="section-paper">
  <div class="wrap">
    <div class="sec-head">
      <div class="rule"></div>
      <div class="label">Nasıl çalışıyoruz?</div>
      <h2>Keşiften montaja 4 adım</h2>
    </div>
    <div class="adimlar">
      <div class="adim"><div class="n">01 —</div><h3>Ücretsiz Keşif</h3><p>Yerinde ölçü alır, ihtiyaçlarınızı dinleriz.</p></div>
      <div class="adim"><div class="n">02 —</div><h3>Seçim & Teklif</h3><p>Renk, model ve ölçüyü birlikte belirler, net fiyat sunarız.</p></div>
      <div class="adim"><div class="n">03 —</div><h3>Üretim</h3><p>Sertifikalı malzemeyle kendi atölyemizde hazırlarız.</p></div>
      <div class="adim"><div class="n">04 —</div><h3>Montaj</h3><p>Kendi ekibimizle temiz ve hızlı şekilde uygularız.</p></div>
    </div>
  </div>
</section>

<!-- ===== MALZEME NOTU ===== -->
<section>
  <div class="wrap sec-head" style="margin-bottom:0">
    <div class="rule"></div>
    <div class="label">Malzeme & Kalite</div>
    <h2>Doğru malzeme, kalıcı sonuç</h2>
    <p>Çelik kapıda çok kilitli güvenlik, yangın kapısında EI sertifikası, parkede AC4–AC5 dayanıklılık, iç oda kapısında ses ve nem dengesi — her üründe önce işlev, sonra estetik.</p>
  </div>
</section>

<section class="cta-serit">
  <div class="wrap">
    <h2>Aradığınız ürünü bulamadınız mı?</h2>
    <p>İhtiyacınıza göre en uygun çözümü birlikte belirleyelim.</p>
    <a class="btn-ana" href="iletisim">Bize Danışın</a>
  </div>
</section>
