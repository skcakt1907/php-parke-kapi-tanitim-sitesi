<?php
if (!defined('GUVENLIK')) { die('Direkt erişim yok.'); }
$rows = db()->query("SELECT tarih, ad, telefon, urun, mesaj FROM mesajlar ORDER BY id DESC")->fetchAll();
?>
<div class="panel mb0">
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px">
    <h2 style="margin:0">Gelen mesajlar (<?= count($rows) ?>)</h2>
    <?php if ($rows): ?>
    <form method="post" action="index.php?p=mesajlar" onsubmit="return confirm('Tüm mesajlar kalıcı olarak silinsin mi?')">
      <?= csrf_alani() ?>
      <input type="hidden" name="islem" value="mesaj_temizle">
      <button class="btn sm danger">Tümünü temizle</button>
    </form>
    <?php endif; ?>
  </div>

  <?php if (!$rows): ?>
    <p class="muted">Henüz mesaj yok. İletişim formundan gelen talepler burada listelenir.</p>
  <?php else: ?>
    <table>
      <thead><tr><th style="width:150px">Tarih</th><th>Ad</th><th>Telefon</th><th>Ürün</th><th>Mesaj</th></tr></thead>
      <tbody>
        <?php foreach ($rows as $r): ?>
          <tr>
            <td class="muted"><?= e($r['tarih']) ?></td>
            <td><strong><?= e($r['ad']) ?></strong></td>
            <td><a href="tel:<?= e(preg_replace('/\D+/', '', $r['telefon'] ?? '')) ?>"><?= e($r['telefon']) ?></a></td>
            <td><?= e($r['urun']) ?></td>
            <td class="muted"><?= e($r['mesaj']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
