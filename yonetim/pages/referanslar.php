<?php
if (!defined('GUVENLIK')) { die('Direkt erişim yok.'); }
$SITE = store_load();
$refler = $SITE['referanslar'];
$d = $_GET['d'] ?? '';
$duzenle = ($d !== '' && isset($refler[(int)$d])) ? $refler[(int)$d] : null;
?>
<div class="panel">
  <h2><?= $duzenle ? 'Referansı düzenle' : 'Yeni referans ekle' ?></h2>
  <form method="post" action="index.php?p=referanslar">
    <?= csrf_alani() ?>
    <input type="hidden" name="islem" value="ref_kaydet">
    <?php if ($duzenle): ?><input type="hidden" name="idx" value="<?= (int)$d ?>"><?php endif; ?>
    <div class="field"><label>Yorum *</label><textarea name="yorum" rows="2" required placeholder="Müşteri yorumu..."><?= e($duzenle['yorum'] ?? '') ?></textarea></div>
    <div class="grid2">
      <div class="field"><label>Ad *</label><input name="ad" required value="<?= e($duzenle['ad'] ?? '') ?>" placeholder="A. Yıldız"></div>
      <div class="field"><label>Yer / proje</label><input name="yer" value="<?= e($duzenle['yer'] ?? '') ?>" placeholder="Daire — Marmaris"></div>
    </div>
    <div class="actions">
      <button class="btn"><?= $duzenle ? 'Güncelle' : 'Ekle' ?></button>
      <?php if ($duzenle): ?><a class="btn sec" href="index.php?p=referanslar">İptal</a><?php endif; ?>
    </div>
  </form>
</div>

<div class="panel mb0">
  <h2>Referanslar (<?= count($refler) ?>)</h2>
  <table>
    <thead><tr><th>Yorum</th><th style="width:160px">Ad</th><th style="width:170px">Yer</th><th style="width:160px">İşlem</th></tr></thead>
    <tbody>
      <?php foreach ($refler as $i => $r): ?>
        <tr>
          <td>"<?= e($r['yorum']) ?>"</td>
          <td><strong><?= e($r['ad']) ?></strong></td>
          <td class="muted"><?= e($r['yer']) ?></td>
          <td>
            <div class="row-act">
              <a class="btn sm sec" href="index.php?p=referanslar&d=<?= $i ?>">Düzenle</a>
              <form method="post" action="index.php?p=referanslar" onsubmit="return confirm('Bu referans silinsin mi?')">
                <?= csrf_alani() ?>
                <input type="hidden" name="islem" value="ref_sil">
                <input type="hidden" name="idx" value="<?= $i ?>">
                <button class="btn sm danger">Sil</button>
              </form>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
