<?php
/* =========================================================
   Elite Parke — Admin Front Controller
   ========================================================= */
define('GUVENLIK', true);
require_once dirname(__DIR__) . '/config.php';   // store + sabitler + e()
require_once __DIR__ . '/inc/auth.php';
session_start();

/* ---------- Çıkış ---------- */
if (($_GET['islem'] ?? '') === 'cikis') {
    $_SESSION = [];
    session_destroy();
    header('Location: index.php?p=login');
    exit;
}

$admin = admin_load();

/* ---------- Giriş işlemi ---------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['islem'] ?? '') === 'giris') {
    $ku = trim($_POST['kullanici'] ?? '');
    $sf = (string)($_POST['sifre'] ?? '');
    if ($ku === $admin['kullanici'] && password_verify($sf, $admin['sifre_hash'])) {
        session_regenerate_id(true);
        $_SESSION['elite_admin'] = $admin['kullanici'];
        header('Location: index.php?p=dashboard');
        exit;
    }
    $girisHata = 'Kullanıcı adı veya şifre hatalı.';
}

$p = $_GET['p'] ?? 'dashboard';

/* ---------- Giriş yoksa login ekranı ---------- */
if (!admin_giris_mi()) {
    require __DIR__ . '/pages/login.php';
    exit;
}

/* ====================================================
   KORUMALI İŞLEMLER (CSRF zorunlu)
   ==================================================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['islem'])) {
    if (!csrf_dogrula()) {
        flash_set('err', 'Oturum doğrulaması başarısız (CSRF). Tekrar deneyin.');
        header('Location: index.php?p=' . urlencode($p));
        exit;
    }
    $SITE = store_load();
    $islem = $_POST['islem'];

    /* --- Ayarlar kaydet --- */
    if ($islem === 'ayarlar_kaydet') {
        foreach (['site_ad','firma_tam','tagline','telefon','whatsapp','email','adres','adres2','calisma'] as $k) {
            $SITE['ayarlar'][$k] = trim($_POST[$k] ?? '');
        }
        store_save($SITE);
        flash_set('ok', 'Ayarlar kaydedildi.');
        header('Location: index.php?p=ayarlar'); exit;
    }

    /* --- Gizlilik politikası metni --- */
    if ($islem === 'gizlilik_kaydet') {
        $SITE['ayarlar']['gizlilik']       = trim($_POST['gizlilik'] ?? '');
        $SITE['ayarlar']['gizlilik_tarih'] = trim($_POST['gizlilik_tarih'] ?? '');
        store_save($SITE);
        flash_set('ok', 'Gizlilik politikası metni kaydedildi.');
        header('Location: index.php?p=ayarlar'); exit;
    }

    if ($islem === 'gizlilik_sifirla') {
        $SITE['ayarlar']['gizlilik'] = gizlilik_varsayilan();
        store_save($SITE);
        flash_set('ok', 'Gizlilik metni varsayılan hâline döndürüldü.');
        header('Location: index.php?p=ayarlar'); exit;
    }

    /* --- Şifre değiştir --- */
    if ($islem === 'sifre_degistir') {
        $mevcut = (string)($_POST['mevcut'] ?? '');
        $yeni   = (string)($_POST['yeni'] ?? '');
        $yeni2  = (string)($_POST['yeni2'] ?? '');
        if (!password_verify($mevcut, $admin['sifre_hash'])) {
            flash_set('err', 'Mevcut şifre hatalı.');
        } elseif (strlen($yeni) < 6) {
            flash_set('err', 'Yeni şifre en az 6 karakter olmalı.');
        } elseif ($yeni !== $yeni2) {
            flash_set('err', 'Yeni şifreler eşleşmiyor.');
        } else {
            $admin['sifre_hash'] = password_hash($yeni, PASSWORD_DEFAULT);
            admin_save($admin);
            flash_set('ok', 'Şifre güncellendi.');
        }
        header('Location: index.php?p=ayarlar'); exit;
    }

    /* --- Ürün kaydet (ekle/düzenle) --- */
    if ($islem === 'urun_kaydet') {
        $idx = $_POST['idx'] ?? '';
        $urun = [
            'no'       => trim($_POST['no'] ?? ''),
            'baslik'   => trim($_POST['baslik'] ?? ''),
            'sinif'    => in_array($_POST['sinif'] ?? '', ['a1','a2','a3','a4'], true) ? $_POST['sinif'] : 'a1',
            'gorsel'   => trim($_POST['gorsel_mevcut'] ?? ''),
            'aciklama' => trim($_POST['aciklama'] ?? ''),
        ];
        // Görsel yükleme (opsiyonel, güvenli)
        if (!empty($_FILES['gorsel']['tmp_name']) && is_uploaded_file($_FILES['gorsel']['tmp_name'])) {
            $yuklenen = gorsel_yukle($_FILES['gorsel']);
            if ($yuklenen === false) {
                flash_set('err', 'Görsel yüklenemedi (yalnızca JPG, PNG, WEBP).');
                header('Location: index.php?p=urunler'); exit;
            }
            $urun['gorsel'] = $yuklenen;
        }
        if ($urun['baslik'] === '') {
            flash_set('err', 'Ürün başlığı boş olamaz.');
            header('Location: index.php?p=urunler'); exit;
        }
        if ($idx !== '' && isset($SITE['urunler'][(int)$idx])) {
            $SITE['urunler'][(int)$idx] = $urun;
            flash_set('ok', 'Ürün güncellendi.');
        } else {
            $SITE['urunler'][] = $urun;
            flash_set('ok', 'Ürün eklendi.');
        }
        store_save($SITE);
        header('Location: index.php?p=urunler'); exit;
    }

    /* --- Ürün sil --- */
    if ($islem === 'urun_sil') {
        $idx = (int)($_POST['idx'] ?? -1);
        if (isset($SITE['urunler'][$idx])) {
            array_splice($SITE['urunler'], $idx, 1);
            store_save($SITE);
            flash_set('ok', 'Ürün silindi.');
        }
        header('Location: index.php?p=urunler'); exit;
    }

    /* --- Referans kaydet (ekle/düzenle) --- */
    if ($islem === 'ref_kaydet') {
        $idx = $_POST['idx'] ?? '';
        $ref = [
            'yorum' => trim($_POST['yorum'] ?? ''),
            'ad'    => trim($_POST['ad'] ?? ''),
            'yer'   => trim($_POST['yer'] ?? ''),
        ];
        if ($ref['yorum'] === '' || $ref['ad'] === '') {
            flash_set('err', 'Yorum ve ad alanları zorunlu.');
            header('Location: index.php?p=referanslar'); exit;
        }
        if ($idx !== '' && isset($SITE['referanslar'][(int)$idx])) {
            $SITE['referanslar'][(int)$idx] = $ref;
            flash_set('ok', 'Referans güncellendi.');
        } else {
            $SITE['referanslar'][] = $ref;
            flash_set('ok', 'Referans eklendi.');
        }
        store_save($SITE);
        header('Location: index.php?p=referanslar'); exit;
    }

    /* --- Referans sil --- */
    if ($islem === 'ref_sil') {
        $idx = (int)($_POST['idx'] ?? -1);
        if (isset($SITE['referanslar'][$idx])) {
            array_splice($SITE['referanslar'], $idx, 1);
            store_save($SITE);
            flash_set('ok', 'Referans silindi.');
        }
        header('Location: index.php?p=referanslar'); exit;
    }

    /* --- Mesajları temizle --- */
    if ($islem === 'mesaj_temizle') {
        db()->exec("DELETE FROM mesajlar");
        flash_set('ok', 'Tüm mesajlar silindi.');
        header('Location: index.php?p=mesajlar'); exit;
    }
}

/* ====================================================
   Görsel yükleme yardımcısı (mime whitelist, rastgele ad)
   ==================================================== */
function gorsel_yukle(array $file) {
    if ($file['error'] !== UPLOAD_ERR_OK || $file['size'] > 4 * 1024 * 1024) { return false; }
    $izin = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file['tmp_name']);
    if (!isset($izin[$mime])) { return false; }
    $hedefDir = dirname(__DIR__) . '/assets/img';
    if (!is_dir($hedefDir)) { @mkdir($hedefDir, 0775, true); }
    $ad = 'urun-' . bin2hex(random_bytes(6)) . '.' . $izin[$mime];
    if (!move_uploaded_file($file['tmp_name'], $hedefDir . '/' . $ad)) { return false; }
    return $ad;
}

/* ---------- Sayfa render ---------- */
$gecerli = ['dashboard','urunler','referanslar','mesajlar','ayarlar'];
if (!in_array($p, $gecerli, true)) { $p = 'dashboard'; }

require __DIR__ . '/inc/head.php';
require __DIR__ . '/pages/' . $p . '.php';
require __DIR__ . '/inc/foot.php';
