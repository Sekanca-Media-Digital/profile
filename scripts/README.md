# Scripts deploy server

## 1. Instalasi server kosong (sekali jalan)

Di **server baru** (Ubuntu 22.04/24.04 atau Debian 12):

```bash
# Upload script ke server, lalu:
sudo bash install-server.sh
```

Yang diinstal:
- PHP 8.3 (atau versi di `PHP_VERSION`), FPM + ekstensi
- Composer
- Node.js 20 LTS
- Nginx (reverse proxy ke Octane port 8000)
- Opsional: MySQL (`INSTALL_MYSQL=yes`)

Variabel lingkungan (opsional):

```bash
export PHP_VERSION=8.2
export APP_DIR=/var/www/sekanca
export INSTALL_NGINX=yes
export INSTALL_MYSQL=no
sudo -E bash install-server.sh
```

## 2. Deploy aplikasi

Setelah kode ada di server (clone/upload ke `/var/www/sekanca`):

```bash
sudo bash deploy-app.sh
```

Atau dari dalam folder project:

```bash
cd /var/www/sekanca
sudo APP_DIR=/var/www/sekanca bash scripts/deploy-app.sh
```

Script akan: `composer install`, unduh binary RoadRunner (`rr`), `npm run build`, cache config/route/view.

## 3. Jalankan Octane

Manual (untuk tes):

```bash
cd /var/www/sekanca
php artisan octane:start --host=0.0.0.0 --port=8000
```

Production dengan systemd:

```bash
# Sesuaikan User/Group dan WorkingDirectory di octane.service bila perlu
sudo cp scripts/octane.service /etc/systemd/system/
sudo systemctl daemon-reload
sudo systemctl enable octane
sudo systemctl start octane
sudo systemctl status octane
```

Nginx sudah dikonfigurasi proxy ke `127.0.0.1:8000`. Akses aplikasi via HTTP port 80.
