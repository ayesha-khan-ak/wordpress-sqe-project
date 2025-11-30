# Quick Start Guide - WordPress CI/CD Project

## 🚀 Getting Started in 5 Steps

### Step 1: Install Prerequisites

**Required:**
- [Docker Desktop](https://www.docker.com/products/docker-desktop) - For running WordPress locally
- [Git](https://git-scm.com/downloads) - Version control
- [Node.js](https://nodejs.org/) (v16+) - For Cypress testing
- [PHP](https://www.php.net/downloads.php) (7.4+) - For PHPUnit testing
- [Composer](https://getcomposer.org/download/) - PHP dependency manager

**Check installations:**
```bash
docker --version
git --version
node --version
npm --version
php --version
composer --version
```

---

### Step 2: Set Up Local WordPress Environment

1. **Start WordPress using Docker:**
   ```bash
   docker-compose up -d
   ```

2. **Wait for containers to start** (about 30 seconds)

3. **Access WordPress:**
   - **WordPress Site:** http://localhost:8080
   - **phpMyAdmin:** http://localhost:8081
   - **Database:** 
     - Host: `db`
     - User: `wordpress`
     - Password: `wordpress`
     - Database: `wordpress`

4. **Complete WordPress Installation:**
   - Go to http://localhost:8080
   - Follow WordPress setup wizard
   - Create admin account
   - Note your credentials!

---

### Step 3: Install Testing Dependencies

**Backend Testing (PHPUnit):**
```bash
composer install
```

**Frontend Testing (Cypress):**
```bash
npm install
```

---

### Step 4: Verify Setup

**Test PHPUnit:**
```bash
./vendor/bin/phpunit --version
```

**Test Cypress:**
```bash
npx cypress --version
```

**Test Docker:**
```bash
docker ps
```
You should see `wordpress-sqe`, `wordpress-db`, and `wordpress-phpmyadmin` running.

---

### Step 5: Initialize Git Repository

```bash
# Initialize git (if not already done)
git init

# Add all files
git add .

# Make initial commit
git commit -m "Initial project setup"

# Connect to remote repository (GitHub/GitLab)
git remote add origin <your-repository-url>
git branch -M main
git push -u origin main
```

---

## 📋 Next Steps

### Immediate Actions:
1. ✅ WordPress running locally
2. ⏭️ **Start Phase 2: Test Plan Development**
   - Review WordPress features
   - Document test objectives
   - Create test cases

### This Week:
- [ ] Complete WordPress local setup
- [ ] Understand WordPress structure
- [ ] Review WordPress REST API
- [ ] Start drafting test plan

### Next Week:
- [ ] Complete test plan document
- [ ] Set up GitHub Actions
- [ ] Write first test cases

---

## 🛠️ Useful Commands

### Docker Commands:
```bash
# Start WordPress
docker-compose up -d

# Stop WordPress
docker-compose down

# View logs
docker-compose logs -f

# Restart WordPress
docker-compose restart
```

### Testing Commands:
```bash
# Run PHPUnit tests
./vendor/bin/phpunit

# Run Cypress tests (interactive)
npm run test:open

# Run Cypress tests (headless)
npm run test
```

### Git Commands:
```bash
# Check status
git status

# Create new branch
git checkout -b feature/test-plan

# Commit changes
git add .
git commit -m "Your message"
```

---

## 📚 Documentation

- **Project Roadmap:** [WORDPRESS_PROJECT_ROADMAP.md](./WORDPRESS_PROJECT_ROADMAP.md)
- **Project Analysis:** [PROJECT_ANALYSIS.md](./PROJECT_ANALYSIS.md)
- **Selection Analysis:** [PROJECT_SELECTION_ANALYSIS.md](./PROJECT_SELECTION_ANALYSIS.md)

---

## ❓ Troubleshooting

### WordPress not accessible?
- Check if Docker is running: `docker ps`
- Check if port 8080 is available
- Try: `docker-compose restart`

### Composer install fails?
- Ensure PHP is installed: `php --version`
- Update Composer: `composer self-update`

### Cypress not working?
- Ensure Node.js is installed: `node --version`
- Clear npm cache: `npm cache clean --force`
- Reinstall: `rm -rf node_modules && npm install`

---

## 🎯 Project Timeline Reminder

- **Deadline:** December 07, 2025
- **Current Phase:** Phase 1 - Project Setup
- **Next Phase:** Phase 2 - Test Plan Development

**You're all set! Start working on Phase 2: Test Plan Development.**

