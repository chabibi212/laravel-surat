
## Installation
1. Clone repository
2. Install dependencies composer

        composer install --no-dev #for production

        composer install #for development

3. Copy file environment

        cp .env.mail .env

4. Generate application key

        php artisan key:generate
4. Migrate

        php artisan migrate

## Test
Test with phpunit

    ./vendor/bin/phpunit

Test with laravel dusk
    
    php artisan dusk

## How to Use
Pada manajemen surat masuk dan surat keluar terdapat 2 pengguna yaitu :
1. Super Admin
2. Sekretaris

### Super Admin
Super Admin berfungsi sebagai pengatur semua data yang ada pada aplikasi, super admin bisa mengelola data jabatan, pegawai, surat masuk, dan surat keluar
Akun :

    nip : 7281728192
    password : secret


<BIBOB212/># laravel-arsip
# laravel-pengarsipan
# laravel-surat
# laravel-surat
# laravel-pengarsipan
# laravel-pengarsipan
