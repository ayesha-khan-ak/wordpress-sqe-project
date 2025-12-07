# Next Steps - Phase 5 Completion

## Current Status

✅ **Phase 5 Test Stage Setup Complete:**
- Test workflow file created (`.github/workflows/test.yml`)
- Xdebug enabled in Docker container
- Custom functions created for coverage
- Tests created for custom functions
- Coverage configuration updated

## Immediate Next Steps

### Step 1: Generate Coverage Report Locally ⏳

**Purpose:** Verify coverage shows real percentages (not 0%)

**Command:**
```bash
docker exec -it wordpress-sqe bash -c "cd /var/www/html/project && ./vendor/bin/phpunit --configuration phpunit.xml --coverage-html build/coverage/html --testdox"
```

**What to check:**
- Tests complete successfully (45 tests total)
- Coverage report generated at `build/coverage/html/index.html`
- Coverage percentage is > 0% (should see 80-100% for custom functions)
- Open `build/coverage/html/index.html` in browser to verify

**Expected time:** 30-60 seconds

---

### Step 2: Verify Test Results ✅

**Check:**
- All 45 tests pass (40 original + 5 new custom function tests)
- 1 test may be skipped (User deletion - expected)
- Coverage report shows actual percentages

**If coverage still shows 0%:**
- Check that custom functions file exists: `wp-content/mu-plugins/sqe-custom-functions.php`
- Verify tests run: `./vendor/bin/phpunit tests/unit/CustomFunctionsTest.php --testdox`
- Check Xdebug is enabled: `php -m | grep xdebug`

---

### Step 3: Commit All Changes 📝

**Files to commit:**
```bash
git add .github/workflows/test.yml
git add phpunit.xml
git add wp-content/mu-plugins/sqe-custom-functions.php
git add tests/unit/CustomFunctionsTest.php
git add WORDPRESS_PROJECT_ROADMAP.md
git add Dockerfile.xdebug
git add docker-compose.yml
git add *.md
```

**Commit message:**
```bash
git commit -m "Phase 5: Complete CI/CD Test Stage with coverage reporting

- Add GitHub Actions test workflow
- Enable Xdebug for coverage reports
- Create custom functions for testable code coverage
- Add tests for custom functions
- Update coverage configuration
- Update project roadmap"
```

---

### Step 4: Push to GitHub 🚀

**Command:**
```bash
git push origin main
```

**What happens:**
- GitHub Actions workflow will trigger automatically
- Tests will run in CI environment
- Coverage reports will be generated
- Artifacts will be uploaded

---

### Step 5: Verify GitHub Actions Workflow ✅

**Steps:**
1. Go to your GitHub repository
2. Click on "Actions" tab
3. Find "CI/CD Pipeline - Test Stage" workflow
4. Click on the latest run
5. Check "Backend Tests (PHPUnit)" job

**What to verify:**
- ✅ Workflow runs successfully
- ✅ All tests pass
- ✅ Coverage reports generated
- ✅ Artifacts uploaded (test-results-junit, test-coverage-reports)

**Time to check:** 2-3 minutes after push

---

### Step 6: Download and Review Coverage Reports 📊

**From GitHub Actions:**
1. Go to workflow run
2. Scroll to "Artifacts" section
3. Download "test-coverage-reports"
4. Extract and open `coverage-html/index.html`
5. Verify coverage percentages

**What you should see:**
- Overall coverage > 0%
- Custom functions: 80-100% coverage
- WordPress core files: Various percentages
- Line-by-line coverage details

---

## After Phase 5 is Complete

### Phase 6: Staging & Deployment Setup
- Set up staging environment
- Configure automated deployment
- Set up database migrations

**Note:** Phase 6 is assigned to Member 3, but you can prepare for it.

---

## Troubleshooting

### If Coverage Still Shows 0%:
1. Verify custom functions are loaded:
   ```bash
   docker exec wordpress-sqe bash -c "ls -la /var/www/html/wp-content/mu-plugins/"
   ```
2. Run custom function tests only:
   ```bash
   docker exec wordpress-sqe bash -c "cd /var/www/html/project && ./vendor/bin/phpunit tests/unit/CustomFunctionsTest.php --coverage-text"
   ```
3. Check Xdebug is working:
   ```bash
   docker exec wordpress-sqe php -r "echo extension_loaded('xdebug') ? 'Xdebug OK' : 'Xdebug NOT loaded';"
   ```

### If GitHub Actions Fails:
1. Check workflow logs for errors
2. Verify MySQL service is running
3. Check WordPress download step
4. Review test output for specific failures

---

## Quick Command Reference

```bash
# Generate coverage locally
docker exec -it wordpress-sqe bash -c "cd /var/www/html/project && ./vendor/bin/phpunit --configuration phpunit.xml --coverage-html build/coverage/html --testdox"

# Run all tests
docker exec -it wordpress-sqe bash -c "cd /var/www/html/project && ./vendor/bin/phpunit --configuration phpunit.xml --testdox"

# Check coverage report
docker exec wordpress-sqe bash -c "cd /var/www/html/project && ls -lh build/coverage/html/ | head -10"

# Commit and push
git add .
git commit -m "Phase 5: Complete CI/CD Test Stage"
git push origin main
```

---

## Success Criteria

Phase 5 is complete when:
- ✅ All tests pass locally
- ✅ Coverage report shows > 0% coverage
- ✅ Changes committed to Git
- ✅ Pushed to GitHub
- ✅ GitHub Actions workflow runs successfully
- ✅ Coverage reports available in GitHub Actions artifacts

---

**Ready to proceed? Start with Step 1: Generate coverage report locally!**

