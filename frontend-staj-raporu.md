# Front-End Staj Raporu

## Proje Hakkında Kısa Bilgi

Bu proje için geliştirilen ön yüz yapısı, envanter yönetimi amacıyla kullanılan sayfaların tarayıcı üzerinde düzenli, okunabilir ve etkileşimli biçimde sunulmasını sağlamıştır. Arayüzde karşılama sayfası, kullanıcı giriş ve kayıt ekranları, yönetim paneli, ürün listeleme ve ürün detay sayfaları, stok işlemleri, raporlar, bildirimler, ayarlar ve profil sayfaları yer almıştır. Sayfalar, kullanıcıların stok durumunu hızlıca inceleyebilmesi, ürünleri takip edebilmesi, işlem geçmişini görebilmesi ve temel hesap işlemlerini gerçekleştirebilmesi için düzenlenmiştir.

Ön yüz geliştirme sürecinde Blade şablonları içinde HTML5 yapısı kullanılmış, `resources/css/app.css` dosyasında CSS3 ile özel tema, kart, tablo, form ve responsive tasarım kuralları oluşturulmuştur. `resources/js/app.js` ve `resources/js/bootstrap.js` dosyaları üzerinden JavaScript tarafında Alpine.js ve Axios yapılandırması kullanılmıştır. Ayrıca yönetim ekranlarında Bootstrap, DataTables, Toastr, SweetAlert2, jQuery, Flexbox, CSS Grid ve Media Queries gibi teknolojilerden yararlanılmıştır.

## İnceleme Kapsamı

Bu rapor yalnızca projenin Front-End tarafını kapsamıştır. İnceleme sırasında HTML, CSS ve JavaScript ile ilişkili dosyalar, Blade görünüm sayfaları, ortak arayüz bileşenleri, tablo yapıları, form düzenleri, responsive davranışlar ve kullanıcı etkileşimleri değerlendirilmiştir. Arka uç işleyişi ve veri tabanı yapısı rapor kapsamı dışında bırakılmış, yalnızca tarayıcıda görünen arayüzün anlaşılması için gerekli olan sayfa bağlantıları ve görünüm dosyaları dikkate alınmıştır.

İnceleme kapsamında özellikle `resources/views`, `resources/css/app.css`, `resources/js/app.js`, `resources/js/bootstrap.js`, `vite.config.js` ve `tailwind.config.js` dosyaları değerlendirilmiştir. Yönetim paneli yerleşimi, misafir kullanıcı yerleşimi, ortak bileşenler, ürün ve işlem tabloları, modal pencereler, bildirim alanları ve mobil uyumluluk kuralları ön yüz açısından incelenmiştir.

## Gün 1: Front-End Dosya Yapısı ve Genel Arayüz İskeleti

### Yapılan Çalışmalar

İlk gün projenin ön yüz dosya yapısı incelenmiş ve arayüz geliştirme sürecinde kullanılan temel dosyalar düzenli bir bütün olarak ele alınmıştır. `resources/css/app.css`, `resources/js/app.js`, `resources/js/bootstrap.js`, `vite.config.js` ve `tailwind.config.js` dosyaları ön yüzün temel yapı taşları olarak değerlendirilmiştir. Bu yapı sayesinde stil dosyaları, JavaScript dosyaları ve derleme süreci tek bir düzen içinde yönetilebilir hale getirilmiştir.

Genel arayüz iskeleti için `resources/views/layouts/app.blade.php` ve `resources/views/layouts/guest.blade.php` dosyalarının temel görevleri belirlenmiştir. Oturum açmış kullanıcılar için ayrı bir yönetim düzeni, misafir kullanıcılar için ayrı bir tanıtım ve form düzeni kullanılmıştır. Böylece farklı kullanıcı durumlarına göre değişen ekranların aynı proje içinde tutarlı şekilde sunulması sağlanmıştır.

Bu çalışmanın arayüze katkısı, proje genelinde tekrar eden yapıların tek bir yerleşim mantığı altında toplanması olmuştur. Sayfaların aynı renk sistemi, yazı tipi, boşluk düzeni ve bileşen yaklaşımı ile görünmesi sağlanmış, kullanıcı deneyiminde görsel devamlılık oluşturulmuştur.

### Teknik Açıklama

CSS tarafında Tailwind direktifleri ile temel stil katmanı hazırlanmış, `:root` içinde özel renk değişkenleri tanımlanmıştır. `--bg`, `--panel`, `--text`, `--muted`, `--line`, `--primary`, `--primary-strong` ve `--accent` değişkenleri kullanılarak proje genelinde renk yönetimi düzenli hale getirilmiştir. Bu yaklaşım, farklı sayfalarda aynı renk dilinin korunmasına katkı sağlamıştır.

JavaScript tarafında `resources/js/app.js` dosyasında Alpine.js başlatılmış, `resources/js/bootstrap.js` dosyasında Axios yapılandırılmıştır. Vite üzerinden `resources/css/app.css` ve `resources/js/app.js` giriş dosyaları tanımlanmış, bu sayede ön yüz varlıklarının derleme süreci yapılandırılmıştır. HTML5, CSS3, JavaScript, Tailwind CSS, Vite ve Alpine.js kullanılmıştır.

### Rapora Eklenecek Görseller

- Kod Görseli: `resources/css/app.css` dosyasındaki Tailwind direktifleri ve `:root` renk değişkenleri.
- Arayüz Görseli: Projenin genel arka planı ve ilk yüklenen ekranın temel görünümü.

### Görsel Dosya Önerisi

- `gun-01-dosya-yapisi.png`
- `gun-01-css-temel-degiskenler.png`
- `gun-01-genel-arayuz-iskeleti.png`

## Gün 2: Yönetim Yerleşimi, Yan Menü ve Üst Bar

### Yapılan Çalışmalar

İkinci gün oturum açmış kullanıcıların kullandığı ana yönetim yerleşimi üzerinde çalışılmıştır. `resources/views/layouts/app.blade.php` dosyasında sayfanın genel HTML yapısı, sol menü alanı, ana içerik bölümü ve üst bar düzeni oluşturulmuştur. Sol menüde dashboard, ürünler, işlemler, raporlar, bildirimler ve yetkiye bağlı olarak ayarlar bağlantıları gösterilmiştir. Bu yapı, kullanıcının uygulama içindeki temel bölümlere hızlı biçimde ulaşmasını sağlamıştır.

`resources/views/layouts/navigation.blade.php` dosyasında üst bar alanı düzenlenmiştir. Bu alanda kullanıcının adı, e-posta bilgisi, profil bağlantısı ve çıkış butonu gösterilmiştir. Böylece yönetim ekranının üst bölümünde kullanıcıya ait temel bilgiler görünür hale getirilmiş ve hesap işlemlerine erişim kolaylaştırılmıştır. Projede ayrı bir footer bileşeni kullanılmadığı için raporda footer alanı oluşturulmuş bir ön yüz parçası olarak değerlendirilmemiştir.

Yan menü ve üst bar tasarımı, yönetim panelinin kullanılabilirliğine doğrudan katkı sağlamıştır. Kullanıcının hangi sayfada bulunduğunu anlaması için aktif menü durumu `is-active` sınıfı ile belirtilmiş, dil değiştirme bağlantıları da aynı yerleşimde konumlandırılmıştır. Bu düzen, çok sayfalı arayüzün daha anlaşılır ve tutarlı kullanılmasına yardımcı olmuştur.

### Teknik Açıklama

Yönetim yerleşiminde CSS Grid ile ana sayfa iki sütuna ayrılmıştır. `.app-frame` sınıfında `grid-template-columns: 300px 1fr` kullanılarak sol menü ve içerik alanı birbirinden ayrılmıştır. `.app-sidebar`, `.app-nav`, `.topbar` ve `.topbar-actions` sınıflarında Flexbox kullanılarak menü elemanları ve üst bar içerikleri hizalanmıştır.

`layouts/app.blade.php` dosyasında Bootstrap, DataTables, Toastr ve SweetAlert2 gibi ön yüz kütüphaneleri dahil edilmiştir. Bu kütüphaneler daha sonra tablo, bildirim, modal ve onay penceresi gibi arayüz bileşenlerinde kullanılmıştır. HTML5, CSS3, CSS Grid, Flexbox, Bootstrap ve Blade şablon yapısı kullanılmıştır.

### Rapora Eklenecek Görseller

- Kod Görseli: `layouts/app.blade.php` dosyasındaki sidebar, navigation ve üst bar bağlantıları.
- Arayüz Görseli: Yönetim panelinde sol menü, üst bar ve içerik alanının birlikte göründüğü ekran.

### Görsel Dosya Önerisi

- `gun-02-yonetim-layout-kodu.png`
- `gun-02-sidebar-topbar-gorunumu.png`
- `gun-02-dil-secici-gorunumu.png`

## Gün 3: Karşılama Sayfası Tasarımı

### Yapılan Çalışmalar

Üçüncü gün `resources/views/welcome.blade.php` dosyasında ana karşılama sayfası tasarlanmıştır. Bu sayfada marka alanı, dil değiştirme butonları, tanıtım metni, giriş ve kayıt bağlantıları ile istatistik kartları oluşturulmuştur. Kullanıcı uygulamaya ilk kez geldiğinde sade, anlaşılır ve yönlendirici bir ekranla karşılaşacak şekilde sayfa düzeni yapılandırılmıştır.

Sayfanın ana içerik bölümü `welcome-grid` sınıfı ile iki bölüme ayrılmıştır. Sol bölümde başlık, açıklama, özellik rozetleri ve giriş/kayıt aksiyonları yer almıştır. Sağ bölümde ürün, işlem ve rapor alanlarını temsil eden istatistik kartları gösterilmiştir. Bu kartlar, projenin envanter yönetimi amacını görsel olarak destekleyen kısa bilgiler sunmuştur.

Karşılama sayfası, uygulamanın ilk izlenimini güçlendirmiştir. Giriş ve kayıt butonlarının görünür biçimde yerleştirilmesi, kullanıcının bir sonraki adıma kolayca yönlendirilmesini sağlamıştır. Dil değiştirme butonları da sayfanın üst kısmında konumlandırılarak çok dilli kullanım deneyimi desteklenmiştir.

### Teknik Açıklama

Sayfa tasarımında HTML5 semantik yapısı, CSS Grid ve Flexbox kullanılmıştır. `.welcome-shell`, `.welcome-panel`, `.welcome-topbar`, `.welcome-grid`, `.welcome-copy`, `.welcome-badges`, `.welcome-stats` ve `.welcome-stat-card` sınıfları ile sayfanın genel düzeni oluşturulmuştur. Başlık boyutlarında `clamp()` kullanılarak ekran genişliğine göre daha dengeli bir tipografi sağlanmıştır.

Bootstrap buton sınıfları ile giriş ve kayıt bağlantıları görsel olarak ayrıştırılmıştır. Rozetlerde `.badge-soft`, `.ok`, `.warn` ve `.danger` sınıfları kullanılarak özellik alanları renklendirilmiştir. HTML5, CSS3, CSS Grid, Flexbox, Bootstrap ve responsive tipografi kullanılmıştır.

### Rapora Eklenecek Görseller

- Kod Görseli: `welcome.blade.php` dosyasındaki `welcome-grid`, butonlar ve istatistik kartları.
- Arayüz Görseli: Ana sayfanın masaüstü tarayıcı görünümü.

### Görsel Dosya Önerisi

- `gun-03-ana-sayfa-kodu.png`
- `gun-03-ana-sayfa-gorunumu.png`
- `gun-03-istatistik-kartlari.png`

## Gün 4: Misafir Kullanıcı Yerleşimi ve Tanıtım Paneli

### Yapılan Çalışmalar

Dördüncü gün `resources/views/layouts/guest.blade.php` dosyasında misafir kullanıcılar için ortak yerleşim yapısı düzenlenmiştir. Bu yerleşim, giriş, kayıt ve parola işlemleri gibi oturum açılmadan erişilen sayfalarda kullanılmıştır. Sol tarafta uygulamayı tanıtan bir panel, sağ tarafta ise ilgili formun yer aldığı bir içerik paneli oluşturulmuştur.

Tanıtım panelinde marka işareti, uygulama adı, kısa açıklama, özellik rozetleri ve dil değiştirme bağlantıları gösterilmiştir. Form paneli ise `{{ $slot }}` alanı ile dinamik hale getirilmiş, farklı auth sayfalarının aynı görsel düzen içinde gösterilmesi sağlanmıştır. Bu yaklaşım sayesinde giriş, kayıt ve parola sayfaları için tekrar eden HTML yapısı azaltılmış ve görsel tutarlılık artırılmıştır.

Misafir yerleşimi, kullanıcı deneyimi açısından önemli bir temel sağlamıştır. Kullanıcı form doldururken aynı anda uygulamanın temel amacı ve sunduğu özellikler hakkında bilgi alabilmiştir. Panel yapısı, boşluklar ve arka plan geçişleri ile form alanları daha düzenli ve okunabilir hale getirilmiştir.

### Teknik Açıklama

`guest-shell` sınıfında CSS Grid kullanılarak iki sütunlu yapı oluşturulmuştur. `.guest-showcase`, `.guest-panel-wrap`, `.guest-panel`, `.guest-brand`, `.guest-badges` ve `.guest-lang` sınıfları ile tanıtım ve form alanları ayrı ayrı stillendirilmiştir. Arka plan alanında `app-bg` sınıfı kullanılmış ve sayfaya yumuşak bir görsel derinlik verilmiştir.

Form panelinde ortak `.panel` sınıfı kullanılmıştır. Rozetlerde daha önce tanımlanan renk durumları yeniden kullanılmış, böylece ana sayfa ve misafir ekranı arasında görsel bütünlük sağlanmıştır. HTML5, CSS3, Grid, Flexbox, Blade slot yapısı ve responsive layout düzeni kullanılmıştır.

### Rapora Eklenecek Görseller

- Kod Görseli: `layouts/guest.blade.php` dosyasındaki `guest-shell` ve `{{ $slot }}` kullanımı.
- Arayüz Görseli: Misafir kullanıcı yerleşiminin giriş veya kayıt sayfası ile birlikte görünümü.

### Görsel Dosya Önerisi

- `gun-04-guest-layout-kodu.png`
- `gun-04-misafir-layout-gorunumu.png`
- `gun-04-tanitim-paneli.png`

## Gün 5: Giriş, Kayıt ve Parola Formları

### Yapılan Çalışmalar

Beşinci gün kullanıcı kimlik doğrulama arayüzleri incelenmiş ve form sayfaları rapor kapsamında düzenli bir grup olarak değerlendirilmiştir. `resources/views/auth/login.blade.php` dosyasında giriş formu, e-posta ve parola alanları, beni hatırla seçeneği, parola sıfırlama bağlantısı ve kayıt yönlendirmesi yer almıştır. `resources/views/auth/register.blade.php` dosyasında ise ad, e-posta, parola ve parola tekrar alanları düzenlenmiştir.

Parola işlemleri için `forgot-password.blade.php`, `reset-password.blade.php`, `confirm-password.blade.php` ve `verify-email.blade.php` dosyalarında sade form ve bilgilendirme ekranları kullanılmıştır. Bu sayfalarda ortak input, label, hata mesajı ve buton bileşenleri tercih edilmiştir. Böylece form alanlarında tutarlı hizalama, okunabilir metin yapısı ve benzer kullanıcı akışı sağlanmıştır.

Form sayfaları, kullanıcının sisteme erişim sürecindeki ilk etkileşim alanları olduğu için arayüz bütünlüğü açısından önemli görülmüştür. Formların misafir yerleşimi içinde gösterilmesi, kullanıcıya güven veren daha düzenli bir ekran deneyimi sunmuştur. Hata mesajları ve oturum durumu bileşenleri ile kullanıcı geri bildirimi görünür hale getirilmiştir.

### Teknik Açıklama

Formlarda `x-input-label`, `x-text-input`, `x-input-error`, `x-primary-button` ve `x-auth-session-status` bileşenleri kullanılmıştır. Bu bileşenler `resources/views/components` klasörü altında yer almış ve tekrar eden form parçalarının ortak şekilde kullanılmasını sağlamıştır. `.auth-form`, `.auth-field`, `.auth-input`, `.auth-actions`, `.auth-link` ve `.auth-foot` sınıfları ile form görünümü özelleştirilmiştir.

HTML5 form tipleri olarak `email`, `password`, `text` ve `checkbox` kullanılmıştır. Tailwind yardımcı sınıfları, özel CSS sınıfları ve Blade component yapısı birlikte kullanılmıştır. Form tasarımı, kullanıcı geri bildirimi, erişilebilir label kullanımı ve responsive panel düzeni bu aşamada öne çıkan teknik konular olmuştur.

### Rapora Eklenecek Görseller

- Kod Görseli: `auth/login.blade.php` veya `auth/register.blade.php` dosyasındaki form bileşenleri.
- Arayüz Görseli: Giriş sayfası ve kayıt sayfası ekran görüntüleri.

### Görsel Dosya Önerisi

- `gun-05-giris-formu-kodu.png`
- `gun-05-giris-sayfasi.png`
- `gun-05-kayit-sayfasi.png`
- `gun-05-parola-sifirlama-sayfasi.png`

## Gün 6: Dashboard ve Özet Kartları

### Yapılan Çalışmalar

Altıncı gün `resources/views/dashboard.blade.php` dosyasında yönetim panelinin ana özet ekranı incelenmiştir. Bu ekranda toplam ürün, toplam işlem, düşük stok ürünleri ve son işlemler gibi önemli bilgiler metrik kartları ile gösterilmiştir. Kullanıcı uygulamaya giriş yaptıktan sonra genel stok durumunu tek ekranda görebilecek şekilde bilgi mimarisi düzenlenmiştir.

Sayfada ayrıca son işlemleri gösteren bir tablo oluşturulmuştur. Bu tablo içinde ürün adı, işlem tipi, miktar ve tarih bilgileri yer almıştır. İşlem tipleri için renkli rozetler kullanılmış, böylece stok giriş ve çıkış hareketleri görsel olarak daha kolay ayırt edilebilir hale getirilmiştir. Boş veri durumunda kullanıcıya açıklayıcı bir mesaj gösterilmiştir.

Dashboard ekranı, projenin yönetim deneyimini güçlendiren merkezi bir arayüz olarak tasarlanmıştır. Metrik kartları sayesinde önemli bilgiler taranabilir hale getirilmiş, tablo alanı ise son hareketlerin detaylı biçimde izlenmesine katkı sağlamıştır.

### Teknik Açıklama

Metrik kartlarında `.metric-grid`, `.metric-card`, `.metric-label` ve `.metric-value` sınıfları kullanılmıştır. CSS Grid ile kartların ekran genişliğine göre otomatik yerleşmesi sağlanmıştır. Tablo alanı `.table-wrap` içinde konumlandırılmış ve Bootstrap tablo sınıfları ile hizalama, satır düzeni ve responsive davranış desteklenmiştir.

Rozetlerde `.badge-soft`, `.ok`, `.warn` ve `.danger` sınıfları kullanılmıştır. Bu sınıflar farklı durumların renklerle ayrıştırılmasını sağlamıştır. HTML5, CSS3, CSS Grid, Bootstrap tablo yapısı ve durum rozetleri kullanılmıştır.

### Rapora Eklenecek Görseller

- Kod Görseli: `dashboard.blade.php` dosyasındaki `metric-grid` ve son işlemler tablosu.
- Arayüz Görseli: Dashboard ekranında metrik kartları ve son işlemler tablosu.

### Görsel Dosya Önerisi

- `gun-06-dashboard-kodu.png`
- `gun-06-dashboard-gorunumu.png`
- `gun-06-metrik-kartlari.png`

## Gün 7: Ürün Listeleme Sayfası ve Ürün Formları

### Yapılan Çalışmalar

Yedinci gün `resources/views/products/index.blade.php` dosyasında ürün listeleme ekranı incelenmiştir. Sayfada ürün yönetimi için başlık alanı, açıklama metni, yeni ürün ekleme butonu, metrik kartları, arama formu ve ürün tablosu oluşturulmuştur. Ürünler SKU, ürün adı, miktar, düşük stok eşiği, durum ve işlem seçenekleri ile listelenmiştir.

Ürün ekleme ve ürün düzenleme işlemleri için Bootstrap modal pencereleri kullanılmıştır. Yeni ürün modalinde SKU, ürün adı, açıklama, mevcut miktar ve düşük stok eşiği alanları yer almıştır. Düzenleme modalinde ise mevcut ürün bilgileri JavaScript ile ilgili forma aktarılmıştır. Silme işlemi için ayrı bir gizli form kullanılmış ve kullanıcıdan onay alınması için SweetAlert2 penceresi hazırlanmıştır.

Bu sayfa, projenin en önemli yönetim ekranlarından biri olarak değerlendirilmiştir. Arama formu, tablo düzeni, durum rozetleri ve modal formlar sayesinde kullanıcı ürünleri daha hızlı tarayabilir, düzenleyebilir ve stok durumunu daha anlaşılır biçimde görebilir hale gelmiştir.

### Teknik Açıklama

Ürün tablosunda DataTables kullanılmış ve tabloya sayfalama, sıralama, arama ve dışa aktarma özellikleri eklenmiştir. `$('#productsTable').DataTable()` çağrısı ile tablo etkileşimli hale getirilmiş, `buttons: ['copy', 'csv', 'excel', 'pdf', 'print']` ayarıyla farklı çıktı seçenekleri sağlanmıştır.

JavaScript tarafında `show.bs.modal` olayı kullanılarak düzenleme modalinin açılması sırasında ilgili butondaki `data-*` nitelikleri okunmuştur. DOM Manipulation ile form alanları doldurulmuş, formun `action` adresi dinamik olarak ayarlanmıştır. Bootstrap Modal, DataTables, jQuery, DOM Manipulation, SweetAlert2 ve HTML form yapısı kullanılmıştır.

### Rapora Eklenecek Görseller

- Kod Görseli: `products/index.blade.php` dosyasındaki ürün tablosu, modal formlar ve JavaScript bölümü.
- Arayüz Görseli: Ürün listeleme sayfası, arama alanı, ürün ekleme modali ve düzenleme modali.

### Görsel Dosya Önerisi

- `gun-07-urun-listesi-kodu.png`
- `gun-07-urun-listesi-gorunumu.png`
- `gun-07-urun-ekleme-modali.png`
- `gun-07-urun-duzenleme-js.png`

## Gün 8: Ürün Detay Sayfası ve İşlem Geçmişi

### Yapılan Çalışmalar

Sekizinci gün `resources/views/products/show.blade.php` dosyasında ürün detay ekranı incelenmiştir. Bu sayfada seçilen ürünün adı, SKU bilgisi ve stok durumu üst panelde gösterilmiştir. Ürün bilgileri ayrı bir panel içinde SKU, ürün adı, miktar, düşük stok eşiği ve açıklama alanlarıyla düzenlenmiştir.

Sayfanın sağ bölümünde ürünün işlem geçmişi tablo halinde sunulmuştur. İşlem geçmişinde tarih, işlem tipi, miktar, önceki stok, sonraki stok ve not alanları yer almıştır. İşlem tipleri renkli rozetlerle gösterilmiş, kullanıcının ürün bazında stok hareketlerini daha kolay takip etmesi sağlanmıştır.

Ürün detay sayfası, listeleme ekranından daha ayrıntılı bilgiye geçiş yapılmasını sağlamıştır. Bu sayede kullanıcı yalnızca ürünün mevcut durumunu değil, geçmişte gerçekleşen stok hareketlerini de aynı ekranda inceleyebilmiştir. Detay sayfası, arayüzün bilgi derinliğini artıran önemli bir kullanıcı etkileşim alanı olarak geliştirilmiştir.

### Teknik Açıklama

Sayfa düzeninde Bootstrap Grid kullanılmıştır. Sol bölümde ürün bilgileri, sağ bölümde işlem geçmişi tablosu konumlandırılmıştır. `table-wrap` sınıfı tabloyu çerçeveli ve taşmayı kontrol eden bir yapı içinde göstermiştir. DataTables ile işlem geçmişi tablosu aranabilir ve dışa aktarılabilir hale getirilmiştir.

`$('#txTable').DataTable()` kullanımıyla tabloya JavaScript etkileşimi eklenmiştir. Bu sayfada sayfalama kapatılmış, arama açık bırakılmış ve dışa aktarma butonları kullanılmıştır. HTML5, Bootstrap Grid, DataTables, jQuery, tablo tasarımı ve durum rozetleri kullanılmıştır.

### Rapora Eklenecek Görseller

- Kod Görseli: `products/show.blade.php` dosyasındaki ürün bilgi paneli ve `txTable` DataTables ayarı.
- Arayüz Görseli: Ürün detay sayfasında bilgi paneli ve işlem geçmişi tablosu.

### Görsel Dosya Önerisi

- `gun-08-urun-detay-kodu.png`
- `gun-08-urun-detay-gorunumu.png`
- `gun-08-islem-gecmisi-tablosu.png`

## Gün 9: Stok İşlemleri Sayfası

### Yapılan Çalışmalar

Dokuzuncu gün `resources/views/transactions/index.blade.php` dosyasında stok işlemleri arayüzü incelenmiştir. Sayfada stok giriş ve çıkış hareketlerinin listelendiği bir tablo, işlem özetlerini gösteren metrik kartları ve yeni stok işlemi eklemek için bir modal form oluşturulmuştur. Kullanıcıların envanter hareketlerini tek ekranda takip edebilmesi hedeflenmiştir.

Yeni işlem ekleme modalinde ürün seçimi, işlem tipi, miktar ve not alanları düzenlenmiştir. İşlem tipi için stok girişi ve stok çıkışı seçenekleri sunulmuş, miktar alanı sayı girişi olarak hazırlanmıştır. Tablo alanında işlem tarihi, ürün bilgisi, işlem tipi, miktar, önceki stok, sonraki stok ve not bilgisi gösterilmiştir.

Bu ekran, stok yönetim sürecinin kullanıcıya görünür ve anlaşılır hale getirilmesine katkı sağlamıştır. Metrik kartları ile işlem sayıları özetlenmiş, tablo ile ayrıntılı kayıtlar gösterilmiş, modal form ile yeni işlem ekleme süreci sayfa değiştirmeden gerçekleştirilebilir hale getirilmiştir.

### Teknik Açıklama

Sayfa içinde Bootstrap Modal yapısı kullanılmıştır. Modal formu `row g-3` sınıfları ile iki sütunlu ve düzenli bir form yapısına dönüştürülmüştür. Tablo DataTables ile etkileşimli hale getirilmiş, `pageLength`, `order`, `dom` ve `buttons` ayarları kullanılmıştır.

CSS tarafında `.metric-grid` ve `.table-wrap` sınıfları yeniden kullanılmıştır. Bu tekrar kullanım, dashboard, ürünler ve işlemler sayfaları arasında görsel uyum sağlamıştır. HTML5, Bootstrap, DataTables, jQuery, form tasarımı, tablo tasarımı ve Flexbox kullanılmıştır.

### Rapora Eklenecek Görseller

- Kod Görseli: `transactions/index.blade.php` dosyasındaki işlem tablosu, modal form ve DataTables ayarı.
- Arayüz Görseli: Stok işlemleri sayfası ve işlem ekleme modalinin ekran görüntüsü.

### Görsel Dosya Önerisi

- `gun-09-stok-islemleri-kodu.png`
- `gun-09-stok-islemleri-gorunumu.png`
- `gun-09-islem-ekleme-modali.png`

## Gün 10: Raporlar, Bildirimler ve Ayarlar Sayfaları

### Yapılan Çalışmalar

Onuncu gün raporlama ve sistem yardımcı ekranları incelenmiştir. `resources/views/reports/index.blade.php` dosyasında envanter raporları için filtre alanı, metrik kartları, en hareketli ürünler tablosu ve düşük stok uyarıları tablosu oluşturulmuştur. Tarih aralığı seçimi için açılır liste kullanılmış ve rapor içeriği kullanıcı tarafından seçilen döneme göre görüntülenecek şekilde arayüz hazırlanmıştır.

`resources/views/notifications/index.blade.php` dosyasında düşük stok uyarılarını gösteren bildirim ekranı düzenlenmiştir. Düşük stok ürünü bulunmadığında kullanıcıya olumlu bir bilgi paneli gösterilmiş, düşük stok ürünü bulunduğunda ise uyarı mesajı ve ürün kartları listelenmiştir. `resources/views/settings/index.blade.php` dosyasında uygulama adı, varsayılan düşük stok eşiği ve rapor önbelleği seçeneği için form alanları hazırlanmıştır.

Bu sayfalar, kullanıcının uygulamadaki durumları analiz etmesini ve temel arayüz ayarlarını yönetmesini sağlamıştır. Rapor ekranı veri yoğun yapıyı okunabilir tablolara dönüştürmüş, bildirim ekranı kritik stok durumlarını öne çıkarmış, ayarlar ekranı ise sade bir form deneyimi sunmuştur.

### Teknik Açıklama

Rapor sayfasında Bootstrap Grid ile iki sütunlu tablo düzeni kullanılmıştır. `topTable` ve `lowTable` tablolarında DataTables koşullu olarak başlatılmıştır. Boş veri satırlarında `colspan` kontrolü yapılmış, tablo yapısının hatalı başlatılması engellenmiştir. Bu yaklaşım, arayüzde boş veri durumlarının daha kontrollü gösterilmesini sağlamıştır.

Bildirim sayfasında Bootstrap alert, panel ve kart düzenleri kullanılmıştır. Ayarlar sayfasında input, checkbox, buton grubu ve form hizalama sınıfları kullanılmıştır. HTML5, CSS3, Bootstrap Grid, DataTables, form kontrolleri, tablo tasarımı ve durum kartları kullanılmıştır.

### Rapora Eklenecek Görseller

- Kod Görseli: `reports/index.blade.php` dosyasındaki filtre formu ve DataTables koşulları.
- Arayüz Görseli: Raporlar sayfası, bildirim kartları ve ayarlar formu.

### Görsel Dosya Önerisi

- `gun-10-raporlar-kodu.png`
- `gun-10-raporlar-gorunumu.png`
- `gun-10-bildirimler-gorunumu.png`
- `gun-10-ayarlar-formu.png`

## Gün 11: Profil Sayfası ve JavaScript Etkileşimleri

### Yapılan Çalışmalar

On birinci gün `resources/views/profile/edit.blade.php` ve `resources/views/profile/partials` klasörü altındaki profil parçaları incelenmiştir. Profil sayfasında kullanıcı bilgileri, parola güncelleme ve hesap silme alanları ayrı paneller halinde düzenlenmiştir. Bu parçalı yapı sayesinde profil sayfası hem okunabilir hale getirilmiş hem de farklı hesap işlemleri birbirinden ayrılmıştır.

`update-profile-information-form.blade.php` dosyasında ad ve e-posta alanları, `update-password-form.blade.php` dosyasında mevcut parola, yeni parola ve parola tekrar alanları düzenlenmiştir. `delete-user-form.blade.php` dosyasında hesap silme işlemi için tehlikeli işlem alanı oluşturulmuş ve onay modali kullanılmıştır. Başarı mesajları Alpine.js ile kısa süreli gösterilecek şekilde hazırlanmıştır.

Bu gün ayrıca JavaScript etkileşimleri genel olarak değerlendirilmiştir. Ürün düzenleme modalinde DOM üzerinde form alanlarının doldurulması, ürün silme işleminde SweetAlert2 onayı, Toastr bildirimleri, DataTables davranışları ve Alpine.js modal yapısı arayüzün daha etkileşimli hale gelmesini sağlamıştır.

### Teknik Açıklama

Profil silme modalinde `resources/views/components/modal.blade.php` bileşeni kullanılmıştır. Bu bileşende `x-data`, `x-show`, `x-transition`, `x-on:open-modal.window`, `x-on:close-modal.window`, `keydown.escape` ve odak yönetimi gibi Alpine.js özellikleri yer almıştır. Böylece modal pencereler daha erişilebilir ve kontrollü hale getirilmiştir.

`resources/js/app.js` dosyasında Alpine.js başlatılmıştır. `layouts/app.blade.php` içinde Toastr bildirimleri oturum mesajlarına bağlanmıştır. Ürünler sayfasında jQuery ve DOM Manipulation kullanılmış, DataTables ile tablo davranışı zenginleştirilmiştir. Alpine.js, jQuery, DOM Manipulation, Toastr, SweetAlert2 ve Bootstrap JavaScript bileşenleri kullanılmıştır.

### Rapora Eklenecek Görseller

- Kod Görseli: `components/modal.blade.php`, `profile/partials/delete-user-form.blade.php` ve `products/index.blade.php` JavaScript bölümü.
- Arayüz Görseli: Profil sayfası, hesap silme modali ve ürün silme onay penceresi.

### Görsel Dosya Önerisi

- `gun-11-profil-kodu.png`
- `gun-11-profil-gorunumu.png`
- `gun-11-alpine-modal-kodu.png`
- `gun-11-sweetalert-onay-penceresi.png`

## Gün 12: Responsive Tasarım, Son Kontroller ve Görsel Bütünlük

### Yapılan Çalışmalar

On ikinci gün projenin genel responsive davranışı ve görsel bütünlüğü değerlendirilmiştir. `resources/css/app.css` dosyasında yer alan `@media (max-width: 1024px)` bloğu ile yönetim panelinin mobil ve dar ekranlarda tek sütunlu düzene geçmesi sağlanmıştır. Sol menü dar ekranlarda yatay kaydırılabilir hale getirilmiş, misafir ve karşılama sayfalarındaki iki sütunlu yapı tek sütuna dönüştürülmüştür.

Boşluklar, panel kenarlıkları, tablo kapsayıcıları, kart genişlikleri, form alanları ve buton hizalamaları genel arayüz tutarlılığı açısından incelenmiştir. Sayfalarda kullanılan `panel`, `metric-grid`, `table-wrap`, `badge-soft`, `auth-*`, `guest-*` ve `welcome-*` sınıfları sayesinde ortak tasarım dili korunmuştur. Bu ortak sınıfların kullanılması, farklı sayfaların aynı ürün ailesine ait olduğu hissini güçlendirmiştir.

Son aşamada ön yüz derleme süreci kontrol edilmiş ve Vite üretim derlemesi başarıyla çalıştırılmıştır. Bu kontrol, `resources/css/app.css` ve `resources/js/app.js` dosyalarının üretim çıktısına dönüştürülebildiğini göstermiştir. Böylece arayüz dosyalarının derlenebilir durumda olduğu doğrulanmış ve rapor için önerilen ekran görüntüsü listesi hazırlanmıştır.

### Teknik Açıklama

Responsive tasarımda Media Queries kullanılmıştır. `.app-frame`, `.app-sidebar`, `.app-nav`, `.guest-shell`, `.welcome-grid`, `.welcome-panel`, `.guest-showcase` ve `.welcome-topbar` sınıfları dar ekranlarda farklı yerleşim kuralları almıştır. CSS Grid tek sütuna düşürülmüş, Flexbox yönleri yeniden düzenlenmiş ve panel boşlukları küçültülmüştür.

Vite build işlemi ile ön yüz dosyaları derlenmiş ve CSS/JS çıktılarının oluşturulabildiği kontrol edilmiştir. Bu aşamada HTML5, CSS3, Media Queries, responsive layout, Vite, JavaScript, Bootstrap ve ortak CSS sınıfları kullanılmıştır.

### Rapora Eklenecek Görseller

- Kod Görseli: `resources/css/app.css` dosyasındaki responsive `@media` bloğu ve `vite.config.js` giriş dosyaları.
- Arayüz Görseli: Ana sayfa veya yönetim panelinin mobil görünümü.

### Görsel Dosya Önerisi

- `gun-12-responsive-css.png`
- `gun-12-mobil-ana-sayfa.png`
- `gun-12-mobil-yonetim-paneli.png`
- `gun-12-vite-build-kontrolu.png`

## Raporda Kullanılması Önerilen Görseller

### Tarayıcı Ekran Görüntüleri

- Ana sayfa genel görünümü: `welcome.blade.php` sayfasında marka alanı, tanıtım metni, giriş/kayıt butonları ve istatistik kartları gösterilmelidir.
- Yönetim paneli görünümü: `layouts/app.blade.php` düzeninde sol menü, üst bar ve içerik alanı birlikte gösterilmelidir.
- Dil seçici görünümü: ana sayfa, misafir sayfası veya yönetim panelindeki EN, AR ve TR butonları gösterilmelidir.
- Giriş sayfası: `auth/login.blade.php` formu, tanıtım paneli ve giriş alanlarıyla birlikte gösterilmelidir.
- Kayıt sayfası: `auth/register.blade.php` form alanları ve ortak misafir yerleşimi gösterilmelidir.
- Parola sıfırlama ekranı: `forgot-password.blade.php` veya `reset-password.blade.php` sayfası gösterilmelidir.
- Dashboard sayfası: metrik kartları ve son işlemler tablosu gösterilmelidir.
- Ürün listeleme sayfası: arama formu, ürün tablosu, durum rozetleri ve işlem butonları gösterilmelidir.
- Ürün ekleme veya düzenleme modali: Bootstrap modal yapısı form alanlarıyla birlikte gösterilmelidir.
- Ürün detay sayfası: ürün bilgi paneli ve işlem geçmişi tablosu gösterilmelidir.
- Stok işlemleri sayfası: metrik kartları, işlem tablosu ve işlem ekleme butonu gösterilmelidir.
- Stok işlemi ekleme modali: ürün seçimi, işlem tipi, miktar ve not alanları gösterilmelidir.
- Raporlar sayfası: filtre alanı, metrik kartları, en hareketli ürünler ve düşük stok tabloları gösterilmelidir.
- Bildirimler sayfası: düşük stok uyarıları veya stokların sağlıklı olduğunu belirten panel gösterilmelidir.
- Ayarlar sayfası: uygulama adı, düşük stok eşiği ve rapor önbelleği formu gösterilmelidir.
- Profil sayfası: profil bilgileri, parola güncelleme ve hesap silme panelleri gösterilmelidir.
- Hesap silme modali: Alpine.js ile açılan onay penceresi gösterilmelidir.
- Mobil ana sayfa görünümü: karşılama sayfasının dar ekranda tek sütuna düşmüş hali gösterilmelidir.
- Mobil yönetim paneli görünümü: sidebar düzeninin dar ekranda yatay kaydırılabilir hale geldiği görünüm gösterilmelidir.

### Kod Görselleri

- HTML ana iskelet kodu: `resources/views/layouts/app.blade.php` dosyasındaki genel HTML, `@vite`, sidebar ve içerik alanı.
- Misafir yerleşimi kodu: `resources/views/layouts/guest.blade.php` dosyasındaki `guest-shell`, tanıtım paneli ve slot kullanımı.
- Ana sayfa kodu: `resources/views/welcome.blade.php` dosyasındaki `welcome-grid`, butonlar ve istatistik kartları.
- CSS genel stil tanımları: `resources/css/app.css` dosyasındaki `:root`, `.app-shell`, `.panel`, `.metric-grid` ve `.table-wrap` sınıfları.
- CSS responsive kodları: `resources/css/app.css` dosyasındaki `@media (max-width: 1024px)` bölümü.
- JavaScript başlatma kodu: `resources/js/app.js` dosyasındaki Alpine.js kullanımı.
- Axios yapılandırması: `resources/js/bootstrap.js` dosyasındaki temel JavaScript yapılandırması.
- Ürün tablosu ve modal kodu: `resources/views/products/index.blade.php` dosyasındaki ürün tablosu, modal formlar ve SweetAlert2 kullanımı.
- Stok işlemleri kodu: `resources/views/transactions/index.blade.php` dosyasındaki DataTables ve modal form yapısı.
- Rapor tabloları kodu: `resources/views/reports/index.blade.php` dosyasındaki filtre formu ve DataTables başlatma koşulları.
- Alpine.js modal kodu: `resources/views/components/modal.blade.php` dosyasındaki `x-data`, `x-show`, `x-transition` ve odak yönetimi.
- Profil form kodları: `resources/views/profile/partials` klasöründeki profil, parola ve hesap silme formları.
- Ortak form bileşenleri: `resources/views/components/text-input.blade.php`, `input-label.blade.php`, `input-error.blade.php` ve `primary-button.blade.php`.

### Görsel Klasörü Yapısı

```text
frontend-report-images/
├── gun-01-dosya-yapisi.png
├── gun-01-css-temel-degiskenler.png
├── gun-01-genel-arayuz-iskeleti.png
├── gun-02-yonetim-layout-kodu.png
├── gun-02-sidebar-topbar-gorunumu.png
├── gun-02-dil-secici-gorunumu.png
├── gun-03-ana-sayfa-kodu.png
├── gun-03-ana-sayfa-gorunumu.png
├── gun-03-istatistik-kartlari.png
├── gun-04-guest-layout-kodu.png
├── gun-04-misafir-layout-gorunumu.png
├── gun-04-tanitim-paneli.png
├── gun-05-giris-formu-kodu.png
├── gun-05-giris-sayfasi.png
├── gun-05-kayit-sayfasi.png
├── gun-05-parola-sifirlama-sayfasi.png
├── gun-06-dashboard-kodu.png
├── gun-06-dashboard-gorunumu.png
├── gun-06-metrik-kartlari.png
├── gun-07-urun-listesi-kodu.png
├── gun-07-urun-listesi-gorunumu.png
├── gun-07-urun-ekleme-modali.png
├── gun-07-urun-duzenleme-js.png
├── gun-08-urun-detay-kodu.png
├── gun-08-urun-detay-gorunumu.png
├── gun-08-islem-gecmisi-tablosu.png
├── gun-09-stok-islemleri-kodu.png
├── gun-09-stok-islemleri-gorunumu.png
├── gun-09-islem-ekleme-modali.png
├── gun-10-raporlar-kodu.png
├── gun-10-raporlar-gorunumu.png
├── gun-10-bildirimler-gorunumu.png
├── gun-10-ayarlar-formu.png
├── gun-11-profil-kodu.png
├── gun-11-profil-gorunumu.png
├── gun-11-alpine-modal-kodu.png
├── gun-11-sweetalert-onay-penceresi.png
├── gun-12-responsive-css.png
├── gun-12-mobil-ana-sayfa.png
├── gun-12-mobil-yonetim-paneli.png
├── gun-12-vite-build-kontrolu.png
└── README.md
```

## Genel Değerlendirme

Projenin ön yüzü, aşamalı şekilde geliştirilen ve farklı kullanıcı ekranlarını tutarlı bir tasarım dili içinde birleştiren bir yapı olarak değerlendirilmiştir. İlk aşamada genel dosya yapısı, tema değişkenleri, JavaScript başlatma dosyaları ve ortak layout dosyaları düzenlenmiştir. Daha sonra ana sayfa, misafir kullanıcı ekranları, giriş ve kayıt formları, dashboard, ürün sayfaları, stok işlemleri, raporlar, bildirimler, ayarlar ve profil ekranları geliştirilmiştir.

Arayüzde ortak bileşenlerin kullanılması, sayfalar arasında görsel bütünlüğün korunmasına katkı sağlamıştır. Kartlar, tablolar, formlar, rozetler, modal pencereler ve bildirimler kullanıcı deneyimini destekleyecek biçimde düzenlenmiştir. DataTables, SweetAlert2, Toastr ve Alpine.js gibi JavaScript tabanlı araçlarla etkileşimli bileşenler geliştirilmiş, kullanıcıya daha anlaşılır geri bildirimler sunulmuştur.

Responsive tasarım kuralları sayesinde ana sayfa, misafir yerleşimi ve yönetim paneli farklı ekran genişliklerinde kullanılabilir hale getirilmiştir. CSS Grid, Flexbox ve Media Queries ile sayfa düzenleri dar ekranlara uyarlanmıştır. Genel olarak projenin ön yüzünde sayfa organizasyonuna, okunabilirliğe, kullanılabilirliğe, mobil uyumluluğa ve görsel tutarlılığa önem verilmiş; arayüz, akademik bir staj çalışmasında değerlendirilebilecek düzeyde düzenli ve işlevsel hale getirilmiştir.
