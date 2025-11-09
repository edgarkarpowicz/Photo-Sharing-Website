# GitHub Repository Setup Guide

## 📝 GitHub Repository Description

Use this description when creating your repository on GitHub:

```
Fotoverso - A full-featured photo sharing social network built with PHP and MySQL. Upload, organize photos into galleries, explore content from other users, and manage your photography collection. Features user authentication, advanced filtering, category management, and an admin dashboard. Built with Bootstrap 5, PHP, and MariaDB.
```

## 🏷️ Suggested Topics/Tags for GitHub

Add these topics to your repository for better discoverability:

- `php`
- `mysql`
- `bootstrap`
- `photo-sharing`
- `social-network`
- `web-application`
- `gallery`
- `image-upload`
- `mariadb`
- `adminlte`
- `jquery`
- `html-css-javascript`

## 🚀 Step-by-Step Git Upload Procedure

### Prerequisites
1. Install Git: https://git-scm.com/downloads
2. Create a GitHub account: https://github.com
3. Open PowerShell or Git Bash in your project directory

### Step 1: Initialize Git Repository

Open PowerShell in your project folder and run:

```powershell
cd "d:\2024\LAB 3 - Sitio WEB\LAB III - Sitio WEB - Final"
git init
```

### Step 2: Configure Git (First Time Only)

Set your Git username and email:

```powershell
git config --global user.name "Your Name"
git config --global user.email "your.email@example.com"
```

### Step 3: Add Files to Git

Add all files except those in .gitignore:

```powershell
git add .
```

Verify what will be committed:

```powershell
git status
```

You should see that the .pdf and .docx files are NOT listed (they're ignored).

### Step 4: Create Your First Commit

```powershell
git commit -m "Initial commit: Fotoverso photo sharing platform"
```

### Step 5: Create a GitHub Repository

1. Go to https://github.com
2. Click the **"+"** icon in the top right
3. Select **"New repository"**
4. Fill in the details:
   - **Repository name:** `fotoverso` (or your preferred name)
   - **Description:** (Use the description provided above)
   - **Visibility:** Choose Public or Private
   - **⚠️ DO NOT** initialize with README, .gitignore, or license (you already have them)
5. Click **"Create repository"**

### Step 6: Connect Local Repository to GitHub

After creating the repository, GitHub will show you commands. Use these:

```powershell
git remote add origin https://github.com/YOUR_USERNAME/fotoverso.git
git branch -M main
```

### Step 7: Push to GitHub

```powershell
git push -u origin main
```

You may be prompted to login to GitHub. Use your credentials or a Personal Access Token.

### Step 8: Verify Upload

1. Go to your repository URL: `https://github.com/YOUR_USERNAME/fotoverso`
2. Verify that all files are uploaded
3. Check that **PDF - LAB III - Sitio WEB - Informe.pdf** and **LAB III - Sitio WEB - Informe.docx** are NOT present
4. Confirm that README.md displays correctly

## 🔄 Future Updates

When you make changes to your project:

```powershell
# Check what changed
git status

# Add changed files
git add .

# Or add specific files
git add path/to/file.php

# Commit with a descriptive message
git commit -m "Description of changes"

# Push to GitHub
git push
```

## 📋 Useful Git Commands

```powershell
# View commit history
git log

# View current status
git status

# View differences
git diff

# Create a new branch
git checkout -b feature-name

# Switch branches
git checkout main

# Undo uncommitted changes
git restore .

# View remote repository
git remote -v
```

## 🛡️ Security Reminder

**⚠️ IMPORTANT:** Before pushing to a public repository, ensure you:

1. Remove or replace database credentials in PHP files
2. Remove any sensitive information
3. Consider using environment variables for configuration

You can search for database credentials with:

```powershell
Get-ChildItem -Recurse -Filter *.php | Select-String -Pattern "password"
```

Replace hardcoded credentials with:

```php
// Load from environment or config file
$password = getenv('DB_PASSWORD') ?: 'default_password';
```

## 📞 Troubleshooting

### Authentication Issues

If you have trouble authenticating:

1. Generate a Personal Access Token:
   - Go to GitHub Settings → Developer settings → Personal access tokens → Tokens (classic)
   - Generate new token with `repo` scope
   - Use this token as your password when prompted

### Large Files

If you have files larger than 100MB, consider:
- Adding them to .gitignore
- Using Git LFS (Large File Storage)

### Already Committed Sensitive Data?

If you accidentally committed sensitive data:

```powershell
# Remove from tracking but keep locally
git rm --cached path/to/file

# Commit the removal
git commit -m "Remove sensitive file"

# Push
git push
```

## ✅ Checklist Before Publishing

- [ ] README.md is complete and accurate
- [ ] .gitignore excludes .pdf and .docx files
- [ ] Database credentials are removed or replaced
- [ ] No sensitive information in code
- [ ] All files are properly committed
- [ ] Repository description and topics are set
- [ ] License is chosen (if desired)
- [ ] Contact information is updated

---

**Good luck with your project! 🚀**
