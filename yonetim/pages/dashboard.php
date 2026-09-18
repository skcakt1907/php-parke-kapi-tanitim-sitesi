<?php
if (!defined('GUVENLIK')) { die('Direkt erişim yok.'); }
$SITE = store_load();
$mesajSayi = (int) db()->query("SELECT COUNT(*) FROM mesajlar")->fetchColumn();
?>
<div class="cards">
  <div class="card"><div class="k">Ürün</div><div class="v"><span class="ic">▤</span> <?= count($SITE['urunler']) ?></div></div>
  <div class="card"><div class="k">Referans</div><div class="v"><span class="ic">★</span> <?= count($SITE['referanslar']) ?></div></div>
  <div class="card"><div class="k">Mesaj</div><div class="v"><span class="ic">✉</span> <?= $mesajSayi ?></div></div>
  <div class="card"><div class="k">Şube</div><div class="v">2</div></div>
</div>

<div class="panel">
  <h2>Hızlı erişim</h2>
  <div class="actions" style="flex-wrap:wrap">
    <a class="btn" href="index.php?p=urunler">Ürünleri yönet</a>
    <a class="btn sec" href="index.php?p=referanslar">Referanslar</a>
    <a class="btn sec" href="index.php?p=mesajlar">Gelen mesajlar (<?= $mesajSayi ?>)</a>
    <a class="btn sec" href="index.php?p=ayarlar">Site ayarları</a>
    <a class="btn sec" href="../index.php" target="_blank">Siteyi önizle ↗</a>
  </div>
</div>

<div class="panel mb0">
  <h2>Bilgi</h2>
  <p class="muted">Bu panel veriyi <code>data/site.json</code> dosyasında tutar (veritabanı yok). Buradan yaptığınız değişiklikler anında siteye yansır. Gelen iletişim formları <code>data/mesajlar.csv</code> dosyasına kaydedilir.</p>
</div>
