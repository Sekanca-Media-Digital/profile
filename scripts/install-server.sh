#!/usr/bin/env bash
#
# Instalasi server kosong untuk Laravel + Octane (RoadRunner)
# Tested: Ubuntu 22.04 / 24.04 LTS, Debian 12
# Jalankan: sudo bash install-server.sh
#
set -e

# --- Konfigurasi (sesuaikan jika perlu) ---
PHP_VERSION="${PHP_VERSION:-8.3}"
NODE_VERSION="${NODE_VERSION:-20}"
APP_USER="${APP_USER:-www-data}"
APP_GROUP="${APP_GROUP:-www-data}"
APP_DIR="${APP_DIR:-/root/apps/profile}"
INSTALL_NGINX="${INSTALL_NGINX:-yes}"
INSTALL_MYSQL="${INSTALL_MYSQL:-no}"

# --- Deteksi OS ---
if [ -f /etc/os-release ]; then
    . /etc/os-release
    OS_ID="${ID:-unknown}"
    OS_VERSION="${VERSION_ID:-}"
else
    OS_ID=unknown
fi

echo "[*] OS: $OS_ID $OS_VERSION"
echo "[*] PHP: $PHP_VERSION | Node: $NODE_VERSION | App dir: $APP_DIR"

# --- Fungsi bantu ---
command_exists() { command -v "$1" &>/dev/null; }
is_deb() { [[ "$OS_ID" == "ubuntu" || "$OS_ID" == "debian" ]]; }

if ! is_deb; then
    echo "[!] Script ini untuk Ubuntu/Debian. Untuk RHEL/CentOS sesuaikan paket sendiri."
    exit 1
fi

# --- Update sistem ---
echo "[*] Update paket..."
export DEBIAN_FRONTEND=noninteractive
apt-get update -qq
apt-get upgrade -y -qq

# --- PHP + ekstensi ---
echo "[*] Instalasi PHP $PHP_VERSION dan ekstensi..."
apt-get install -y -qq \
    software-properties-common \
    ca-certificates \
    curl \
    unzip \
    git

if [[ "$OS_ID" == "ubuntu" ]]; then
    add-apt-repository -y ppa:ondrej/php
    apt-get update -qq
fi

apt-get install -y -qq \
    "php${PHP_VERSION}-cli" \
    "php${PHP_VERSION}-fpm" \
    "php${PHP_VERSION}-common" \
    "php${PHP_VERSION}-mysql" \
    "php${PHP_VERSION}-sqlite3" \
    "php${PHP_VERSION}-xml" \
    "php${PHP_VERSION}-curl" \
    "php${PHP_VERSION}-mbstring" \
    "php${PHP_VERSION}-zip" \
    "php${PHP_VERSION}-bcmath" \
    "php${PHP_VERSION}-opcache"

# --- Composer ---
if ! command_exists composer; then
    echo "[*] Instalasi Composer..."
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
    composer --version
fi

# --- Nginx (reverse proxy ke Octane) ---
if [[ "$INSTALL_NGINX" == "yes" ]]; then
    echo "[*] Instalasi Nginx..."
    apt-get install -y -qq nginx
    # Konfigurasi virtual host: proxy ke Laravel Octane (port 8000)
    cat > /etc/nginx/sites-available/sekanca << 'NGINX_EOF'
server {
    listen 80;
    listen [::]:80;
    server_name _;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    charset utf-8;

    location / {
        proxy_pass http://127.0.0.1:8000;
        proxy_http_version 1.1;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}
NGINX_EOF
    ln -sf /etc/nginx/sites-available/sekanca /etc/nginx/sites-enabled/
    rm -f /etc/nginx/sites-enabled/default
    nginx -t
fi

# --- MySQL (opsional) ---
if [[ "$INSTALL_MYSQL" == "yes" ]]; then
    echo "[*] Instalasi MySQL server..."
    apt-get install -y -qq mysql-server
    systemctl enable mysql
    systemctl start mysql
    echo "[!] Set password root MySQL: mysql_secure_installation"
fi

# --- Direktori aplikasi ---
echo "[*] Siapkan direktori $APP_DIR..."
mkdir -p "$APP_DIR"
chown -R "$APP_USER:$APP_GROUP" "$APP_DIR" 2>/dev/null || true

# --- Firewall (opsional) ---
if command_exists ufw && ! ufw status 2>/dev/null | grep -q "Status: active"; then
    echo "[*] UFW: buka port 80 (dan 443 jika pakai SSL)..."
    ufw allow 80/tcp
    ufw allow 443/tcp
    ufw --force enable || true
fi

# --- RoadRunner binary (unduh ke /usr/local/bin agar bisa dipakai global) ---
echo "[*] RoadRunner binary: akan diunduh saat deploy (php artisan octane:install --server=roadrunner atau ./vendor/bin/rr get-binary -n di dalam folder project)."

echo ""
echo "[✓] Instalasi server selesai."
echo ""
echo "Langkah berikut (deploy aplikasi):"
echo "  1. Upload/clone kode ke $APP_DIR"
echo "  2. cd $APP_DIR"
echo "  3. cp .env.example .env && php artisan key:generate"
echo "  4. composer install --no-dev --optimize-autoloader"
echo "  5. ./vendor/bin/rr get-binary -n   # unduh binary RoadRunner"
echo "  6. chmod +x rr"
echo "  7. npm ci && npm run build"
echo "  8. php artisan octane:start --host=0.0.0.0 --port=8000   # atau pakai systemd (lihat scripts/octane.service)"
echo ""
echo "Atau jalankan: sudo bash scripts/deploy-app.sh (setelah kode ada di $APP_DIR)"
echo ""
