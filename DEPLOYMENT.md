# Deploying Flog

This project ships **no deployment configuration files** — the app is a standard Laravel 11
build (PHP + MySQL/Postgres + Vite assets), so it runs on any host that can serve PHP.
Below are the free options and the general steps for each.

## General deploy checklist (any host)

1. Commit `composer.lock` and `package-lock.json` (both are in the repo).
2. Build assets: `npm ci && npm run build` (Vite requires the build so `@vite` finds a manifest).
3. Set env vars (at minimum):
   ```sh
   APP_ENV=production
   APP_DEBUG=false
   APP_KEY=<php artisan key:generate --show>
   APP_URL=https://your-domain
   DB_CONNECTION=mysql   # or pgsql on Render
   DB_HOST=...
   DB_PORT=3306
   DB_DATABASE=...
   DB_USERNAME=...
   DB_PASSWORD=...
   QUEUE_CONNECTION=sync # avoids needing a queue worker
   SESSION_DRIVER=database
   ```
4. Run `php artisan migrate --seed --force` and `php artisan storage:link`.
5. Serve from the `public/` directory (nginx/Apache document root, or `php artisan serve` for demos).

## Option A — Render.com (free, easiest)

**Free tier:** web service (512 MB) + free Postgres (1 GB). No credit card required.
Limits: service sleeps after ~15 min idle (wakes in ~1 min), 750 free instance-hours/month,
and the free database **expires 30 days after creation**.

> The Blueprint (`render.yaml`) flow sometimes demands a card because it defaults a resource to a
> paid plan — the manual flow below avoids that.

1. Dashboard → **New → Web Service** → connect the repo → branch `main`.
2. Runtime: **PHP**; Root directory: `public`; Instance type: **Free** (select it explicitly).
3. Build command:
   ```
   composer install --no-dev --optimize-autoloader --no-interaction
   npm ci --no-audit --no-fund
   npm run build
   php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan event:cache
   ```
4. Pre-deploy command: `php artisan migrate --seed --force && php artisan storage:link || true`
5. **New → PostgreSQL** → plan **Free**, then set the `DB_*` environment variables above on the
   web service (copy them from the database's connection string).
6. Also set `QUEUE_CONNECTION=sync`, `SESSION_DRIVER=database`, `APP_KEY`, `APP_DEBUG=false`.

Live at `https://<name>.onrender.com`.

## Option B — Oracle Cloud Always Free (permanent VM, no cold starts)

Provides a real always-on Ubuntu VM (Ampere ARM, up to 4 OCPU / 24 GB RAM) + 20 GB free MySQL DB —
**forever** (card required at signup only for identity verification; not charged).

1. Create an Always Free **Ampere A1** instance (Ubuntu 24.04).
2. In the security list, open ports `80` and `443`.
3. SSH in and install: nginx, PHP 8.3, PHP-FPM, Composer, Node.js, MariaDB.
4. `git clone`, run the general checklist above, point nginx at `public/`.
5. Add SSL with `certbot --nginx` (Let's Encrypt, free).
6. Keep the box warm — Oracle reclaims **idle** always-free instances.

## Option C — AWS Free Tier (12 months only)

`t3.micro` (750 h/mo) + free RDS MySQL for the **first 12 months**; every resource starts billing
afterwards (~$10/mo). Use only for temporary demos. `brew`-style one-click via Elastic Beanstalk.

## Demo logins (seeded)

`user1@flog.com` … `user6@flog.com`, password: `password`
(check `database/seeders/UsersSeeder.php`).

## Notes on the free tiers

- Uploaded files live on the local filesystem; free hosts with no persistent disk lose uploads on
  restart — demo avatars/covers are external (picsum) URLs and survive anywhere.
- Email verification uses the `log` mailer by default; set real SMTP env vars (e.g. Brevo) if you
  want actual emails.
- Render free Postgres self-deletes after 30 days; re-running `migrate --seed` rebuilds the demo
  data.