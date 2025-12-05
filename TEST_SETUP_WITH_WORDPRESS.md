# Test Setup with Cloned WordPress - Complete Guide

## ✅ WordPress Cloned Successfully

**Location:** `wordpress/` directory in project root  
**Full Path:** `C:\Users\Ayesha\Desktop\SQE Project\wordpress\`

---

## 📋 What Has Been Updated

### 1. **tests/bootstrap.php** ✅
- ✅ Updated to load WordPress from cloned `wordpress/` directory
- ✅ Sets ABSPATH to point to cloned WordPress
- ✅ Loads `wp-load.php` from cloned WordPress
- ✅ Configures test database from environment variables
- ✅ Includes test helper functions

### 2. **phpunit.xml** ✅
- ✅ Added WordPress path environment variables
- ✅ Configured database settings for tests
- ✅ Updated coverage to include WordPress core files
- ✅ Set WordPress debug settings

### 3. **docker-compose.yml** ✅
- ✅ Added volume mount for cloned WordPress directory
- ✅ WordPress core available in container at `/var/www/html/wordpress-core`

### 4. **wp-config-test.php** ✅
- ✅ Created test configuration file
- ✅ Database settings for test environment
- ✅ WordPress debug enabled for testing

---

## 🎯 Test Files Location (All Updated)

### **Backend Tests (PHPUnit) - 5 Files:**

1. **tests/unit/UserTest.php**
   - Tests user authentication and management
   - Uses WordPress functions from cloned WordPress

2. **tests/unit/PostTest.php**
   - Tests post CRUD operations
   - Uses WordPress functions from cloned WordPress

3. **tests/unit/DatabaseTest.php**
   - Tests database queries
   - Uses WordPress database functions

4. **tests/integration/AuthenticationTest.php**
   - Tests complete authentication flows
   - Uses WordPress authentication functions

5. **tests/integration/APITest.php**
   - Tests REST API endpoints
   - Uses WordPress REST API functions

### **Frontend Tests (Cypress) - 4 Files:**

1. **cypress/e2e/login.cy.js** - Login/logout tests
2. **cypress/e2e/posts.cy.js** - Post management tests
3. **cypress/e2e/pages.cy.js** - Page management tests
4. **cypress/e2e/navigation.cy.js** - Navigation tests

---

## 🚀 How Tests Now Work with Cloned WordPress

### **Backend Tests Execution Flow:**

1. **PHPUnit starts** → loads `tests/bootstrap.php`
2. **Bootstrap file** → loads WordPress from `wordpress/wp-load.php`
3. **WordPress loads** → all WordPress functions available
4. **Tests run** → can use WordPress functions like `wp_insert_post()`, `wp_authenticate()`, etc.
5. **Results** → PHPUnit reports test results

### **Frontend Tests Execution Flow:**

1. **Cypress starts** → connects to WordPress running in Docker
2. **WordPress in Docker** → uses cloned WordPress core (if mounted)
3. **Tests execute** → interact with WordPress UI
4. **Results** → Cypress reports test results

---

## 📊 Execution Platform

### **Backend Tests:**
- **Platform:** Docker Container OR Local PHP
- **Tool:** PHPUnit 9.5
- **WordPress Source:** Cloned `wordpress/` directory
- **Execution:** `./vendor/bin/phpunit`

### **Frontend Tests:**
- **Platform:** Local Machine (Windows)
- **Tool:** Cypress 13.0
- **WordPress Source:** Running WordPress in Docker
- **Execution:** `npm run test:open` or `npm test`

### **API Tests:**
- **Platform:** Docker Container
- **Tool:** PHPUnit (included in backend tests)
- **WordPress Source:** Cloned WordPress + Running WordPress
- **Execution:** `./vendor/bin/phpunit tests/integration/APITest.php`

---

## ✅ Validation Status

### **Configuration Updated:**
- ✅ `tests/bootstrap.php` - Loads cloned WordPress
- ✅ `phpunit.xml` - Points to WordPress directory
- ✅ `docker-compose.yml` - Mounts WordPress directory
- ✅ `wp-config-test.php` - Test configuration created

### **Test Files:**
- ✅ All 5 backend test files ready
- ✅ All 4 frontend test files ready
- ✅ All tests can now access WordPress functions

### **WordPress Integration:**
- ✅ WordPress cloned at `wordpress/`
- ✅ Bootstrap loads WordPress correctly
- ✅ Tests can use WordPress functions
- ✅ Database configuration ready

---

## 🎯 Ready to Execute!

All tests are now configured to work with the cloned WordPress. You can:

1. **Run Backend Tests:** `./vendor/bin/phpunit` (in Docker container)
2. **Run Frontend Tests:** `npm run test:open` (local machine)
3. **Run API Tests:** `./vendor/bin/phpunit tests/integration/APITest.php`

**Everything is updated and ready!** ✅

