<?php if (!defined('GUVENLIK')) { die('Direkt erişim yok.'); } ?>

<div class="ph ph-dark">
  <div class="wrap">
    <div class="label">Referanslar</div>
    <h1>4.500+ projede güven</h1>
    <div class="alt">Konuttan ticari yapıya · %98 memnuniyet</div>
  </div>
</div>

<!-- ===== MEMNUNİYET RAKAMLARI ===== -->
<section>
  <div class="wrap">
    <div class="rakamlar">
      <div class="r"><b>%98</b><small>Memnuniyet oranı</small></div>
      <div class="r"><b>4.500+</b><small>Tamamlanan iş</small></div>
      <div class="r"><b>2011</b><small>yılından beri</small></div>
      <div class="r"><b>2</b><small>Şube · Marmaris & Bodrum</small></div>
    </div>
  </div>
</section>

<!-- ===== YORUMLAR ===== -->
<section style="padding-top:0;border-top:none">
  <div class="quotes">
    <?php foreach ($REFERANSLAR as $r): ?>
      <div class="qc">
        <div class="stars">★★★★★</div>
        <p>"<?= e($r['yorum']) ?>"</p>
        <b><?= e($r['ad']) ?></b>
        <small><?= e($r['yer']) ?></small>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- ===== ÇALIŞILAN ALANLAR ===== -->
<section class="section-paper">
  <div class="wrap">
    <div class="sec-head">
      <div class="rule"></div>
      <div class="label">Çalıştığımız alanlar</div>
      <h2>Her ölçekte proje</h2>
    </div>
    <div class="etiketler">
      <span>Konut & Daire</span>
      <span>Villa</span>
      <span>Otel & Pansiyon</span>
      <span>Ofis & Ticari</span>
      <span>Site & Apartman</span>
      <span>Restoran & Kafe</span>
    </div>
  </div>
</section>

<section class="cta-serit">
  <div class="wrap">
    <h2>Siz de aramıza katılın</h2>
    <p>Projeniz için ücretsiz keşif ve teklif alın.</p>
    <a class="btn-ana" href="iletisim">Teklif İste</a>
  </div>
</section>
