# RMS (Restaurant Management System)

Laravel 12 + Jetstream/Livewire based Restaurant Management System with:

- Public menu + add-to-cart
- Auth (Jetstream/Fortify) + Google OAuth login (Socialite)
- Order placement + email notifications
- Table booking + admin approval
- Admin panel for menu management, orders, and reservations

## Requirements

- PHP 8.2+
- Composer
- Node.js + npm
- MySQL (recommended)

## Setup (local)

From the `RMS/` folder:

```bash
composer setup
php artisan serve
```

If you want to do it manually:

```bash
composer install
copy env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
npm install
npm run build
php artisan serve
```

## Admin access

Users are stored in the `users` table. Set `usertype` to `admin` for an admin account.

## Mail + Google login

Update these in `.env`:

- `MAIL_*` for sending emails
- `GOOGLE_CLIENT_ID`, `GOOGLE_CLIENT_SECRET`, `GOOGLE_REDIRECT_URI`

## Tests

```bash
php artisan test
```

