<?php
if (!defined('GUVENLIK')) { die('Direkt erişim yok.'); }
$nav = [
    'dashboard'   => ['Panel',       '▦'],
    'urunler'     => ['Ürünler',     '▤'],
    'referanslar' => ['Referanslar', '★'],
    'mesajlar'    => ['Mesajlar',    '✉'],
    'ayarlar'     => ['Ayarlar',     '⚙'],
];
$basliklar = ['dashboard'=>'Panel','urunler'=>'Ürünler','referanslar'=>'Referanslar','mesajlar'=>'Mesajlar','ayarlar'=>'Ayarlar'];
$f = flash_get();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($basliklar[$p] ?? 'Panel') ?> — <?= e(SITE_AD) ?> Yönetim</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:opsz,wght@8..60,600;8..60,700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <link href="css/admin.css?v=<?= @filemtime(__DIR__.'/../css/admin.css') ?>" rel="stylesheet">
</head>
<body>
<div class="layout">
  <aside class="sidebar">
    <div class="brand">Elite <i>Parke</i></div>
    <nav>
      <?php foreach ($nav as $key => $it): ?>
        <a class="<?= $p === $key ? 'active' : '' ?>" href="index.php?p=<?= $key ?>">
          <span class="ic"><?= $it[1] ?></span><?= e($it[0]) ?>
        </a>
      <?php endforeach; ?>
    </nav>
    <div class="out">
      <a href="../index.php" target="_blank">↗ Siteyi gör</a>
      <a href="index.php?islem=cikis">⏻ Çıkış</a>
    </div>
  </aside>
  <main class="main">
    <div class="topbar">
      <h1><?= e($basliklar[$p] ?? 'Panel') ?></h1>
      <div class="right">Merhaba, <strong><?= e($_SESSION['elite_admin']) ?></strong></div>
    </div>
    <?php if ($f): ?><div class="flash <?= $f['tip'] === 'ok' ? 'ok' : 'err' ?>"><?= e($f['msg']) ?></div><?php endif; ?>
