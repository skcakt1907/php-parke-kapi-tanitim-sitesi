<?php if (!defined('GUVENLIK')) { die('Direkt erişim yok.'); } ?>

<div class="ph ph-dark">
  <div class="wrap">
    <div class="label">Hakkımızda</div>
    <h1>2011'den beri Muğla'da parke ve kapı</h1>
    <div class="alt">Marmaris · Bodrum · Üretimden montaja tek elden</div>
  </div>
</div>

<section class="about">
  <div class="wrap">
    <h2>Bir atölyenin, mekâna duyduğu saygının hikâyesi</h2>
    <div class="by"><?= e(FIRMA_TAM) ?></div>
    <div class="cols">
      <p>2011 yılından günümüze parke konusunda faaliyet gösteren Elite Parke; ahşabın konforunu, geniş ürün koleksiyonu ve uzman hizmet kalitesiyle sizlere ulaştırıyor.</p>
      <p>Parkenin yanı sıra yangın kapısı, çelik kapı ve iç oda kapısında da üretimden montaja kadar süreci kendi ekibimizle yürütüyoruz; tek muhatap, net sorumluluk ve kalıcı bir sonuç.</p>
      <p>Showroom danışmanlığından yerinde ölçüye, seçimden montaja kadar her adımda yanınızdayız. Önce işlev, ardından estetik — her işte ilkemiz bu.</p>
      <p>Bugün Muğla — Marmaris ve Bodrum'da uygulama ve satış mağazalarımızla hizmet vermeye devam ediyoruz.</p>
    </div>
    <p class="pullquote">"İyi bir zemin ve doğru bir kapı, bir mekânı yıllarca taşır."</p>
  </div>
</section>

<!-- ===== RAKAMLAR ===== -->
<section>
  <div class="wrap">
    <div class="rakamlar">
      <div class="r"><b>2011</b><small>yılından beri</small></div>
      <div class="r"><b>4.500+</b><small>Tamamlanan proje</small></div>
      <div class="r"><b>2</b><small>Showroom</small></div>
      <div class="r"><b>%98</b><small>Memnuniyet</small></div>
    </div>
  </div>
</section>

<!-- ===== DEĞERLERİMİZ ===== -->
<section class="section-paper">
  <div class="wrap">
    <div class="sec-head">
      <div class="rule"></div>
      <div class="label">Değerlerimiz</div>
      <h2>Bizi biz yapan ilkeler</h2>
    </div>
    <div class="degerler">
      <div class="deger"><h3>Tek elden sorumluluk</h3><p>Ölçüden montaja tüm süreç bizde; işi başkasına devretmeyiz.</p></div>
      <div class="deger"><h3>Dürüst işçilik</h3><p>Abartısız, söz verdiğimiz kalite; gizli sürpriz yok.</p></div>
      <div class="deger"><h3>Zamanında teslim</h3><p>Planladığımız günde, temiz bir uygulamayla teslim ederiz.</p></div>
    </div>
  </div>
</section>

<!-- ===== SHOWROOMLAR ===== -->
<section>
  <div class="wrap">
    <div class="sec-head">
      <div class="rule"></div>
      <div class="label">Showroomlarımız</div>
      <h2>İki şubede yanınızdayız</h2>
    </div>
    <div class="showroomlar">
      <div class="sr-kart">
        <div class="et">Marmaris Şube</div>
        <h3>Marmaris</h3>
        <div class="sr-row"><b>Adres:</b> <?= e(ADRES) ?></div>
        <div class="sr-row"><b>Telefon:</b> <?= e(TELEFON) ?></div>
        <div class="sr-row"><b>Saatler:</b> <?= e(CALISMA) ?></div>
      </div>
      <?php if (ADRES2): ?>
      <div class="sr-kart">
        <div class="et">Bodrum Şube</div>
        <h3>Bodrum</h3>
        <div class="sr-row"><b>Adres:</b> <?= e(ADRES2) ?></div>
        <div class="sr-row"><b>Telefon:</b> <?= e(TELEFON) ?></div>
        <div class="sr-row"><b>Saatler:</b> <?= e(CALISMA) ?></div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="cta-serit">
  <div class="wrap">
    <h2>Sizin için ne yapabiliriz?</h2>
    <p>Projeniz için ücretsiz keşif ve teklif alın.</p>
    <a class="btn-ana" href="iletisim">İletişime Geç</a>
  </div>
</section>
