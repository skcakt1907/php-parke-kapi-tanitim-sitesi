<?php if (!defined('GUVENLIK')) { die('Direkt erişim yok.'); } ?>
<footer>
  <div class="wrap">
    <a class="logo" href="./">
      <img src="assets/img/logo.png?v=<?= @filemtime(__DIR__.'/../assets/img/logo.png') ?>" alt="<?= e(SITE_AD) ?>">
    </a>
    <div class="fnav">
      <?php foreach ($MENU as $m): ?>
        <a href="<?= e($m['key']) ?>"><?= e($m['baslik']) ?></a>
      <?php endforeach; ?>
    </div>
    <div style="margin:4px 0 18px"><a class="yasal-link" href="gizlilik">Gizlilik Politikası (KVKK)</a></div>
    <div><?= e(TELEFON) ?> · <?= e(EMAIL) ?></div>
    <div style="margin-top:6px">Marmaris: <?= e(ADRES) ?></div>
    <?php if (ADRES2): ?><div>Bodrum: <?= e(ADRES2) ?></div><?php endif; ?>
    <div style="margin-top:10px">© <?= e(YIL) ?> <?= e(FIRMA_TAM) ?> · Tasarım: DN Kreatif</div>
  </div>
</footer>

<!-- Yüzen WhatsApp butonu -->
<a class="wa-float" href="<?= e(WA_LINK) ?>" target="_blank" rel="noopener" aria-label="WhatsApp ile yazın">
  <svg viewBox="0 0 32 32" width="30" height="30" fill="currentColor" aria-hidden="true"><path d="M16 3C9.4 3 4 8.3 4 14.9c0 2.6.8 5 2.3 7L4 29l7.3-2.3c1.9 1 3.9 1.5 4.7 1.5 6.6 0 12-5.3 12-11.9S22.6 3 16 3zm0 21.8c-1.4 0-3.2-.5-4.6-1.3l-.5-.3-4.3 1.4 1.4-4.2-.3-.5c-1.2-1.7-1.8-3.6-1.8-5.6 0-5.4 4.5-9.8 10.1-9.8s10.1 4.4 10.1 9.8-4.5 10.5-10.1 10.5zm5.5-7.4c-.3-.2-1.8-.9-2-1-.3-.1-.5-.2-.7.2-.2.3-.8 1-.9 1.1-.2.2-.3.2-.6.1-.3-.2-1.3-.5-2.4-1.5-.9-.8-1.5-1.8-1.7-2.1-.2-.3 0-.5.1-.6l.5-.5c.1-.2.2-.3.3-.5.1-.2 0-.4 0-.6-.1-.2-.7-1.7-1-2.3-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4-.3.3-1.1 1-1.1 2.5s1.1 2.9 1.3 3.1c.2.2 2.2 3.4 5.4 4.8.8.3 1.4.5 1.8.7.8.2 1.5.2 2 .1.6-.1 1.8-.8 2.1-1.5.3-.7.3-1.3.2-1.5-.1-.1-.3-.2-.6-.4z"/></svg>
</a>

</body>
</html>
