<?php if (!defined('GUVENLIK')) { die('Direkt erişim yok.'); } ?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Giriş — <?= e(SITE_AD) ?> Yönetim</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:opsz,wght@8..60,600;8..60,700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <link href="css/admin.css?v=<?= @filemtime(__DIR__.'/../css/admin.css') ?>" rel="stylesheet">
</head>
<body>
<div class="login-wrap">
  <form class="login-card" method="post" action="index.php">
    <div class="logo"><img src="../assets/img/logo.png?v=<?= @filemtime(dirname(__DIR__,2).'/assets/img/logo.png') ?>" alt="<?= e(SITE_AD) ?>"></div>
    <div class="sub">Yönetim Paneli</div>
    <?php if (!empty($girisHata)): ?><div class="flash err"><?= e($girisHata) ?></div><?php endif; ?>
    <input type="hidden" name="islem" value="giris">
    <div class="field">
      <label>E-posta</label>
      <input type="email" name="kullanici" autofocus required placeholder="ornek@ornek-parke.com">
    </div>
    <div class="field">
      <label>Şifre</label>
      <input type="password" name="sifre" required placeholder="••••••••">
    </div>
    <button class="btn" style="width:100%;justify-content:center;margin-top:6px">Giriş Yap</button>
  </form>
</div>
</body>
</html>
