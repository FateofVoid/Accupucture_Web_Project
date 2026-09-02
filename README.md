# Heng Ren Tang website

Multilingual PHP website for Heng Ren Tang Acupuncture Clinic. The production
site runs on Yourhosting shared hosting through Plesk; no Node.js or build step
is required.

## Local verification

Requirements: PHP 8.4 or a compatible PHP 8.x release.

```powershell
Get-ChildItem -Recurse -Filter *.php | ForEach-Object { php -l $_.FullName }
php -S 127.0.0.1:8080
```

Open `http://127.0.0.1:8080/?lang=en&page=home`.

## GitHub to Plesk deployment

1. Push the production branch to GitHub.
2. In Yourhosting, open **Plesk > Websites & Domains > Git**.
3. Choose **Add Repository**, use the GitHub repository URL, and select the
   production branch.
4. Set the deployment target to the domain's document root, normally
   `/httpdocs`.
5. Set the repository deployment mode to **Manual deployment**. Do not enable
   automatic deployment: GitHub commits must not be published without release
   approval.
6. For an approved release, click **Pull Updates** and then **Deploy from
   Repository** in Plesk. A webhook may fetch changes automatically, but it
   must not automatically deploy them.
7. After every deployment, verify the English, Dutch and Spanish home and staff
   pages, the contact form, appointment link, and static assets.

Do not commit hosting credentials, Formspree secrets, Plesk webhook URLs or
backups. The `_bck_*` deployment snapshots are deliberately ignored.
