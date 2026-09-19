# Deploying Flog to Render (Free Tier)

This guide deploys the blog 100% free using [Render](https://render.com).

## What you get (free)
- Web service (512 MB RAM) — spins down after ~15 min idle, wakes in ~1 min on the next visit
- PostgreSQL database (1 GB) — **expires 30 days after creation**; after that you either upgrade (~$6/mo) or it gets deleted
- 750 free instance-hours per workspace per month
- Free TLS/HTTPS on `https://flog-blog.onrender.com`

Best for a portfolio / demo. Re-seeding is built into the deploy, so a lost DB is recoverable.

> Not for production. Free instances have no persistent disk (uploaded files are lost on restart) and no SSH console.

## Prerequisites
- This repo pushed to GitHub (already done: `origin/main`)
- A free [Render account](https://render.com) (no credit card required)

## Steps

1. Push this branch with the `render.yaml` included:
   ```bash
   git add render.yaml
   git commit -m "chore: add render blueprint for free deployment"
   git push origin main
   ```

2. In the Render Dashboard: **New → Blueprint** (or "New Blueprint Instance").
3. Pick the `Flog-DEV/Blog` repo → Render reads `render.yaml` and creates:
   - `flog-blog` web service
   - `flog-blog-db` PostgreSQL (free)
4. Click **Apply**. First deploy builds, then runs `migrate --seed` automatically (demo users/posts included).

Your site is live at `https://flog-blog.onrender.com`.

## Demo logins (seeded)
- demo user: `user1@flog.com` … `user6@flog.com`, password: `password`
- (check `database/seeders/UsersSeeder.php` for the exact list)

## Post-deploy notes
- Email verification uses Laravel's `log` mailer: verification links are written to logs, never actually sent. Set a real mailer (e.g. Brevo/Mailtrap) in Render env vars if you want emails.
- Uploaded images: free instances lose the local filesystem on restart, so demo avatars/covers are served from external URLs (picsum). Local uploads won't survive a restart — avoid relying on them on the free plan.
- The free Postgres is deleted after 30 days (14-day grace). Re-deploying re-runs `migrate --seed` and rebuilds the demo data. To keep data long-term, upgrade the DB to a paid `Basic` (~$6/mo).
- Sessions are stored in the DB (`SESSION_DRIVER=database`) so logins survive service restarts.

## Useful Render env vars
`APP_DEBUG=false` is already set. To tweak anything live, edit **Environment** on the service in the Render dashboard (e.g. `MAIL_MAILER=smtp`, `MAIL_HOST`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_FROM_ADDRESS`).

## Troubleshooting
- **Deploy fails on `composer install`** → make sure `composer.lock` is committed (it is). 
- **403/404 after deploy** → `rootDir: public` is already set; the app must start from the `public/` folder.
- **Blank page, 500 on login** → check `php artisan config:cache` env vars; run a manual deploy from the dashboard and view the logs.
- **Cold start** → first request after idle takes ~1 min; refresh once and it's fast.