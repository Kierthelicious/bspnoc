# Laravel to Vercel Walkthrough (No Laravel Preset)

This guide explains how to deploy this Laravel project on Vercel when there is no Laravel preset in **Application Preset**.

## 1) Project preparation (already added in this repo)

Make sure these files exist:

- `vercel.json`
- `api/index.php`

These let Vercel run PHP and route all requests to Laravel.

## 2) Push your code to GitHub

1. Commit your changes (including `vercel.json` and `api/index.php`).
2. Push to your repository branch.

## 3) Create project in Vercel

1. In Vercel, click **New Project** and import your GitHub repo.
2. If **Application Preset** defaults to `Vite`, that is fine.
3. Keep **Root Directory** as `./` (repo root).

## 4) Build & output settings in Vercel UI

In the deploy form:

- **Build Command**: `npm run build`
- **Output Directory**: leave empty / disabled
- **Install Command**: leave default / empty

Why: Laravel routing is handled by `vercel.json`, not by a static `dist` output.

## 5) Environment variables to add in Vercel

Add these variables in Vercel Project Settings -> Environment Variables:

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_KEY=base64:...`
- `APP_URL=https://bspnoc.vercel.app`

Database variables (example names):

- `DB_CONNECTION`
- `DB_HOST`
- `DB_PORT`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`

Also add any API/mail keys used by the app.

## 6) Which URL to use for APP_URL

Use your stable production domain:

- `https://bspnoc.vercel.app`

Do not use the random deployment URL (for example `bspnoc-gyly4freq-kierthelicious-projects.vercel.app`) as main `APP_URL`, because it changes per deployment.

## 7) APP_KEY generation

Generate locally:

```bash
php artisan key:generate --show
```

Copy the generated value into Vercel `APP_KEY`.

## 8) Deploy

1. Click **Deploy** in Vercel.
2. Open deployment logs and confirm:
   - front-end build succeeds (`vite build`)
   - PHP function is created from `api/index.php`
3. Visit `https://bspnoc.vercel.app`.

## 9) Common post-deploy checks

- Ensure assets load from `/build/...`.
- Test database-backed pages/features.
- If sessions/cache are used, configure persistent backends (Redis/DB), not local files only.

## 10) Troubleshooting quick fixes

- **404 on routes**: confirm `vercel.json` catch-all route points to `/api/index.php`.
- **Missing APP_KEY error**: set correct `APP_KEY` in Vercel env vars.
- **DB connection fails**: verify DB host/user/password and allowed IP/network access.
- **Static assets missing**: confirm `npm run build` runs and `public/build` is generated.

