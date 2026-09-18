<?php
if (!defined('GUVENLIK')) { die('Direkt erişim yok.'); }
$SITE = store_load();
$urunler = $SITE['urunler'];
$d = $_GET['d'] ?? '';                       // düzenlenecek index
$duzenle = ($d !== '' && isset($urunler[(int)$d])) ? $urunler[(int)$d] : null;
$siniflar = ['a1'=>'Kahve (a1)','a2'=>'Gri (a2)','a3'=>'Açık ahşap (a3)','a4'=>'Koyu ahşap (a4)'];
?>
<div class="panel">
  <h2><?= $duzenle ? 'Ürünü düzenle' : 'Yeni ürün ekle' ?></h2>
  <form method="post" action="index.php?p=urunler" enctype="multipart/form-data">
    <?= csrf_alani() ?>
    <input type="hidden" name="islem" value="urun_kaydet">
    <?php if ($duzenle): ?><input type="hidden" name="idx" value="<?= (int)$d ?>"><?php endif; ?>
    <input type="hidden" name="gorsel_mevcut" value="<?= e($duzenle['gorsel'] ?? '') ?>">
    <div class="grid2">
      <div class="field"><label>Sıra No</label><input name="no" value="<?= e($duzenle['no'] ?? '') ?>" placeholder="05"></div>
      <div class="field"><label>Başlık *</label><input name="baslik" required value="<?= e($duzenle['baslik'] ?? '') ?>" placeholder="Çelik Kapı"></div>
    </div>
    <div class="field"><label>Açıklama</label><textarea name="aciklama" rows="2" placeholder="Kısa açıklama..."><?= e($duzenle['aciklama'] ?? '') ?></textarea></div>
    <div class="grid2">
      <div class="field">
        <label>Renk teması (görsel yoksa)</label>
        <select name="sinif">
          <?php foreach ($siniflar as $k => $v): ?>
            <option value="<?= $k ?>" <?= ($duzenle['sinif'] ?? 'a1') === $k ? 'selected' : '' ?>><?= e($v) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="field">
        <label>Görsel (JPG/PNG/WEBP, ops.)</label>
        <input type="file" name="gorsel" accept="image/jpeg,image/png,image/webp">
        <?php if (!empty($duzenle['gorsel'])): ?><small class="muted">Mevcut: <?= e($duzenle['gorsel']) ?></small><?php endif; ?>
      </div>
    </div>
    <div class="actions">
      <button class="btn"><?= $duzenle ? 'Güncelle' : 'Ekle' ?></button>
      <?php if ($duzenle): ?><a class="btn sec" href="index.php?p=urunler">İptal</a><?php endif; ?>
    </div>
  </form>
</div>

<div class="panel mb0">
  <h2>Ürünler (<?= count($urunler) ?>)</h2>
  <table>
    <thead><tr><th>#</th><th>Görsel</th><th>Başlık</th><th>Açıklama</th><th style="width:160px">İşlem</th></tr></thead>
    <tbody>
      <?php foreach ($urunler as $i => $u): ?>
        <tr>
          <td><?= e($u['no']) ?></td>
          <td>
            <?php if (!empty($u['gorsel'])): ?>
              <img class="swatch" style="object-fit:cover" src="../assets/img/<?= e($u['gorsel']) ?>" alt="">
            <?php else: ?>
              <div class="swatch sw-<?= e($u['sinif']) ?>"></div>
            <?php endif; ?>
          </td>
          <td><strong><?= e($u['baslik']) ?></strong></td>
          <td class="muted"><?= e($u['aciklama']) ?></td>
          <td>
            <div class="row-act">
              <a class="btn sm sec" href="index.php?p=urunler&d=<?= $i ?>">Düzenle</a>
              <form method="post" action="index.php?p=urunler" onsubmit="return confirm('Bu ürün silinsin mi?')">
                <?= csrf_alani() ?>
                <input type="hidden" name="islem" value="urun_sil">
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
