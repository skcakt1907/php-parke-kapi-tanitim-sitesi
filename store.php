<?php
/* =========================================================
   Elite Parke — Veri katmanı (MySQL)
   Hem frontend (config.php) hem admin bu dosyayı kullanır.
   store_load()/store_save() arayüzü aynı kaldı; artık DB'ye gider.
   ========================================================= */
if (!defined('GUVENLIK')) { die('Direkt erişim yok.'); }

require_once __DIR__ . '/baglan.php';

/* Ayarlar için varsayılanlar (DB'de eksik anahtar olursa tamamlanır) */
function store_ayar_varsayilan(): array {
    return [
        'site_ad'   => 'Elite Parke',
        'firma_tam' => 'Elite Parke Dekorasyon Tur. Tic. İnş. İth. İhr. San. Ltd. Şti.',
        'tagline'   => 'Yangın Kapısı · Çelik Kapı · İç Oda Kapısı',
        'telefon'   => '0252 412 08 09',
        'whatsapp'  => '',
        'email'     => 'info@ornek-parke.com',
        'adres'     => 'Armutalan, Namık Kemal Cd. No: 1A Bina No: 609148325, Marmaris/Muğla',
        'adres2'    => 'Konacık, Atatürk Blv. Pamir İş Merkezi No: 114/1, 4 Bodrum/Muğla',
        'calisma'   => 'Pzt–Cmt 09:00–18:00',
        'gizlilik_tarih' => '1 Eylül 2026',
        'gizlilik'  => gizlilik_varsayilan(),
    ];
}

/* Gizlilik politikası varsayılan metni (panelden düzenlenebilir).
   Yer tutucular render sırasında güncel ayarlarla değiştirilir:
   {FIRMA} {ADRES} {ADRES2} {TELEFON} {EPOSTA} */
function gizlilik_varsayilan(): string {
    return <<<HTML
<p>Bu Gizlilik Politikası, <strong>{FIRMA}</strong> ("Elite Parke", "biz") tarafından işletilen ornek-parke.com internet sitesi ve bu site üzerinden veya reklamlarımız aracılığıyla toplanan kişisel verilerin, 6698 sayılı Kişisel Verilerin Korunması Kanunu ("KVKK") kapsamında nasıl işlendiğini açıklamaktadır.</p>

<h2>1. Veri Sorumlusu</h2>
<p><strong>Unvan:</strong> {FIRMA}</p>
<p><strong>Adresler:</strong></p>
<ul>
  <li>Marmaris: {ADRES}</li>
  <li>Bodrum: {ADRES2}</li>
</ul>
<p><strong>Telefon:</strong> {TELEFON}<br><strong>E-posta:</strong> {EPOSTA}</p>

<h2>2. Toplanan Kişisel Veriler</h2>
<p>Sitemizi ziyaret ettiğinizde, iletişim formlarımızı veya reklamlarımız üzerindeki formları doldurduğunuzda aşağıdaki verileri toplayabiliriz:</p>
<ul>
  <li>Ad, soyad</li>
  <li>Telefon numarası</li>
  <li>İşletme türü (otel, site yönetimi, inşaat firması vb.)</li>
  <li>E-posta adresi (paylaşılması hâlinde)</li>
  <li>Sitemizi nasıl kullandığınıza dair teknik veriler (IP adresi, tarayıcı bilgisi, çerezler aracılığıyla toplanan kullanım verileri)</li>
</ul>

<h2>3. Verilerin Toplanma Amacı</h2>
<p>Kişisel verileriniz aşağıdaki amaçlarla işlenir:</p>
<ul>
  <li>Talep ettiğiniz ücretsiz keşif ve fiyat teklifi süreçlerini yürütmek</li>
  <li>Sizinle iletişime geçmek ve sorularınızı yanıtlamak</li>
  <li>Hizmet kalitemizi ve müşteri deneyimini iyileştirmek</li>
  <li>Yasal yükümlülüklerimizi yerine getirmek</li>
  <li>Onay vermeniz hâlinde, ürün ve kampanyalarımız hakkında bilgilendirme yapmak</li>
</ul>

<h2>4. Verilerin Paylaşılması</h2>
<p>Kişisel verileriniz, yasal zorunluluklar dışında açık rızanız olmadan üçüncü kişilerle paylaşılmaz. Reklam ve pazarlama faaliyetlerimiz kapsamında Meta (Facebook/Instagram) gibi platformlarla sınırlı ve anonim teknik veriler (örneğin site ziyaret bilgisi) paylaşılabilir; bu paylaşım ilgili platformların kendi gizlilik politikalarına tabidir.</p>

<h2>5. Verilerin Saklanma Süresi</h2>
<p>Kişisel verileriniz, işlenme amacının gerektirdiği süre boyunca ve yasal saklama yükümlülüklerimiz çerçevesinde saklanır; bu sürenin sonunda silinir, yok edilir veya anonim hâle getirilir.</p>

<h2>6. Çerezler</h2>
<p>Sitemiz, kullanıcı deneyimini iyileştirmek ve reklamlarımızın etkinliğini ölçmek amacıyla çerezler ve benzeri teknolojiler (ör. Meta Pixel) kullanabilir. Tarayıcı ayarlarınızdan çerez tercihlerinizi yönetebilirsiniz.</p>

<h2>7. KVKK Kapsamındaki Haklarınız</h2>
<p>KVKK'nın 11. maddesi uyarınca şu haklara sahipsiniz:</p>
<ul>
  <li>Kişisel verilerinizin işlenip işlenmediğini öğrenme</li>
  <li>İşlenmişse buna ilişkin bilgi talep etme</li>
  <li>İşlenme amacını ve amacına uygun kullanılıp kullanılmadığını öğrenme</li>
  <li>Yurt içinde veya yurt dışında verilerin aktarıldığı üçüncü kişileri bilme</li>
  <li>Eksik veya yanlış işlenmişse düzeltilmesini isteme</li>
  <li>KVKK'da öngörülen şartlar çerçevesinde silinmesini veya yok edilmesini isteme</li>
  <li>Düzeltme, silme ve yok edilme işlemlerinin verilerin aktarıldığı üçüncü kişilere bildirilmesini isteme</li>
  <li>İşlenen verilerin münhasıran otomatik sistemler vasıtasıyla analiz edilmesi durumunda aleyhinize bir sonucun ortaya çıkmasına itiraz etme</li>
  <li>Kanuna aykırı işlenmesi sebebiyle zarara uğramanız hâlinde zararın giderilmesini talep etme</li>
</ul>
<p>Bu haklarınızı kullanmak için {EPOSTA} adresinden bizimle iletişime geçebilirsiniz.</p>

<h2>8. Değişiklikler</h2>
<p>Bu Gizlilik Politikası zaman zaman güncellenebilir. Güncel hâli her zaman bu sayfa üzerinden yayınlanır.</p>
HTML;
}

/* Tüm site verisini DB'den yükle (config.php ve admin bu şekli bekler) */
function store_load(): array {
    $pdo = db();

    $ayarlar = store_ayar_varsayilan();
    foreach ($pdo->query("SELECT anahtar, deger FROM ayarlar") as $r) {
        $ayarlar[$r['anahtar']] = $r['deger'];
    }

    $urunler     = $pdo->query("SELECT no, baslik, sinif, gorsel, aciklama FROM urunler ORDER BY sira, id")->fetchAll();
    $referanslar = $pdo->query("SELECT yorum, ad, yer FROM referanslar ORDER BY sira, id")->fetchAll();

    return ['ayarlar' => $ayarlar, 'urunler' => $urunler, 'referanslar' => $referanslar];
}

/* Tüm veriyi kaydet (ayarlar upsert; ürün/referans tam yenile) — işlem içinde */
function store_save(array $data): bool {
    $pdo = db();
    try {
        $pdo->beginTransaction();

        // Ayarlar (upsert)
        $st = $pdo->prepare("INSERT INTO ayarlar (anahtar, deger) VALUES (?, ?)
                             ON DUPLICATE KEY UPDATE deger = VALUES(deger)");
        foreach (($data['ayarlar'] ?? []) as $k => $v) { $st->execute([$k, $v]); }

        // Ürünler (sil + yeniden ekle, sırayı koru)
        $pdo->exec("DELETE FROM urunler");
        $st = $pdo->prepare("INSERT INTO urunler (no, baslik, sinif, gorsel, aciklama, sira)
                             VALUES (?, ?, ?, ?, ?, ?)");
        $i = 0;
        foreach (($data['urunler'] ?? []) as $u) {
            $st->execute([$u['no'] ?? '', $u['baslik'] ?? '', $u['sinif'] ?? 'a1', $u['gorsel'] ?? '', $u['aciklama'] ?? '', $i++]);
        }

        // Referanslar (sil + yeniden ekle)
        $pdo->exec("DELETE FROM referanslar");
        $st = $pdo->prepare("INSERT INTO referanslar (yorum, ad, yer, sira) VALUES (?, ?, ?, ?)");
        $i = 0;
        foreach (($data['referanslar'] ?? []) as $r) {
            $st->execute([$r['yorum'] ?? '', $r['ad'] ?? '', $r['yer'] ?? '', $i++]);
        }

        $pdo->commit();
        return true;
    } catch (Throwable $e) {
        if ($pdo->inTransaction()) { $pdo->rollBack(); }
        return false;
    }
}
