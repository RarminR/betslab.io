# BetsLab.io - Platform pentru Pronosticuri Sportive

O platformă SaaS pentru vânzarea de pronosticuri sportive cu sistem de abonamente și integrare Telegram.

## Cerințe

- PHP 8.2+
- Composer
- Node.js 18+
- MySQL 8.0+

## Instalare

### 1. Clonează repository-ul

```bash
git clone <repository-url>
cd betslab.io
```

### 2. Instalează dependențele

```bash
composer install
npm install
```

### 3. Configurează environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurează baza de date

Editează `.env` și setează configurația MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=betslab
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Rulează migrațiile

```bash
php artisan migrate --seed
```

### 6. Build assets

```bash
npm run build
```

### 7. Pornește serverul

```bash
php artisan serve
```

## Configurare Servicii Externe

### Telegram Bot

1. Creează un bot nou prin [@BotFather](https://t.me/BotFather)
2. Creează un canal privat
3. Adaugă botul ca administrator în canal
4. Adaugă în `.env`:

```env
TELEGRAM_BOT_TOKEN=your_bot_token
TELEGRAM_CHANNEL_ID=@your_channel_username
TELEGRAM_INVITE_LINK=https://t.me/+your_invite_link
```

### Netopia Payments

```env
NETOPIA_MERCHANT_ID=your_merchant_id
NETOPIA_PUBLIC_KEY=path_to_public_key
NETOPIA_PRIVATE_KEY=path_to_private_key
NETOPIA_SIGNATURE=your_signature
NETOPIA_SANDBOX=true
```

### Revolut Payments

```env
REVOLUT_API_KEY=your_api_key
REVOLUT_MERCHANT_ID=your_merchant_id
REVOLUT_WEBHOOK_SECRET=your_webhook_secret
REVOLUT_SANDBOX=true
```

## Cron Jobs

Adaugă în crontab:

```bash
* * * * * cd /path/to/betslab.io && php artisan schedule:run >> /dev/null 2>&1
```

Comenzile programate:
- `subscriptions:check-expired` - zilnic la 01:00 - verifică abonamente expirate
- `subscriptions:send-expiry-reminders` - zilnic la 09:00 - trimite reminder-uri
- `telegram:regenerate-invite-link` - săptămânal - regenerează link-ul de invitație

## Structura Proiectului

```
app/
├── Console/Commands/     # Comenzi Artisan
├── Events/              # Evenimente (SubscriptionActivated, TipPublished)
├── Http/
│   ├── Controllers/
│   │   ├── Admin/       # Controllere admin
│   │   └── ...          # Controllere publice
│   └── Middleware/      # Middleware custom
├── Listeners/           # Event listeners
├── Models/              # Eloquent models
├── Notifications/       # Email notifications
└── Services/            # Business logic services
    ├── Payment/         # Payment gateway services
    ├── SubscriptionService.php
    └── TelegramService.php
```

## Credențiale Default

După rularea seed-urilor:

- **Admin**: admin@betslab.io / password
- **User**: test@example.com / password

## Funcționalități

### Pentru Utilizatori
- Înregistrare și autentificare cu verificare email
- Planuri de abonament: Monthly și Lifetime
- Dashboard cu statistici
- Acces la pronosticuri detaliate
- Acces la canal Telegram privat

### Pentru Admin
- Dashboard cu statistici complete
- CRUD pronosticuri cu multiple selecții
- Publicare pronosticuri pe Telegram
- Gestionare utilizatori și abonamente
- Creare manuală abonamente

### Sistem de Plăți
- Integrare Netopia (mobilpay)
- Integrare Revolut
- Webhook-uri pentru confirmare plăți
- Istoric plăți complet

### Integrare Telegram
- Trimitere automată pronosticuri pe canal
- Trimitere rezultate
- Link de invitație pentru abonați activi

## Licență

Proprietar - Toate drepturile rezervate.
