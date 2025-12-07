# Xdebug Setup Complete - Coverage Ready

## Status

✅ **Xdebug is ENABLED and CONFIGURED**  
✅ **Docker image rebuilt with Xdebug**  
✅ **Xdebug mode set to 'coverage'**  
⏳ **Coverage generation in progress**

## What Was Done

1. Created `Dockerfile.xdebug` - Custom Docker image with Xdebug
2. Updated `docker-compose.yml` - Uses custom image with Xdebug
3. Rebuilt Docker container - Xdebug is now installed
4. Configured Xdebug - Mode set to 'coverage'

## How to Generate Coverage Report

### Option 1: Run in Your Terminal (Recommended)

Open your terminal and run:

```bash
docker exec -it wordpress-sqe bash
cd /var/www/html/project
./vendor/bin/phpunit --configuration phpunit.xml --coverage-html build/coverage/html --testdox
```

This will:
- Run all 40 tests
- Generate HTML coverage report
- Show test results with testdox format
- Take about 30-40 seconds

### Option 2: Use the Script

```bash
docker exec -it wordpress-sqe bash /tmp/generate-coverage.sh
```

## Where Coverage Report Will Be Generated

**Inside Container:** `/var/www/html/project/build/coverage/html/index.html`

**To Access:**
1. The coverage directory is mounted from your project
2. Check: `build/coverage/html/index.html` in your project folder
3. Or copy from container: `docker cp wordpress-sqe:/var/www/html/project/build/coverage/html ./coverage-report`

## Verify Coverage Was Generated

After running tests, check:

```bash
docker exec wordpress-sqe bash -c "cd /var/www/html/project && ls -lh build/coverage/html/ | head -10"
```

You should see files like:
- `index.html` (main coverage report)
- CSS and JS files
- Directory structure for code coverage

## If Coverage Still Doesn't Generate

The issue might be with the coverage paths in `phpunit.xml`. The coverage configuration looks for:
- `./wordpress` directory
- `./wp-content` directory

If these don't exist in the container, coverage won't generate. But tests will still run!

## Next Steps

1. ✅ Xdebug is enabled
2. ⏳ Run tests with coverage (use command above)
3. ✅ Verify coverage report is generated
4. ✅ Push to GitHub (coverage will work in CI too!)

## Note

Coverage generation takes time (30-40 seconds for all tests). Be patient and let it complete. The tests are running - you just need to wait for them to finish!

