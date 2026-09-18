<?php
/* =========================================================
   Elite Parke — Veritabanı bağlantısı (PDO / MySQL)
   Canlıda buradaki bilgileri hosting'inkilerle değiştirin.
   ========================================================= */
if (!defined('GUVENLIK')) { die('Direkt erişim yok.'); }

define('DB_HOST', '127.0.0.1');
define('DB_AD',   'elite_parke');
define('DB_KULLANICI', 'root');
define('DB_SIFRE', '');

function db(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $pdo = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_AD . ';charset=utf8mb4',
                DB_KULLANICI,
                DB_SIFRE,
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]
            );
        } catch (PDOException $e) {
            http_response_code(500);
            die('Veritabanına bağlanılamadı. Lütfen baglan.php ayarlarını ve elite_parke.sql içe aktarımını kontrol edin.');
        }
    }
    return $pdo;
}
