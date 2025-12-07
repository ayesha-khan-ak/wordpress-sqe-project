# Test Files Location - Clear Answer

## 1. WHERE IS CLONED WORDPRESS?

**Location:** 
```
C:\Users\Ayesha\Desktop\SQE Project\wordpress\
```

**Full Path:**
```
C:\Users\Ayesha\Desktop\SQE Project\wordpress
```

**Status:** ✅ WordPress has been cloned successfully!

This directory contains WordPress core files cloned from GitHub.

**Test Configuration:**
- All test files are updated to use this cloned WordPress
- `tests/bootstrap.php` loads WordPress from this directory
- `phpunit.xml` is configured to reference this WordPress path

---

## 2. WHERE ARE THE TEST CASES?

### **BACKEND TESTS (PHPUnit) - 5 Files:**

#### **Unit Tests (3 files):**
1. **File:** `tests/unit/UserTest.php`
   - **Full Path:** `C:\Users\Ayesha\Desktop\SQE Project\tests\unit\UserTest.php`
   - **Contains:** User authentication tests (8 test methods)

2. **File:** `tests/unit/PostTest.php`
   - **Full Path:** `C:\Users\Ayesha\Desktop\SQE Project\tests\unit\PostTest.php`
   - **Contains:** Post CRUD tests (8 test methods)

3. **File:** `tests/unit/DatabaseTest.php`
   - **Full Path:** `C:\Users\Ayesha\Desktop\SQE Project\tests\unit\DatabaseTest.php`
   - **Contains:** Database query tests (6 test methods)

#### **Integration Tests (2 files):**
4. **File:** `tests/integration/AuthenticationTest.php`
   - **Full Path:** `C:\Users\Ayesha\Desktop\SQE Project\tests\integration\AuthenticationTest.php`
   - **Contains:** Complete authentication flow tests (8 test methods)

5. **File:** `tests/integration/APITest.php`
   - **Full Path:** `C:\Users\Ayesha\Desktop\SQE Project\tests\integration\APITest.php`
   - **Contains:** REST API endpoint tests (8 test methods)

---

### **FRONTEND TESTS (Cypress) - 4 Files:**

1. **File:** `cypress/e2e/login.cy.js`
   - **Full Path:** `C:\Users\Ayesha\Desktop\SQE Project\cypress\e2e\login.cy.js`
   - **Contains:** Login/logout E2E tests (6 test cases)

2. **File:** `cypress/e2e/posts.cy.js`
   - **Full Path:** `C:\Users\Ayesha\Desktop\SQE Project\cypress\e2e\posts.cy.js`
   - **Contains:** Post management E2E tests (7 test cases)

3. **File:** `cypress/e2e/pages.cy.js`
   - **Full Path:** `C:\Users\Ayesha\Desktop\SQE Project\cypress\e2e\pages.cy.js`
   - **Contains:** Page management E2E tests (6 test cases)

4. **File:** `cypress/e2e/navigation.cy.js`
   - **Full Path:** `C:\Users\Ayesha\Desktop\SQE Project\cypress\e2e\navigation.cy.js`
   - **Contains:** Navigation and search E2E tests (7 test cases)

---

### **API TESTS - Already included in Backend Tests:**

The API tests are **NOT separate files**. They are included in:

**File:** `tests/integration/APITest.php`
- **Full Path:** `C:\Users\Ayesha\Desktop\SQE Project\tests\integration\APITest.php`
- **Contains:** All REST API endpoint tests (8 test methods)

---

## SUMMARY

### **1. Cloned WordPress Location:**
```
C:\Users\Ayesha\Desktop\SQE Project\wordpress\
```

### **2. Test Files Location:**

**Backend Tests (5 files):**
1. `tests/unit/UserTest.php`
2. `tests/unit/PostTest.php`
3. `tests/unit/DatabaseTest.php`
4. `tests/integration/AuthenticationTest.php`
5. `tests/integration/APITest.php` ← **This contains API tests too**

**Frontend Tests (4 files):**
1. `cypress/e2e/login.cy.js`
2. `cypress/e2e/posts.cy.js`
3. `cypress/e2e/pages.cy.js`
4. `cypress/e2e/navigation.cy.js`

**Total: 9 test files (5 backend + 4 frontend)**

---

## QUICK REFERENCE

```
Project Root: C:\Users\Ayesha\Desktop\SQE Project\

├── wordpress/                   ← CLONED WORDPRESS HERE
│
├── tests/                       ← BACKEND TESTS HERE
│   ├── unit/
│   │   ├── UserTest.php        ← Backend Test File 1
│   │   ├── PostTest.php        ← Backend Test File 2
│   │   └── DatabaseTest.php    ← Backend Test File 3
│   └── integration/
│       ├── AuthenticationTest.php  ← Backend Test File 4
│       └── APITest.php         ← Backend Test File 5 (API tests here)
│
└── cypress/
    └── e2e/                     ← FRONTEND TESTS HERE
        ├── login.cy.js         ← Frontend Test File 1
        ├── posts.cy.js         ← Frontend Test File 2
        ├── pages.cy.js         ← Frontend Test File 3
        └── navigation.cy.js    ← Frontend Test File 4
```

---

**That's it! Clear and simple!** ✅

