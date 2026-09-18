/* =========================================================
   Elite Parke — veritabanı şeması + tohum veri
   KULLANIM (cPanel / paylaşımlı hosting):
     1) cPanel > MySQL Databases > veritabanı oluştur (ör. elikap_db)
        ve kullanıcıyı ALL PRIVILEGES ile ekle.
     2) phpMyAdmin'de soldan O veritabanını SEÇ.
     3) Import > bu dosyayı yükle (tabloları seçili DB'ye kurar).
   ========================================================= */

CREATE TABLE IF NOT EXISTS ayarlar (
  anahtar VARCHAR(50)  NOT NULL PRIMARY KEY,
  deger   TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS urunler (
  id       INT AUTO_INCREMENT PRIMARY KEY,
  no       VARCHAR(10)  DEFAULT '',
  baslik   VARCHAR(150) NOT NULL,
  sinif    VARCHAR(5)   DEFAULT 'a1',
  gorsel   VARCHAR(200) DEFAULT '',
  aciklama TEXT,
  sira     INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS referanslar (
  id    INT AUTO_INCREMENT PRIMARY KEY,
  yorum TEXT NOT NULL,
  ad    VARCHAR(100) NOT NULL,
  yer   VARCHAR(150) DEFAULT '',
  sira  INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS mesajlar (
  id      INT AUTO_INCREMENT PRIMARY KEY,
  tarih   DATETIME NOT NULL,
  ad      VARCHAR(100),
  telefon VARCHAR(40),
  urun    VARCHAR(100),
  mesaj   TEXT,
  ip      VARCHAR(45)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS yoneticiler (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  kullanici  VARCHAR(50) NOT NULL UNIQUE,
  sifre_hash VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO ayarlar (anahtar, deger) VALUES
  ('site_ad',   'Elite Parke'),
  ('firma_tam', 'Elite Parke Dekorasyon Tur. Tic. İnş. İth. İhr. San. Ltd. Şti.'),
  ('tagline',   'Yangın Kapısı · Çelik Kapı · İç Oda Kapısı'),
  ('telefon',   '0252 412 08 09'),
  ('whatsapp',  ''),
  ('email',     'info@ornek-parke.com'),
  ('adres',     'Armutalan, Namık Kemal Cd. No: 1A Bina No: 609148325, Marmaris/Muğla'),
  ('adres2',    'Konacık, Atatürk Blv. Pamir İş Merkezi No: 114/1, 4 Bodrum/Muğla'),
  ('calisma',   'Pzt–Cmt 09:00–18:00')
ON DUPLICATE KEY UPDATE anahtar = anahtar;

INSERT INTO urunler (no, baslik, sinif, gorsel, aciklama, sira) VALUES
  ('01', 'Çelik Kapı',     'a1', '', 'Çok kilit noktalı, özel desenli, yüksek güvenlikli giriş kapıları.', 1),
  ('02', 'Yangın Kapısı',  'a2', '', 'EI-60 / EI-120 sertifikalı, panik bar uyumlu güvenlik kapıları.',   2),
  ('03', 'Laminant Parke', 'a3', '', 'AC4–AC5 sınıfı, su geçirmez seçenekli, geniş renk paleti.',         3),
  ('04', 'İç Oda Kapısı',  'a4', '', 'Sessiz kapanan, nem dengeli iç mekân kapıları.',                    4);

INSERT INTO referanslar (yorum, ad, yer, sira) VALUES
  ('İşçilik kusursuz, ekip dakikti. Sonuç beklediğimizden çok iyi.',       'A. Yıldız',    'Daire — Marmaris', 1),
  ('Yangın kapısı sertifikaları eksiksizdi, denetimi tek seferde geçtik.', 'Demir İnşaat', 'Ticari — Muğla',   2),
  ('Parke seçiminde adeta danışmanımız oldular. Renk birebir uydu.',       'S. Kaya',      'Villa — İçmeler',  3);

INSERT INTO yoneticiler (kullanici, sifre_hash) VALUES
  ('info@ornek-parke.com', '$2y$10$abcdefghijklmnopqrstuvOaBcDeFgHiJkLmNoPqRsTuVwXyZ01234')
ON DUPLICATE KEY UPDATE kullanici = kullanici;
