<?php if (!defined('GUVENLIK')) { die('Direkt erişim yok.'); } ?>

<div class="ph ph-dark">
  <div class="wrap">
    <div class="label">İletişim</div>
    <h1>Bize ulaşın</h1>
    <div class="alt">Marmaris &amp; Bodrum · <?= e(TELEFON) ?></div>
  </div>
</div>

<section class="contact">
  <div class="wrap c-grid">
    <div class="c-info">
      <div class="label">Bize ulaşın</div>
      <h2>Elite Parke</h2>
      <p>Sorularınız için arayın ya da formu doldurun. Marmaris ve Bodrum showroomlarımızda hizmetinizdeyiz.</p>
      <div class="c-line"><small>Telefon</small><b><a href="tel:<?= e(TELEFON_RAW) ?>"><?= e(TELEFON) ?></a></b></div>
      <div class="c-line"><small>E-posta</small><b><a href="mailto:<?= e(EMAIL) ?>"><?= e(EMAIL) ?></a></b></div>
      <div class="c-line"><small>Çalışma saatleri</small><b><?= e(CALISMA) ?></b></div>
      <div style="margin-top:20px;display:flex;gap:12px;flex-wrap:wrap">
        <a class="btn-ana" href="tel:<?= e(TELEFON_RAW) ?>">Hemen Ara</a>
        <a class="btn-cizgi" href="<?= e(WA_LINK) ?>" target="_blank" rel="noopener">WhatsApp</a>
      </div>
    </div>

    <form method="post" action="gonder.php">
      <?php if (isset($_GET['gonderildi'])): ?>
        <div class="alert">Teşekkürler! Talebiniz alındı, en kısa sürede size döneceğiz. ✓</div>
      <?php elseif (isset($_GET['hata'])): ?>
        <div class="alert err">Lütfen ad, telefon ve ürün alanlarını eksiksiz doldurun.</div>
      <?php endif; ?>

      <div class="frow">
        <div><label>Ad Soyad</label><input name="ad" required placeholder="Adınız" value="<?= e($_GET['ad'] ?? '') ?>"></div>
        <div><label>Telefon</label><input name="telefon" required placeholder="05__ ___ __ __" value="<?= e($_GET['tel'] ?? '') ?>"></div>
      </div>
      <label>İlgilendiğiniz ürün</label>
      <select name="urun">
        <?php foreach ($URUNLER as $u): ?>
          <option><?= e($u['baslik']) ?></option>
        <?php endforeach; ?>
      </select>
      <label>Mesajınız</label>
      <textarea name="mesaj" rows="4" placeholder="Projeniz hakkında..."></textarea>
      <button class="btn" type="submit">Keşif Talebi Gönder</button>
    </form>
  </div>
</section>

<!-- ===== ŞUBELER ===== -->
<section class="section-paper">
  <div class="wrap">
    <div class="sec-head">
      <div class="rule"></div>
      <div class="label">Şubelerimiz</div>
      <h2>Marmaris & Bodrum</h2>
    </div>
    <div class="showroomlar">
      <div class="sr-kart">
        <div class="et">Marmaris Şube</div>
        <h3>Marmaris</h3>
        <div class="sr-row"><b>Adres:</b> <?= e(ADRES) ?></div>
        <div class="sr-row"><b>Telefon:</b> <?= e(TELEFON) ?></div>
        <div class="sr-row"><b>Saatler:</b> <?= e(CALISMA) ?></div>
        <div class="sr-cta"><a class="btn-cizgi" href="tel:<?= e(TELEFON_RAW) ?>">Ara</a></div>
      </div>
      <?php if (ADRES2): ?>
      <div class="sr-kart">
        <div class="et">Bodrum Şube</div>
        <h3>Bodrum</h3>
        <div class="sr-row"><b>Adres:</b> <?= e(ADRES2) ?></div>
        <div class="sr-row"><b>Telefon:</b> <?= e(TELEFON) ?></div>
        <div class="sr-row"><b>Saatler:</b> <?= e(CALISMA) ?></div>
        <div class="sr-cta"><a class="btn-cizgi" href="tel:<?= e(TELEFON_RAW) ?>">Ara</a></div>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>
