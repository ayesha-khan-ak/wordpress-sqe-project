# WordPress CI/CD Project - Structure Documentation

## Project Overview
This document outlines the project structure, setup, and WordPress architecture understanding for Phase 1 deliverables.

**Date Created:** November 25, 2025  
**Phase:** Phase 1 - Project Setup & Application Selection  
**Assigned to:** Member 1

---

## 1. Repository Structure

```
SQE Project/
├── .git/                          # Git repository (initialized)
├── .gitignore                     # Git ignore rules for WordPress
├── docker-compose.yml            # Docker Compose configuration
├── README.md                      # Project README
├── WORDPRESS_PROJECT_ROADMAP.md  # Project roadmap and phases
├── PROJECT_STRUCTURE.md          # This file
├── composer.json                  # PHP dependencies
├── package.json                   # Node.js dependencies
├── docs/                          # Documentation directory (to be created)
│   └── test-plan.md              # Test plan document (Phase 2)
├── tests/                         # Test directory (to be created)
│   ├── unit/                     # PHPUnit unit tests
│   ├── integration/              # Integration tests
│   └── bootstrap.php
├── cypress/                       # Cypress E2E tests (to be created)
│   ├── e2e/
│   ├── fixtures/
│   └── support/
└── .github/                       # GitHub Actions workflows (to be created)
    └── workflows/
```

---

## 2. Git Repository Setup

### Branch Structure
- **main**: Production-ready code
- **develop**: Development branch for integration
- **feature/***: Feature branches (to be created as needed)

### Git Configuration
- Repository initialized: ✅
- Branch structure: ✅
- .gitignore configured: ✅

### Next Steps
- Connect to GitHub/GitLab remote repository
- Set up branch protection rules
- Configure webhooks for CI/CD

---

## 3. Docker Environment Setup

### Docker Compose Configuration
The project uses Docker Compose with the following services:

1. **WordPress Container** (`wordpress-sqe`)
   - Image: `wordpress:latest`
   - Port: `8080:80`
   - Environment: WordPress with debug mode enabled
   - Volumes: WordPress data and wp-content

2. **MySQL Database** (`wordpress-db`)
   - Image: `mysql:8.0`
   - Database: `wordpress`
   - User: `wordpress`
   - Password: `wordpress`

3. **phpMyAdmin** (`wordpress-phpmyadmin`)
   - Image: `phpmyadmin:latest`
   - Port: `8081:80`
   - Access to WordPress database

### Access URLs
- **WordPress**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081

### Docker Installation Status
⚠️ **Note**: Docker Desktop needs to be installed and running to use the docker-compose.yml file.

**Installation Instructions:**
1. Download Docker Desktop from: https://www.docker.com/products/docker-desktop
2. Install and start Docker Desktop
3. Verify installation: `docker --version`
4. Start WordPress: `docker-compose up -d`

---

## 4. WordPress Structure Understanding

### Core Components

#### 1. **WordPress Core Files**
- Located in `/var/www/html/` (Docker container)
- Core functionality: User management, posts, pages, media, etc.
- Hooks and filters system for extensibility

#### 2. **WordPress Hooks & Filters**
- **Actions (Hooks)**: `do_action()`, `add_action()`
- **Filters**: `apply_filters()`, `add_filter()`
- Used for extending WordPress functionality

#### 3. **REST API Endpoints**
WordPress provides REST API endpoints for programmatic access:
- `/wp-json/wp/v2/posts` - Posts management
- `/wp-json/wp/v2/users` - User management
- `/wp-json/wp/v2/pages` - Pages management
- `/wp-json/wp/v2/comments` - Comments management
- `/wp-json/wp/v2/media` - Media management

#### 4. **Database Structure**
- **wp_users**: User accounts
- **wp_posts**: Posts and pages
- **wp_comments**: Comments
- **wp_options**: Site settings
- **wp_terms**, **wp_term_taxonomy**: Categories and tags

---

## 5. Key Features to Test (Identified for Phase 2)

### Backend Features (White-box Testing)
1. **User Authentication**
   - Login/logout functions
   - Password hashing and verification
   - User session management

2. **Post/Page CRUD Operations**
   - Create, Read, Update, Delete operations
   - Post status management (draft, publish, private)
   - Post metadata handling

3. **Database Queries**
   - WP_Query class
   - Database abstraction layer
   - Query optimization

4. **REST API Endpoints**
   - Endpoint authentication
   - Data validation
   - Response formatting

5. **WordPress Hooks and Filters**
   - Action hook execution
   - Filter application
   - Hook priority system

### Frontend Features (Black-box Testing)
1. **User Interface**
   - Login/logout pages
   - Admin dashboard
   - Post editor
   - Media library

2. **User Interactions**
   - User registration
   - Post creation/editing/deletion
   - Comment submission
   - Search functionality
   - Navigation

3. **Non-Functional**
   - Page load performance
   - Security (XSS, SQL injection)
   - Accessibility (WCAG compliance)

---

## 6. Technology Stack

### Development Tools
- **PHP**: 7.4+ or 8.0+
- **MySQL**: 8.0
- **Docker**: Containerization
- **Composer**: PHP dependency management
- **Node.js/npm**: Frontend tooling

### Testing Tools (To be set up in Phase 4)
- **PHPUnit**: Backend unit testing
- **Cypress**: Frontend E2E testing
- **WordPress Testing Framework**: wp-phpunit

### CI/CD Tools (To be set up in Phase 3)
- **GitHub Actions**: CI/CD pipeline
- **Docker Hub/GitHub Container Registry**: Artifact storage

---

## 7. Phase 1 Deliverables Status

- [x] WordPress selected ✅
- [x] Git repository initialized ✅
- [x] Branch structure created ✅
- [x] .gitignore configured ✅
- [x] Docker Compose file created ✅
- [ ] Docker Desktop installed and verified ⏳
- [ ] WordPress running locally ⏳
- [x] Project structure documented ✅
- [ ] WordPress structure studied ⏳
- [ ] GitHub/GitLab remote connected ⏳

---

## 8. Next Steps

1. **Install Docker Desktop** (if not already installed)
2. **Start WordPress environment**: `docker-compose up -d`
3. **Access WordPress**: Navigate to http://localhost:8080
4. **Complete WordPress installation** through web interface
5. **Study WordPress core structure** in detail
6. **Connect to remote Git repository** (GitHub/GitLab)
7. **Begin Phase 2**: Test Plan Development

---

## Notes

- All sensitive files (wp-config.php, .env) are excluded via .gitignore
- Docker volumes ensure data persistence
- WordPress debug mode is enabled for development
- Project follows WordPress coding standards

---

**Last Updated:** November 25, 2025  
**Status:** Phase 1 - In Progress

