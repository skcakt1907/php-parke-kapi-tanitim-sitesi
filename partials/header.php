<?php if (!defined('GUVENLIK')) { die('Direkt erişim yok.'); } ?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <base href="<?= e(BASE) ?>">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($pageTitle ?? (SITE_AD . ' — Kapı ve Parke')) ?></title>
  <meta name="description" content="<?= e($pageDesc ?? 'Çelik kapı, yangın kapısı, laminant parke ve lamine kapıda üretimden montaja tek elden çözüm. ' . SITE_AD . '.') ?>">
  <meta name="keywords" content="çelik kapı, yangın kapısı, laminant parke, lamine kapı, elite parke">
  <meta property="og:title" content="<?= e($pageTitle ?? SITE_AD) ?>">
  <meta property="og:description" content="<?= e($pageDesc ?? 'Kapı ve parkede tek elden çözüm.') ?>">
  <meta property="og:type" content="website">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:opsz,wght@8..60,400;8..60,500;8..60,600;8..60,700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
  <link href="assets/css/style.css?v=<?= @filemtime(__DIR__.'/../assets/css/style.css') ?>" rel="stylesheet">
</head>
<body>

<div class="masthead">
  <div class="wrap">
    <div class="mt-top">
      <span>Marmaris · Bodrum</span>
      <span>Kapı ve Parke</span>
    </div>
    <div class="mt-main">
      <a class="logo" href="./">
        <img src="assets/img/logo.png?v=<?= @filemtime(__DIR__.'/../assets/img/logo.png') ?>" alt="<?= e(SITE_AD) ?> — Yangın Kapısı · Çelik Kapı · İç Oda Kapısı">
      </a>
    </div>
  </div>
</div>

<nav class="menu">
  <div class="wrap">
    <?php foreach ($MENU as $m): ?>
      <a class="<?= (($sayfa ?? '') === $m['key']) ? 'aktif' : '' ?>" href="<?= e($m['key']) ?>"><?= e($m['baslik']) ?></a>
    <?php endforeach; ?>
  </div>
</nav>
