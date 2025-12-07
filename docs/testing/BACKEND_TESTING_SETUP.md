# Backend Testing Setup - Complete Guide

## ✅ STEP 1: WORDPRESS CLONED

**Location:** `wordpress/` directory in project root

**Full Path:** `C:\Users\Ayesha\Desktop\SQE Project\wordpress\`

WordPress core files have been cloned from: https://github.com/WordPress/WordPress

✅ **Status:** WordPress is cloned and ready for testing!

---

## 📍 STEP 2: WHERE ARE THE TEST CASES?

### **Backend Test Files Location:**

All test cases are located in the `tests/` directory:

```
tests/
├── unit/                          ← UNIT TESTS HERE
│   ├── UserTest.php              ← User authentication tests (8 test methods)
│   ├── PostTest.php              ← Post CRUD tests (8 test methods)
│   └── DatabaseTest.php          ← Database query tests (6 test methods)
│
├── integration/                   ← INTEGRATION TESTS HERE
│   ├── AuthenticationTest.php    ← Complete auth flow tests (8 test methods)
│   └── APITest.php               ← REST API tests (8 test methods)
│
├── helpers/
│   └── test-helpers.php          ← Helper functions for tests
│
└── bootstrap.php                 ← Test bootstrap configuration
```

### **Test Cases Summary:**

**Unit Tests (22 test methods):**
1. `tests/unit/UserTest.php` - 8 methods
   - TC-BE-001: User Authentication - Login
   - TC-BE-002: User Authentication - Invalid Credentials
   - User creation, deletion, password hashing

2. `tests/unit/PostTest.php` - 8 methods
   - TC-BE-003: Post Creation
   - TC-BE-004: Post Update
   - TC-BE-005: Post Deletion

3. `tests/unit/DatabaseTest.php` - 6 methods
   - TC-BE-008: Database Query - Retrieve Posts

**Integration Tests (16 test methods):**
1. `tests/integration/AuthenticationTest.php` - 8 methods
   - Complete login/logout flows

2. `tests/integration/APITest.php` - 8 methods
   - TC-BE-006: REST API - Get Posts
   - TC-BE-007: REST API - Create Post

**Total: 38 test methods in 5 test files**

---

## 🛠️ STEP 3: BACKEND TESTING PLATFORM & TOOL

### **Platform: Docker Container**

We run backend tests **inside the WordPress Docker container** because:
- PHP and Composer are available in the container
- WordPress is already installed and running
- Database is accessible
- All dependencies are configured

### **Testing Tool: PHPUnit**

**Tool:** PHPUnit 9.5  
**Framework:** wp-phpunit (WordPress PHPUnit integration)  
**Location:** Installed via Composer (`./vendor/bin/phpunit`)

### **Why PHPUnit?**
- ✅ Standard PHP testing framework
- ✅ WordPress officially supports PHPUnit
- ✅ Works with wp-phpunit for WordPress functions
- ✅ Can test WordPress core functions
- ✅ Can test REST API endpoints
- ✅ Generates coverage reports

---

## 🚀 STEP 4: HOW TO RUN BACKEND TESTS

### **Prerequisites:**

1. **Start Docker Desktop**
   - Open Docker Desktop application
   - Wait for it to fully start

2. **Start WordPress Containers**
   ```bash
   docker-compose up -d
   ```

3. **Verify Containers Running**
   ```bash
   docker-compose ps
   ```

### **Run Tests:**

#### **Step 1: Enter WordPress Docker Container**
```bash
docker exec -it wordpress-sqe bash
```

#### **Step 2: Navigate to Project Directory**
```bash
# Inside container, navigate to where project is mounted
cd /var/www/html

# Verify WordPress is available
ls -la wordpress-core  # Should show WordPress files if mounted
```

**Note:** The cloned WordPress from your local `wordpress/` directory is mounted in the container.

#### **Step 3: Install Dependencies (First Time Only)**
```bash
composer install
```

This installs:
- PHPUnit 9.5
- wp-phpunit 6.0 (WordPress test framework)

#### **Step 4: Run All Backend Tests**
```bash
./vendor/bin/phpunit
```

**Expected Output:**
```
PHPUnit 9.5.21 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.0.30
Configuration: /var/www/html/phpunit.xml

..........................................................  38 / 38 (100%)

Time: 00:04.123, Memory: 48.00 MB

OK (38 tests, 156 assertions)
```

#### **Step 5: Run Specific Test Suites**

**Unit Tests Only:**
```bash
./vendor/bin/phpunit --testsuite "Unit Tests"
```

**Integration Tests Only:**
```bash
./vendor/bin/phpunit --testsuite "Integration Tests"
```

**Single Test File:**
```bash
./vendor/bin/phpunit tests/unit/UserTest.php
```

**Single Test Method:**
```bash
./vendor/bin/phpunit --filter test_user_authentication_with_valid_credentials
```

---

## 📊 STEP 5: VERIFY TESTS ARE RUNNING

### **What You'll See:**

1. **Test Execution Output:**
   - Dots (.) for passing tests
   - F for failures
   - E for errors
   - S for skipped

2. **Summary:**
   ```
   OK (38 tests, 156 assertions)
   ```
   ✅ This means all tests passed!

3. **If Tests Fail:**
   ```
   FAILURES!
   Tests: 38, Assertions: 156, Failures: 2
   
   1) Tests\Unit\UserTest::test_user_authentication_with_valid_credentials
   Failed asserting that...
   ```
   ❌ Check the error messages to see what failed

### **Generate Coverage Report:**
```bash
./vendor/bin/phpunit --coverage-html coverage
```

Then view report:
```bash
# Exit container
exit

# Open coverage report (on Windows)
start coverage/index.html
```

---

## 📋 TEST EXECUTION OPTIONS

| Command | What It Does |
|---------|-------------|
| `./vendor/bin/phpunit` | Run all tests |
| `./vendor/bin/phpunit --testsuite "Unit Tests"` | Run only unit tests |
| `./vendor/bin/phpunit --testsuite "Integration Tests"` | Run only integration tests |
| `./vendor/bin/phpunit tests/unit/UserTest.php` | Run specific file |
| `./vendor/bin/phpunit --filter test_user_authentication` | Run specific test |
| `./vendor/bin/phpunit --verbose` | Show detailed output |
| `./vendor/bin/phpunit --coverage-html coverage` | Generate coverage report |

---

## 🔧 CONFIGURATION FILES

### **phpunit.xml**
- **Location:** Root directory
- **Purpose:** PHPUnit configuration
- **Contains:**
  - Test suites (Unit, Integration)
  - Bootstrap file path
  - Coverage settings
  - Database environment variables

### **tests/bootstrap.php**
- **Location:** `tests/bootstrap.php`
- **Purpose:** Load WordPress for testing
- **Function:** Initializes WordPress test environment

### **composer.json**
- **Location:** Root directory
- **Dependencies:**
  - `phpunit/phpunit: ^9.5`
  - `wp-phpunit/wp-phpunit: ^6.0`

---

## 📝 SUMMARY

### **✅ What We Have:**

1. ✅ **WordPress Cloned:** `wordpress-temp/` directory
2. ✅ **Test Cases Written:** 38 test methods in 5 files
3. ✅ **Test Location:** `tests/unit/` and `tests/integration/`
4. ✅ **Configuration:** `phpunit.xml` and `tests/bootstrap.php`
5. ✅ **Dependencies:** Configured in `composer.json`

### **🛠️ Testing Platform:**

- **Platform:** Docker Container (wordpress-sqe)
- **Tool:** PHPUnit 9.5
- **Framework:** wp-phpunit (WordPress integration)
- **Execution:** Inside Docker container via command line

### **📍 Test Cases Location:**

- **Unit Tests:** `tests/unit/` (3 files, 22 methods)
- **Integration Tests:** `tests/integration/` (2 files, 16 methods)
- **Total:** 5 files, 38 test methods

---

## 🎯 NEXT STEPS

1. **Start Docker Desktop** (if not running)
2. **Run:** `docker-compose up -d`
3. **Enter container:** `docker exec -it wordpress-sqe bash`
4. **Install dependencies:** `composer install`
5. **Run tests:** `./vendor/bin/phpunit`

**That's it! Your backend tests will run and show results!** 🚀

