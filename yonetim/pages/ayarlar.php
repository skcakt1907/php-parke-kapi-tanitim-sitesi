<?php
if (!defined('GUVENLIK')) { die('Direkt erişim yok.'); }
$SITE = store_load();
$a = $SITE['ayarlar'];
?>
<div class="panel">
  <h2>Site ayarları</h2>
  <form method="post" action="index.php?p=ayarlar">
    <?= csrf_alani() ?>
    <input type="hidden" name="islem" value="ayarlar_kaydet">
    <div class="grid2">
      <div class="field"><label>Site adı</label><input name="site_ad" value="<?= e($a['site_ad']) ?>"></div>
      <div class="field"><label>Slogan (tagline)</label><input name="tagline" value="<?= e($a['tagline']) ?>"></div>
    </div>
    <div class="field"><label>Firma tam unvanı</label><input name="firma_tam" value="<?= e($a['firma_tam']) ?>"></div>
    <div class="grid2">
      <div class="field"><label>Telefon</label><input name="telefon" value="<?= e($a['telefon']) ?>"></div>
      <div class="field"><label>E-posta</label><input name="email" value="<?= e($a['email']) ?>"></div>
    </div>
    <div class="field">
      <label>WhatsApp numarası (yüzen buton)</label>
      <input name="whatsapp" value="<?= e($a['whatsapp'] ?? '') ?>" placeholder="05__ ___ __ __ — boş bırakılırsa telefon kullanılır">
    </div>
    <div class="field"><label>Çalışma saatleri</label><input name="calisma" value="<?= e($a['calisma']) ?>"></div>
    <div class="field"><label>Adres — Marmaris Şube</label><input name="adres" value="<?= e($a['adres']) ?>"></div>
    <div class="field"><label>Adres — Bodrum Şube</label><input name="adres2" value="<?= e($a['adres2'] ?? '') ?>"></div>
    <div class="actions"><button class="btn">Kaydet</button></div>
  </form>
</div>

<div class="panel">
  <h2>Gizlilik Politikası metni</h2>
  <p class="muted" style="margin-bottom:16px;font-size:14px">
    Sayfa: <a href="../gizlilik" target="_blank" style="color:var(--ap)">/gizlilik</a> ·
    Başlık için <code>&lt;h2&gt;</code>, paragraf için <code>&lt;p&gt;</code>, liste için <code>&lt;ul&gt;&lt;li&gt;</code> kullanın.<br>
    Otomatik değişen yer tutucular: <code>{FIRMA}</code> <code>{ADRES}</code> <code>{ADRES2}</code> <code>{TELEFON}</code> <code>{EPOSTA}</code>
    — bunları yazarsanız güncel firma bilgileriyle doldurulur.
  </p>
  <form method="post" action="index.php?p=ayarlar">
    <?= csrf_alani() ?>
    <input type="hidden" name="islem" value="gizlilik_kaydet">
    <div class="field" style="max-width:420px">
      <label>Son güncelleme tarihi</label>
      <input name="gizlilik_tarih" value="<?= e($a['gizlilik_tarih'] ?? '') ?>" placeholder="1 Eylül 2026">
    </div>
    <div class="field">
      <label>Metin (HTML)</label>
      <textarea name="gizlilik" rows="22" style="font-family:Consolas,monospace;font-size:13px;line-height:1.6"><?= e($a['gizlilik'] ?? '') ?></textarea>
    </div>
    <div class="actions">
      <button class="btn">Metni Kaydet</button>
      <button class="btn sec" name="islem" value="gizlilik_sifirla"
              onclick="return confirm('Metin varsayılan hâline döndürülsün mü? Yaptığınız değişiklikler kaybolur.')">Varsayılana Döndür</button>
    </div>
  </form>
</div>

<div class="panel mb0">
  <h2>Şifre değiştir</h2>
  <form method="post" action="index.php?p=ayarlar">
    <?= csrf_alani() ?>
    <input type="hidden" name="islem" value="sifre_degistir">
    <div class="field" style="max-width:420px"><label>Mevcut şifre</label><input type="password" name="mevcut" required></div>
    <div class="grid2" style="max-width:420px">
      <div class="field"><label>Yeni şifre</label><input type="password" name="yeni" required></div>
      <div class="field"><label>Yeni şifre (tekrar)</label><input type="password" name="yeni2" required></div>
    </div>
    <div class="actions"><button class="btn">Şifreyi güncelle</button></div>
  </form>
</div>
