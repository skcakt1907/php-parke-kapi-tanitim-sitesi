<?php
/* =========================================================
   Elite Parke Admin — Oturum, kimlik ve CSRF
   ========================================================= */
if (!defined('GUVENLIK')) { die('Direkt erişim yok.'); }

/* Yöneticiyi DB'den al; hiç yoksa varsayılanı (admin/elite2026) oluştur */
function admin_load(): array {
    $pdo = db();
    $row = $pdo->query("SELECT kullanici, sifre_hash FROM yoneticiler ORDER BY id LIMIT 1")->fetch();
    if ($row) { return $row; }
    $d = ['kullanici' => 'info@ornek-parke.com', 'sifre_hash' => password_hash('Elite.Prk!C85E40', PASSWORD_DEFAULT)];
    admin_save($d);
    return $d;
}

function admin_save(array $d): bool {
    $pdo = db();
    $row = $pdo->query("SELECT id FROM yoneticiler ORDER BY id LIMIT 1")->fetch();
    if ($row) {
        $st = $pdo->prepare("UPDATE yoneticiler SET kullanici = ?, sifre_hash = ? WHERE id = ?");
        return $st->execute([$d['kullanici'], $d['sifre_hash'], $row['id']]);
    }
    $st = $pdo->prepare("INSERT INTO yoneticiler (kullanici, sifre_hash) VALUES (?, ?)");
    return $st->execute([$d['kullanici'], $d['sifre_hash']]);
}

function admin_giris_mi(): bool {
    return !empty($_SESSION['elite_admin']);
}

function admin_zorunlu(): void {
    if (!admin_giris_mi()) { header('Location: index.php?p=login'); exit; }
}

/* --- CSRF --- */
function csrf_token(): string {
    if (empty($_SESSION['csrf'])) { $_SESSION['csrf'] = bin2hex(random_bytes(16)); }
    return $_SESSION['csrf'];
}
function csrf_alani(): string {
    return '<input type="hidden" name="csrf" value="' . csrf_token() . '">';
}
function csrf_dogrula(): bool {
    return isset($_POST['csrf']) && hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf']);
}

/* Kısa flash mesajı */
function flash_set(string $tip, string $msg): void { $_SESSION['flash'] = ['tip' => $tip, 'msg' => $msg]; }
function flash_get(): ?array { $f = $_SESSION['flash'] ?? null; unset($_SESSION['flash']); return $f; }
