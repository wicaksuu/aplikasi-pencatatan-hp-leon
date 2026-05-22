#!/bin/bash
set -e

echo "========================================"
echo "Deploy Script - Aplikasi Pencatatan HP Leon"
echo "========================================"

# Konfigurasi
BRANCH="main"

echo "[1/7] Pull kode terbaru dari GitHub..."
git pull origin "$BRANCH"

echo "[2/7] Install dependensi PHP (production)..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "[3/7] Install dependensi Node.js..."
npm ci

echo "[4/7] Build asset frontend..."
npm run build

echo "[5/7] Jalankan migrasi database..."
php artisan migrate --force --no-interaction

echo "[6/7] Cache konfigurasi, route, dan view..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "========================================"
echo "Deploy selesai!"
echo "========================================"
