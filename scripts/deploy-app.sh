#!/usr/bin/env bash
#
# Deploy aplikasi Laravel + Octane setelah kode ada di server
# Jalankan dari server: sudo bash deploy-app.sh
# Atau dari folder project: sudo bash scripts/deploy-app.sh
#
set -e

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]:-$0}")" && pwd)"
APP_DIR="${APP_DIR:-/root/apps/profile}"
# Jika script di dalam repo (scripts/deploy-app.sh), gunakan parent sebagai APP_DIR
if [[ -f "$SCRIPT_DIR/../artisan" ]]; then
    APP_DIR="$(cd "$SCRIPT_DIR/.." && pwd)"
fi
APP_USER="${APP_USER:-root}"
APP_GROUP="${APP_GROUP:-root}"

echo "[*] App directory: $APP_DIR"
if [[ ! -f "$APP_DIR/artisan" ]]; then
    echo "[!] Tidak ditemukan $APP_DIR/artisan. Clone/upload kode dulu ke $APP_DIR."
    exit 1
fi

cd "$APP_DIR"

# --- .env ---
if [[ ! -f .env ]]; then
    echo "[*] Buat .env dari .env.example..."
    cp .env.example .env
    php artisan key:generate
else
    echo "[*] .env sudah ada."
fi

# --- Composer ---
echo "[*] Composer install..."
composer install --no-dev --optimize-autoloader --no-interaction

# --- RoadRunner binary ---
if [[ ! -f "$APP_DIR/rr" ]]; then
    echo "[*] Unduh binary RoadRunner..."
    php ./vendor/bin/rr get-binary -n
    chmod +x rr
    chown "$APP_USER:$APP_GROUP" rr 2>/dev/null || true
else
    echo "[*] Binary rr sudah ada."
fi


# --- Laravel ---
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache 2>/dev/null || true

# --- Storage & cache ---
php artisan storage:link 2>/dev/null || true
chown -R "$APP_USER:$APP_GROUP" storage bootstrap/cache 2>/dev/null || true
chmod -R 775 storage bootstrap/cache 2>/dev/null || true

# --- SQLite ---
if grep -q "DB_CONNECTION=sqlite" .env 2>/dev/null; then
    if [[ ! -f database/database.sqlite ]]; then
        touch database/database.sqlite
        chown "$APP_USER:$APP_GROUP" database/database.sqlite
        php artisan migrate --force
    fi
fi

echo ""
echo "[✓] Deploy selesai."
echo ""
echo "Jalankan Octane (RoadRunner):"
echo "  cd $APP_DIR && php artisan octane:start --host=0.0.0.0 --port=8000"
echo ""
echo "Atau pasang systemd dan jalankan: systemctl start octane"
echo "  sudo cp scripts/octane.service /etc/systemd/system/"
echo "  sudo systemctl daemon-reload && sudo systemctl enable octane"
echo ""
