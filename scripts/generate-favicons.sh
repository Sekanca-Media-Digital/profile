#!/usr/bin/env bash
#
# Generate favicon sizes sesuai rekomendasi Google Search
# 96x96, 192x192 (dari 48x48), favicon.ico
# Dibutuhkan: ImageMagick (convert) atau: brew install imagemagick / apt install imagemagick
#
set -e

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]:-$0}")" && pwd)"
PUBLIC_DIR="${PUBLIC_DIR:-$SCRIPT_DIR/../public}"
SRC="$PUBLIC_DIR/favicon-48x48.png"

if [[ ! -f "$SRC" ]]; then
    echo "[!] Tidak ditemukan $SRC. Buat favicon-48x48.png dulu."
    exit 1
fi

if ! command -v convert &>/dev/null; then
    echo "[!] ImageMagick (convert) tidak ditemukan. Install: brew install imagemagick atau apt install imagemagick"
    exit 1
fi

echo "[*] Generate favicon sizes (Google: 96x96, 192x192, favicon.ico)..."
convert "$SRC" -resize 96x96 "$PUBLIC_DIR/favicon-96x96.png"
convert "$SRC" -resize 192x192 "$PUBLIC_DIR/favicon-192x192.png"
convert "$SRC" -resize 48x48 "$PUBLIC_DIR/favicon.ico"
echo "[✓] favicon-96x96.png, favicon-192x192.png, favicon.ico dibuat."
