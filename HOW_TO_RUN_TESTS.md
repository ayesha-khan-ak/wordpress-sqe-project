# How to Run and Verify Tests - Complete Guide

## 🎯 Overview

This guide shows you **WHERE** and **HOW** to run all three types of tests and verify they're working correctly:
1. **Backend Tests (PHPUnit)**
2. **Frontend Tests (Cypress)**
3. **API Tests (PHPUnit)**

---

## 📋 Prerequisites Checklist

Before running tests, ensure you have:

- [ ] **WordPress cloned** ✅ (Located at `wordpress/` directory)
- [ ] Docker Desktop installed and running
- [ ] WordPress running via Docker (`docker-compose up -d`)
- [ ] Node.js installed (for Cypress)
- [ ] Git repository cloned

---

## 1. BACKEND TESTS (PHPUnit) - How to Run

### **Platform: Docker Container (Recommended)**

Since PHP and Composer are not available locally on Windows, we'll run tests **inside the Docker container**.

### **Step-by-Step Instructions:**

#### **Step 1: Start WordPress Environment**
```bash
# Open PowerShell/Terminal in project directory
docker-compose up -d
```

**Verify WordPress is running:**
- Open browser: http://localhost:8082
- You should see WordPress installation/site

#### **Step 2: Enter WordPress Docker Container**
```bash
docker exec -it wordpress-sqe bash
```

**You're now inside the container!** Your prompt will change to show you're in the container.

#### **Step 3: Install PHP Dependencies (First Time Only)**
```bash
# Inside container, navigate to project (if mounted)
cd /var/www/html  # or wherever your project is mounted

# Install Composer dependencies
composer install
```

**Expected Output:**
```
Loading composer repositories with package information
Installing dependencies...
Package operations: X installs, Y updates
```

#### **Step 4: Run Backend Tests**

**Run ALL tests:**
```bash
./vendor/bin/phpunit
```

**Run only Unit Tests:**
```bash
./vendor/bin/phpunit --testsuite "Unit Tests"
```

**Run only Integration Tests:**
```bash
./vendor/bin/phpunit --testsuite "Integration Tests"
```

**Run specific test file:**
```bash
./vendor/bin/phpunit tests/unit/UserTest.php
```

**Run with verbose output:**
```bash
./vendor/bin/phpunit --verbose
```

### **What You'll See (Expected Output):**

```
PHPUnit 9.5.x by Sebastian Bergmann and contributors.

..........................................................  60 / 60 (100%)

Time: 00:05.234, Memory: 50.00 MB

OK (60 tests, 120 assertions)
```

✅ **Green "OK"** = All tests passed!
❌ **Red "FAILURES"** = Some tests failed (check the error messages)

### **Generate Test Coverage Report:**
```bash
composer test:coverage
# or
./vendor/bin/phpunit --coverage-html coverage
```

**View Coverage Report:**
- Coverage report will be in `coverage/` directory
- Open `coverage/index.html` in browser to see detailed coverage

### **Exit Container:**
```bash
exit
```

---

## 2. FRONTEND TESTS (Cypress) - How to Run

### **Platform: Local Machine (Your Windows PC)**

Cypress runs on your local machine and connects to WordPress running in Docker.

### **Step-by-Step Instructions:**

#### **Step 1: Ensure WordPress is Running**
```bash
docker-compose ps
```

**Verify:**
- WordPress container is running
- Accessible at http://localhost:8082

#### **Step 2: Install Node Dependencies (First Time Only)**
```bash
# In PowerShell (project directory)
npm install
```

**Expected Output:**
```
added 250 packages, and audited 250 packages in 30s
```

#### **Step 3: Update Test Credentials**

Edit `cypress.config.js` to set your WordPress admin credentials:

```javascript
env: {
  wpAdminUsername: 'admin',        // Your WordPress admin username
  wpAdminPassword: 'your_password' // Your WordPress admin password
}
```

#### **Step 4: Run Frontend Tests**

### **Option A: Interactive Mode (RECOMMENDED - See Tests Running!)**

```bash
npm run test:open
# or
npx cypress open
```

**What Happens:**
1. Cypress Test Runner opens in a new window
2. You'll see all test files listed
3. Click on a test file (e.g., `login.cy.js`)
4. Tests run in a real browser (Chrome, Firefox, or Electron)
5. **You can watch tests execute in real-time!**

**Visual Feedback:**
- ✅ Green checkmarks = Test passed
- ❌ Red X = Test failed
- Blue highlights = Current action
- Command log shows all steps

### **Option B: Headless Mode (For CI/CD)**

```bash
npm test
# or
npm run test:headless
# or
npx cypress run
```

**What Happens:**
- Tests run in headless browser (no GUI)
- Results shown in terminal
- Videos saved to `cypress/videos/`
- Screenshots on failure in `cypress/screenshots/`

**Expected Output:**
```
Running: login.cy.js                                    
  ✓ TC-FE-001: Should login successfully (5234ms)
  ✓ TC-FE-002: Should fail login with invalid password (2341ms)
  ✓ TC-FE-003: Should logout successfully (3456ms)

3 passing (15s)
```

### **Run Specific Test File:**
```bash
npx cypress run --spec "cypress/e2e/login.cy.js"
```

### **Run Tests in Specific Browser:**
```bash
npx cypress run --browser chrome
npx cypress run --browser firefox
npx cypress run --browser edge
```

### **View Test Results:**
- **Videos:** `cypress/videos/` - Watch recordings of test runs
- **Screenshots:** `cypress/screenshots/` - Screenshots of failures
- **Terminal:** Test results printed in terminal

---

## 3. API TESTS (PHPUnit) - How to Run

API tests are part of the PHPUnit integration tests.

### **Platform: Docker Container**

### **Step-by-Step Instructions:**

#### **Step 1: Enter WordPress Container**
```bash
docker exec -it wordpress-sqe bash
```

#### **Step 2: Run API Tests Specifically**
```bash
# Run only API integration tests
./vendor/bin/phpunit tests/integration/APITest.php

# Run with detailed output
./vendor/bin/phpunit tests/integration/APITest.php --verbose
```

### **What You'll See (Expected Output):**

```
PHPUnit 9.5.x by Sebastian Bergmann and contributors.

........                                                        8 / 8 (100%)

Time: 00:03.456, Memory: 45.00 MB

OK (8 tests, 24 assertions)

Tests for REST API endpoints:
✓ test_get_posts_endpoint
✓ test_create_post_via_api
✓ test_get_single_post_endpoint
✓ test_update_post_via_api
✓ test_delete_post_via_api
✓ test_api_authentication_requirement
✓ test_api_pagination
✓ test_api_error_handling
```

✅ **Green "OK"** = All API tests passed!

### **Test Individual API Endpoint:**

You can also test API endpoints manually using:

#### **Option 1: Browser/Postman**
1. Open browser or Postman
2. Test endpoint: `http://localhost:8082/wp-json/wp/v2/posts`
3. Should return JSON response with posts

#### **Option 2: cURL (in container)**
```bash
# Inside container
curl http://localhost/wp-json/wp/v2/posts
```

---

## 📊 WHERE TO VERIFY TESTS ARE WORKING

### **1. Backend Tests Verification:**

| Platform | Tool | Location |
|----------|------|----------|
| **Docker Container** | PHPUnit CLI | Terminal output |
| **Coverage Reports** | HTML Browser | `coverage/index.html` |
| **Test Results** | Terminal | Console output |

**Verification Points:**
- ✅ Terminal shows "OK (X tests, Y assertions)"
- ✅ No red error messages
- ✅ Coverage report shows test coverage percentage
- ✅ All test methods appear in output

### **2. Frontend Tests Verification:**

| Platform | Tool | Location |
|----------|------|----------|
| **Interactive Mode** | Cypress Test Runner | GUI Application |
| **Headless Mode** | Terminal | Console output |
| **Test Videos** | Video Player | `cypress/videos/` folder |
| **Screenshots** | Image Viewer | `cypress/screenshots/` folder |

**Verification Points:**
- ✅ Cypress Test Runner shows all tests passing (green)
- ✅ Browser opens and you can see tests running
- ✅ No red error messages
- ✅ Videos show successful test execution
- ✅ All test cases appear in results

### **3. API Tests Verification:**

| Platform | Tool | Location |
|----------|------|----------|
| **Docker Container** | PHPUnit CLI | Terminal output |
| **Manual Testing** | Postman/Browser | http://localhost:8082/wp-json/wp/v2/posts |
| **cURL** | Terminal | Command line output |

**Verification Points:**
- ✅ PHPUnit shows API tests passing
- ✅ Postman/Browser shows JSON response from API
- ✅ Response contains expected data structure
- ✅ Status codes are correct (200, 201, etc.)

---

## 🔍 Quick Verification Checklist

### **Backend Tests (PHPUnit):**
- [ ] Docker container accessible
- [ ] `composer install` completed successfully
- [ ] `./vendor/bin/phpunit` runs without errors
- [ ] All tests show "OK" status
- [ ] Test count matches expected (38 tests)

### **Frontend Tests (Cypress):**
- [ ] WordPress accessible at http://localhost:8082
- [ ] `npm install` completed successfully
- [ ] `npm run test:open` opens Cypress Test Runner
- [ ] Tests run and show green checkmarks
- [ ] Browser shows WordPress pages loading

### **API Tests:**
- [ ] PHPUnit API tests run successfully
- [ ] API endpoint accessible: http://localhost:8082/wp-json/wp/v2/posts
- [ ] JSON response contains expected data
- [ ] All 8 API test methods pass

---

## 🎥 Visual Verification Guide

### **Backend Tests - What You'll See:**

```
PS C:\Users\Ayesha\Desktop\SQE Project> docker exec -it wordpress-sqe bash
root@container:/var/www/html# ./vendor/bin/phpunit

PHPUnit 9.5.21 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.0.30
Configuration: /var/www/html/phpunit.xml

..........................................................  38 / 38 (100%)

Time: 00:04.123, Memory: 48.00 MB

OK (38 tests, 156 assertions)
```

### **Frontend Tests - What You'll See:**

**Cypress Test Runner:**
- Left panel: List of test files
- Right panel: Browser window showing tests running
- Command log: Step-by-step test execution
- Status: Green checkmarks for passed tests

**Terminal Output (Headless):**
```
  Running: login.cy.js                                    (1 of 4)

  ✓ TC-FE-001: Should login successfully (5234ms)
  ✓ TC-FE-002: Should fail login with invalid password (2341ms)
  ✓ TC-FE-003: Should logout successfully (3456ms)

  3 passing (12s)
```

---

## 🐛 Troubleshooting

### **Backend Tests Not Running:**

**Problem:** "Command not found: phpunit"
- **Solution:** Run `composer install` first

**Problem:** "WordPress functions not found"
- **Solution:** Ensure WordPress is loaded in bootstrap.php

**Problem:** "Database connection failed"
- **Solution:** Check database credentials in phpunit.xml

### **Frontend Tests Not Running:**

**Problem:** "Cannot connect to http://localhost:8082"
- **Solution:** Ensure Docker containers are running (`docker-compose up -d`)

**Problem:** "Login tests failing"
- **Solution:** Update credentials in `cypress.config.js`

**Problem:** "npm command not found"
- **Solution:** Install Node.js from nodejs.org

### **API Tests Not Running:**

**Problem:** "API endpoint returns 404"
- **Solution:** Ensure WordPress REST API is enabled
- **Solution:** Check WordPress is properly installed

**Problem:** "Authentication failed"
- **Solution:** Ensure test user has proper permissions

---

## 📝 Summary - Where to Run Each Test

| Test Type | Platform | Command | Visual Output |
|-----------|----------|---------|---------------|
| **Backend** | Docker Container | `./vendor/bin/phpunit` | Terminal |
| **Frontend** | Local Machine | `npm run test:open` | Cypress GUI + Browser |
| **API** | Docker Container | `./vendor/bin/phpunit tests/integration/APITest.php` | Terminal |

---

## 🎯 Next Steps

1. **First Time Setup:**
   - Start Docker: `docker-compose up -d`
   - Install dependencies: `composer install` (in container) + `npm install` (local)

2. **Run Backend Tests:**
   - Enter container: `docker exec -it wordpress-sqe bash`
   - Run tests: `./vendor/bin/phpunit`

3. **Run Frontend Tests:**
   - Open Cypress: `npm run test:open`
   - Watch tests run visually!

4. **Verify Everything:**
   - Check all tests pass
   - Review test coverage
   - Watch test videos

---

**Ready to test? Follow the steps above and you'll see all your tests running!** 🚀

