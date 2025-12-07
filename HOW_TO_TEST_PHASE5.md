# How to Test Phase 5 Locally

## Quick Test Commands

### Option 1: Run Tests Directly in Docker Container

Open a terminal and run:

```bash
docker exec -it wordpress-sqe bash
```

Then inside the container:

```bash
cd /var/www/html/project
./vendor/bin/phpunit --configuration phpunit.xml --testdox
```

### Option 2: Run Tests from PowerShell (One Command)

```powershell
docker exec -it wordpress-sqe bash -c "cd /var/www/html/project && ./vendor/bin/phpunit --configuration phpunit.xml --testdox"
```

### Option 3: Run Tests with Coverage (if Xdebug is enabled)

```powershell
docker exec -it wordpress-sqe bash -c "cd /var/www/html/project && mkdir -p build/coverage/html && ./vendor/bin/phpunit --configuration phpunit.xml --coverage-html build/coverage/html --testdox"
```

**Note:** Coverage requires Xdebug. If Xdebug is not enabled in your Docker container, tests will still run but coverage won't be generated.

## What to Expect

When tests run successfully, you should see:
- Test suite names (User, Post, Database, API, Authentication)
- Test method names with checkmarks (✔) or crosses (✘)
- Summary showing: Tests: X, Assertions: Y, Errors: Z, Skipped: W
- Time and memory usage

## If Tests Don't Run

1. **Check Docker container is running:**
   ```powershell
   docker ps
   ```

2. **Check PHPUnit is installed:**
   ```powershell
   docker exec wordpress-sqe bash -c "cd /var/www/html/project && ./vendor/bin/phpunit --version"
   ```

3. **Check WordPress is available:**
   ```powershell
   docker exec wordpress-sqe bash -c "cd /var/www/html/project && ls -la wordpress/wp-load.php"
   ```

4. **Check database connection:**
   ```powershell
   docker exec wordpress-sqe bash -c "cd /var/www/html/project && php -r 'echo \"DB_HOST: \" . getenv(\"WP_TESTS_DB_HOST\") . \"\n\";'"
   ```

## Testing the GitHub Actions Workflow

The workflow will run automatically when you push to GitHub. To test it:

1. **Commit your changes:**
   ```powershell
   git add .github/workflows/test.yml
   git commit -m "Add Phase 5: Test Stage workflow"
   git push origin main
   ```

2. **Check GitHub Actions:**
   - Go to your repository on GitHub
   - Click on "Actions" tab
   - You should see "CI/CD Pipeline - Test Stage" workflow running
   - Click on it to see the test execution

## Expected Test Results

Based on previous testing, you should see:
- **40 tests total**
- **39 passing**
- **1 skipped** (User authentication with nonexistent username - expected behavior)

## Coverage Reports

If coverage is generated:
- **Location in container:** `/var/www/html/project/build/coverage/html/`
- **To view:** Copy files from container to local machine, or access via Docker volume mount
- **Main file:** `index.html` - open in browser to view coverage

## Next Steps After Testing

Once you verify tests run successfully:
1. ✅ Tests work locally
2. ✅ Push to GitHub
3. ✅ Verify workflow runs in GitHub Actions
4. ✅ Check test reports are generated
5. ✅ Review coverage reports (if Xdebug enabled)

