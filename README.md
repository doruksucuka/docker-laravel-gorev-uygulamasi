# Docker Laravel Görev Uygulaması

Bu proje, Laravel 12, Tailwind CSS, Vite, Breeze ve Docker kullanarak hazırlanmış bir görev takip uygulamasıdır. Her kullanıcı kendi görevlerini oluşturabilir, düzenleyebilir, silebilir ve filtreleyebilir.

## 🚀 Özellikler

- Kullanıcı Kaydı ve Girişi (Laravel Breeze ile)
- Görev Ekleme / Düzenleme / Silme
- Görevleri Tamamlama ve Bekletme
- Filtreleme ve Arama (tamamlanan, bekleyen ve başlığa göre)
- Görev Detay Sayfası
- Karanlık Mod Desteği (Tailwind ile)
- Docker tabanlı kolay kurulum

## 🐳 Docker ile Kurulum

```bash
git clone https://github.com/doruksucuka/docker-laravel-gorev-uygulamasi.git
cd docker-laravel-gorev-uygulamasi
cp .env.example .env
# .env içindeki veritabanı ayarlarını güncelleyin (DB_HOST=mysql vb.)
docker compose up -d --build
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
```

Uygulama:
- Laravel: http://localhost:8000
- PhpMyAdmin: http://localhost:8080

## 🔐 Giriş Bilgileri (Demo)

Örnek kullanıcı oluşturmak için kayıt olun veya seeder kullanabilirsiniz.

## 📁 Proje Yapısı

```
docker-laravel/
├── laravel-app/          # Laravel uygulama dizini
│   ├── app/              # Controller, Model, Policies
│   ├── resources/views   # Blade dosyaları
│   └── routes/web.php    # Route tanımlamaları
├── docker-compose.yml    # Docker yapılandırması
├── Dockerfile            # PHP + Apache imajı
└── .env                  # Ortam değişkenleri
```

## 📝 Lisans

MIT Lisansı © 2025 Doruk Sucuka