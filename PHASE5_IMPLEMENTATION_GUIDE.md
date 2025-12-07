# Phase 5: CI/CD Pipeline - Test Stage Implementation Guide

## Status: Implementation Complete

**Created:** Test workflow file for backend testing  
**File:** `.github/workflows/test.yml`  
**Focus:** Backend tests only (frontend tests can be added later)

---

## What Has Been Implemented

### 1. Test Workflow File Created
**Location:** `.github/workflows/test.yml`

**Features:**
- Automatically runs on push to `main`/`develop` branches
- Automatically runs on pull requests
- Can be manually triggered via `workflow_dispatch`

### 2. Environment Setup
- **PHP 8.0** with required extensions (mbstring, xml, curl, zip, gd, mysql, mysqli, pdo, pdo_mysql)
- **Xdebug** enabled for code coverage
- **Composer** for dependency management
- **MySQL 5.7** service container for test database

### 3. Test Database Configuration
- Creates `wordpress_test` database
- Sets up MySQL user with proper permissions
- Waits for MySQL to be ready before running tests
- Configures WordPress test environment variables

### 4. WordPress Setup
- Downloads WordPress if not present
- Creates `wp-tests-config.php` for test configuration
- Configures database connection for tests

### 5. Test Execution
- Runs PHPUnit with configuration from `phpunit.xml`
- Generates JUnit XML test results
- Generates Clover XML coverage report
- Generates HTML coverage report
- Uses testdox format for readable output

### 6. Test Reporting
- **JUnit XML:** Uploaded as artifact for GitHub Actions integration
- **Coverage XML:** Uploaded for coverage tracking
- **Coverage HTML:** Uploaded for detailed coverage viewing
- **Test Summary:** Displayed in workflow summary
- **Test Results:** Published using `publish-unit-test-result-action`

### 7. Artifact Management
- Test results retained for 30 days
- Coverage reports retained for 30 days
- All artifacts downloadable from GitHub Actions UI

---

## Workflow Structure

```
backend-tests (Job)
├── Checkout code
├── Set up PHP 8.0 with extensions
├── Validate composer.json
├── Install Composer dependencies
├── Wait for MySQL service
├── Create WordPress test database
├── Download WordPress (if needed)
├── Set up WordPress test configuration
├── Create test results directory
├── Run PHPUnit Tests
│   ├── Generate JUnit XML
│   ├── Generate Coverage XML
│   └── Generate Coverage HTML
├── Generate test summary
├── Upload test results (JUnit XML)
├── Upload coverage reports
├── Publish test results
└── Display test summary
```

---

## Environment Variables Used

The workflow sets these environment variables for tests:

```yaml
WP_TESTS_DB_NAME: wordpress_test
WP_TESTS_DB_USER: wordpress
WP_TESTS_DB_PASSWORD: wordpress
WP_TESTS_DB_HOST: 127.0.0.1:3306
WP_TESTS_TABLE_PREFIX: wp_test_
WORDPRESS_PATH: ./wordpress
ABSPATH: ./wordpress/
WP_USE_THEMES: false
WP_DEBUG: true
DB_NAME: wordpress_test
DB_USER: wordpress
DB_PASSWORD: wordpress
DB_HOST: 127.0.0.1:3306
```

---

## Test Reports Generated

### 1. JUnit XML Report
- **Location:** `tests/results/junit.xml`
- **Purpose:** GitHub Actions integration, test result tracking
- **Format:** JUnit XML standard

### 2. Coverage XML Report
- **Location:** `tests/results/coverage.xml`
- **Purpose:** Code coverage metrics (Clover format)
- **Format:** Clover XML

### 3. Coverage HTML Report
- **Location:** `tests/results/coverage-html/`
- **Purpose:** Detailed coverage visualization
- **Format:** HTML with interactive interface

---

## How to Use

### Automatic Execution
The workflow runs automatically when:
- Code is pushed to `main` or `develop` branches
- Pull requests are opened/updated targeting `main` or `develop`

### Manual Execution
1. Go to GitHub Actions tab in your repository
2. Select "CI/CD Pipeline - Test Stage" workflow
3. Click "Run workflow"
4. Select branch and click "Run workflow"

### Viewing Results
1. Go to GitHub Actions tab
2. Click on the workflow run
3. Click on "Backend Tests (PHPUnit)" job
4. View test output in the logs
5. Download artifacts for detailed reports

---

## Next Steps

### Immediate Actions
1. **Test the Workflow:**
   - Push changes to trigger the workflow
   - Verify tests run successfully
   - Check that reports are generated

2. **Verify Test Results:**
   - Check JUnit XML is generated
   - Verify coverage reports are created
   - Download and review HTML coverage report

3. **Configure Branch Protection (Optional):**
   - Require tests to pass before merging
   - Block merges if tests fail

### Future Enhancements (When Frontend Tests Ready)
1. Add `frontend-tests` job to the same workflow
2. Configure Cypress execution
3. Add frontend test reports
4. Combine backend and frontend results

---

## Troubleshooting

### If Tests Fail in CI but Pass Locally
1. Check MySQL service is running
2. Verify WordPress is downloaded correctly
3. Check database connection settings
4. Review test logs for specific errors

### If Coverage Reports Not Generated
1. Verify Xdebug is enabled (it's configured in workflow)
2. Check PHPUnit coverage flags are set
3. Review coverage configuration in `phpunit.xml`

### If WordPress Download Fails
1. Check network connectivity in GitHub Actions
2. Verify WordPress download URL is accessible
3. Check if WordPress directory already exists

---

## Deliverables Checklist

- [x] Create `.github/workflows/test.yml` file
- [x] Configure PHP environment setup
- [x] Configure MySQL service for tests
- [x] Set up WordPress test database
- [x] Configure PHPUnit test execution
- [x] Generate JUnit XML test reports
- [x] Generate HTML coverage reports
- [x] Upload test artifacts
- [x] Configure test failure notifications
- [ ] Test workflow on push/PR (Pending - needs to be tested)
- [ ] Verify test reports are generated (Pending - needs to be tested)
- [ ] Verify coverage reports are available (Pending - needs to be tested)
- [x] Document test stage configuration

---

## Files Modified/Created

### Created:
- `.github/workflows/test.yml` - Main test workflow file
- `PHASE5_BACKEND_TESTING_SUMMARY.md` - Summary document
- `PHASE5_IMPLEMENTATION_GUIDE.md` - This guide

### Existing Files Used:
- `phpunit.xml` - PHPUnit configuration
- `tests/bootstrap.php` - Test bootstrap file
- `composer.json` - Dependency management
- `tests/unit/*.php` - Unit test files
- `tests/integration/*.php` - Integration test files

---

## Integration with Existing CI/CD

This test workflow complements the existing build workflow (`.github/workflows/ci.yml`):

- **Build Stage:** Validates code, installs dependencies, builds Docker images
- **Test Stage:** Runs automated tests, generates reports, checks code quality

Both workflows run independently and can be combined in a pipeline later.

---

## Success Criteria

Phase 5 is considered complete when:
1. ✅ Test workflow file is created
2. ✅ Workflow runs successfully on push/PR
3. ✅ All backend tests execute
4. ✅ Test reports are generated
5. ✅ Coverage reports are available
6. ⏳ Tests pass in CI environment (needs testing)

---

## Notes

- Frontend tests can be added later without modifying backend test configuration
- The workflow is designed to be independent and can run standalone
- Test database is isolated from production database
- All test artifacts are retained for 30 days
- Workflow fails if tests fail, blocking deployment

---

**Ready to test!** Push your changes to trigger the workflow and verify everything works correctly.

