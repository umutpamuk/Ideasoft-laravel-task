
# Proje Detayları


    1. Siparişler için, ekleme / silme / listeleme işlemlerinin 
       gerçekleştirilebileceği bir RESTful API servisi.

    2. Verilen siparişler için indirimleri hesaplayan küçük 
       bir RESTful API servisi.

## Kurulum

Projeyi klonlayın

```bash
  git clone git@github.com:umutpamuk/Ideasoft-laravel-task.git
```

Proje dizinine gidin

```bash
  cd Ideasoft-laravel-task
```

Gerekli paketleri yükleyin

```bash
  composer install
```

Sunucuyu çalıştırın

```bash
  ./vendor/bin/sail up -d
```

Tabloları oluşturun

```bash
  ./vendor/bin/sail artisan migrate
```
Veritabanına demo verilerin oluşturun

```bash
  ./vendor/bin/sail artisan db:seed
```

## API Dökümantasyonu



```http
  https://documenter.getpostman.com/view/21222352/2s93RXtqqz
```

  
