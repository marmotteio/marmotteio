# Enterprise-Grade Open-Source IT Asset Management

![Marmotte](https://raw.githubusercontent.com/marmotteio/marmotteio/main/public/readme.png)

Marmotte is a powerful, feature-rich, open-source IT asset management system built with Laravel and PHP. Designed to help businesses of all sizes efficiently track, manage, and optimize their IT resources, Marmotte offers a user-friendly interface, robust features, and seamless integration capabilities.

[![GitHub license](https://img.shields.io/github/license/marmotteio/marmotteio.svg)](https://github.com/marmotteio/marmotteio/blob/main/LICENSE)
[![GitHub release](https://img.shields.io/github/release/marmotteio/marmotteio.svg)](https://github.com/marmotteio/marmotteio/releases/)
[![GitHub stars](https://img.shields.io/github/stars/marmotteio/marmotteio.svg)](https://github.com/marmotteio/marmotteio/stargazers)
[![GitHub issues](https://img.shields.io/github/issues/marmotteio/marmotteio.svg)](https://github.com/marmotteio/marmotteio/issues/)
[![Build Status](https://travis-ci.org/marmotteio/marmotteio.svg?branch=main)](https://travis-ci.org/marmotteio/marmotteio)

## Table of Contents

- [Quick Deploy](#quick-deploy)
- [Introduction](#introduction)
  - [Why Choose Marmotte?](#why-choose-marmotte)
  - [Use Cases](#use-cases)
- [Key Features](#key-features)
  - [Asset Tracking](#asset-tracking)
  - [Real-time Monitoring](#real-time-monitoring)
  - [User Interface](#user-interface)
  - [Reporting and Analytics](#reporting-and-analytics)
  - [Lifecycle Management](#lifecycle-management)
  - [User and Access Management](#user-and-access-management)
  - [Alerts and Notifications](#alerts-and-notifications)
  - [Compliance and Auditing](#compliance-and-auditing)
  - [Integration Capabilities](#integration-capabilities)
  - [Localization](#localization)
  - [Mobile Access](#mobile-access)
  - [Software License Management](#software-license-management)
  - [Vendor Management](#vendor-management)
  - [Financial Management](#financial-management)
  - [Customization](#customization)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
    - [Traditional Installation](#traditional-installation)
    - [Running Marmotte with Docker](#running-marmotte-with-docker)
    - [Running Marmotte with Docker Compose](#running-marmotte-with-docker-compose)
  - [Configuration](#configuration)
    - [Environment Settings](#environment-settings)
    - [Database Setup](#database-setup)
    - [User Authentication](#user-authentication)
    - [Email Configuration](#email-configuration)
    - [Caching and Queue Management](#caching-and-queue-management)
    - [Asset Categories and Custom Fields](#asset-categories-and-custom-fields)
- [Usage Guide](#usage-guide)
  - [Adding Assets](#adding-assets)
  - [Asset Assignment](#asset-assignment)
  - [Maintenance Tracking](#maintenance-tracking)
  - [Reporting](#reporting)
  - [Alert Management](#alert-management)
  - [Software License Tracking](#software-license-tracking)
  - [Conducting Audits](#conducting-audits)
  - [Cost Analysis](#cost-analysis)
  - [Vendor Management](#vendor-management-1)
  - [Team Collaboration](#team-collaboration)
- [Advanced Features](#advanced-features)
  - [API Integration](#api-integration)
  - [Workflow Automation](#workflow-automation)
  - [Data Import/Export](#data-importexport)
  - [Multi-tenancy](#multi-tenancy)
- [Tech Stack](#tech-stack)
- [Database Compatibility](#database-compatibility)
- [API Documentation](#api-documentation)
- [Customization and Extensibility](#customization-and-extensibility)
  - [Plugin Development](#plugin-development)
  - [Theme Customization](#theme-customization)
  - [Localization Contributions](#localization-contributions)
- [Performance Optimization](#performance-optimization)
- [Security Measures](#security-measures)
- [Backup and Disaster Recovery](#backup-and-disaster-recovery)
- [Frequently Asked Questions](#frequently-asked-questions)
- [Troubleshooting](#troubleshooting)
- [Roadmap](#roadmap)
- [Contributing](#contributing)
  - [Code Contributions](#code-contributions)
  - [Documentation](#documentation)
  - [Bug Reports](#bug-reports)
  - [Feature Requests](#feature-requests)
- [Security](#security)
- [Support Options](#support-options)
  - [Community Support](#community-support)
  - [Professional Support](#professional-support)
- [Authors and Maintainers](#authors-and-maintainers)
- [License](#license)
- [Acknowledgments](#acknowledgments)
- [Community and Resources](#community-and-resources)
- [Sponsors](#sponsors)
- [Changelog](#changelog)
- [Upgrading](#upgrading)
- [Benchmarks](#benchmarks)
- [Code of Conduct](#code-of-conduct)
- [Related Projects](#related-projects)
- [Case Studies](#case-studies)
- [Final Notes](#final-notes)

## Quick Deploy

Get Marmotte up and running quickly with these one-click deploy options:

[![Deploy on Railway](https://railway.app/button.svg)](https://railway.app/template/r6as-H?referralCode=24E22L)
[![Deploy to DO](https://www.deploytodo.com/do-btn-blue.svg)](https://cloud.digitalocean.com/apps/new?repo=https://github.com/marmotteio/marmotteio/tree/main)

## Introduction

In today's rapidly evolving business landscape, efficient management of IT assets is crucial for maintaining productivity, ensuring security, and optimizing costs. Marmotte provides a comprehensive, scalable solution for tracking, managing, and optimizing your organization's IT resources, from hardware and software to digital licenses and cloud assets.

### Why Choose Marmotte?

Marmotte stands out from other IT asset management solutions due to its:

1. **Open-Source Nature**: Full transparency and customization potential, backed by a vibrant community.
2. **Modern Tech Stack**: Built on Laravel and Vue.js, ensuring high performance, scalability, and ease of development.
3. **User-Centric Design**: Intuitive interface that reduces the learning curve and improves productivity.
4. **Extensive API**: Seamless integration with existing systems and workflows.
5. **Scalability**: Suitable for small startups to large enterprises, with multi-tenancy support.
6. **Compliance Focus**: Built-in features to assist with regulatory compliance (e.g., GDPR, HIPAA).
7. **Cost-Effective**: No per-user licensing fees, with optional professional support available.
8. **Active Development**: Regular updates, security patches, and new features.
9. **Customization**: Extensible architecture allowing for tailored solutions.
10. **Community-Driven**: Benefit from contributions and innovations from a global developer community.

### Use Cases

Marmotte is versatile and can be applied in various scenarios:

- **Enterprise IT Departments**: Manage diverse IT assets across multiple locations.
- **Managed Service Providers (MSPs)**: Track client assets and streamline service delivery.
- **Educational Institutions**: Monitor lab equipment, student devices, and software licenses.
- **Healthcare Organizations**: Ensure compliance and track medical IT equipment.
- **Government Agencies**: Maintain transparency and accountability in IT asset management.
- **Startups and SMEs**: Cost-effective solution for growing IT infrastructure.

## Key Features

Marmotte offers a comprehensive set of features to streamline your IT asset management:

### Asset Tracking

- **Detailed Inventory Management**:
  - Track hardware, software, cloud resources, and digital assets.
  - Store comprehensive asset information including specifications, purchase details, and custom attributes.
  - Support for asset hierarchies and relationships (e.g., components within a system).

- **Barcode and QR Code Integration**:
  - Generate and print asset tags for physical tracking.
  - Mobile app support for scanning and quick asset lookups.

- **Automated Discovery**:
  - Network scanning to automatically detect and catalog new assets.
  - Integration with popular network management tools.

### Real-time Monitoring

- **Asset Status Tracking**:
  - Real-time updates on asset location, usage, and health.
  - Integration with monitoring tools for live performance data.

- **Threshold Alerts**:
  - Set custom thresholds for various metrics (e.g., disk space, license usage).
  - Receive instant notifications when thresholds are approached or exceeded.

- **Availability Monitoring**:
  - Track uptime and availability of critical assets.
  - Historical availability reporting for SLA management.

### User Interface

- **Intuitive Dashboard**:
  - Customizable widgets for at-a-glance information.
  - Role-based dashboards to show relevant information to different user types.

- **Responsive Design**:
  - Fully responsive interface accessible from desktop, tablet, and mobile devices.
  - Touch-optimized controls for ease of use on touchscreen devices.

- **Search and Filter**:
  - Powerful search functionality with support for complex queries.
  - Advanced filtering and sorting options for large asset databases.

### Reporting and Analytics

- **Customizable Reports**:
  - Generate detailed reports on asset utilization, costs, and performance.
  - Drag-and-drop report builder for custom report creation.

- **Data Visualization**:
  - Interactive charts and graphs for visual data representation.
  - Export capabilities in multiple formats (PDF, Excel, CSV).

- **Predictive Analytics**:
  - Trend analysis for capacity planning and budget forecasting.
  - Machine learning integration for anomaly detection and predictive maintenance.

### Lifecycle Management

- **Procurement to Retirement Tracking**:
  - Manage assets through their entire lifecycle.
  - Automated workflows for procurement, deployment, and retirement processes.

- **Maintenance Scheduling**:
  - Plan and track regular maintenance activities.
  - Integration with calendaring systems for reminders and scheduling.

- **Depreciation Tracking**:
  - Multiple depreciation methods supported.
  - Automated calculations and reporting for financial planning.

### User and Access Management

- **Role-Based Access Control (RBAC)**:
  - Define granular permissions based on user roles.
  - Support for custom roles and permission sets.

- **Single Sign-On (SSO) Integration**:
  - SAML and OAuth support for enterprise authentication systems.
  - Multi-factor authentication (MFA) options for enhanced security.

- **User Activity Logging**:
  - Detailed audit trails of user actions within the system.
  - Exportable logs for compliance and security analysis.

### Alerts and Notifications

- **Customizable Alert System**:
  - Set up alerts for various events (e.g., license expiration, low stock).
  - Multiple notification channels including email, SMS, and in-app notifications.

- **Escalation Procedures**:
  - Define alert escalation paths for critical issues.
  - Integration with incident management systems.

- **Scheduled Reports**:
  - Automate report generation and distribution on a set schedule.
  - Customize report recipients based on content and urgency.

### Compliance and Auditing

- **Audit Trail**:
  - Comprehensive logging of all asset-related activities.
  - Tamper-evident logs for regulatory compliance.

- **Compliance Reporting**:
  - Pre-built reports for common compliance standards (e.g., GDPR, HIPAA).
  - Custom report templates for organization-specific compliance needs.

- **Data Retention Policies**:
  - Configure data retention rules to comply with legal requirements.
  - Automated data archiving and deletion processes.

### Integration Capabilities

- **RESTful API**:
  - Comprehensive API for integration with other business systems.
  - Detailed API documentation with interactive testing capabilities.

- **Webhook Support**:
  - Configure webhooks to push real-time updates to external systems.
  - Customizable payload formats for seamless integration.

- **Pre-built Integrations**:
  - Out-of-the-box integrations with popular business tools (e.g., JIRA, Slack).
  - Integration marketplace for community-contributed connectors.

### Localization

- **Multi-language Support**:
  - Interface available in multiple languages.
  - Easy addition of new language packs.

- **Localized Reporting**:
  - Generate reports in the user's preferred language.
  - Support for locale-specific date, time, and number formats.

### Mobile Access

- **Mobile-Responsive Web Interface**:
  - Access full functionality from any mobile device.
  - Optimized layouts for smaller screens.

- **Native Mobile Apps**:
  - iOS and Android apps for on-the-go asset management.
  - Barcode scanning and offline capabilities.

### Software License Management

- **License Tracking**:
  - Monitor software installations and usage across the organization.
  - Track various license types (perpetual, subscription, concurrent use).

- **Compliance Checking**:
  - Automated checks for license compliance.
  - Alerts for over-deployment or upcoming renewals.

- **Cost Optimization**:
  - Identify unused or underutilized software licenses.
  - Recommendations for license consolidation or reallocation.

### Vendor Management

- **Vendor Database**:
  - Centralized repository for vendor information.
  - Link assets, contracts, and support information to specific vendors.

- **Contract Management**:
  - Store and manage vendor contracts and SLAs.
  - Automated reminders for contract renewals and expirations.

- **Vendor Performance Tracking**:
  - Log and analyze vendor performance metrics.
  - Generate vendor scorecards for performance reviews.

### Financial Management

- **Cost Tracking**:
  - Monitor all costs associated with asset ownership.
  - Break down costs by department, project, or cost center.

- **Budgeting Tools**:
  - Create and manage IT budgets within the system.
  - Compare actual spending against budgeted amounts.

- **TCO Calculation**:
  - Calculate and report on Total Cost of Ownership for assets.
  - Factor in direct and indirect costs for accurate TCO analysis.

### Customization

- **Custom Fields**:
  - Add organization-specific fields to any asset type.
  - Configure field types, validation rules, and display properties.

- **Workflow Customization**:
  - Design custom workflows for asset-related processes.
  - Visual workflow editor for ease of configuration.

- **Theming**:
  - Customize the look and feel of the interface.
  - White-labeling options for managed service providers.

## Getting Started

### Prerequisites

Before installing Marmotte, ensure you have the following:

- PHP 8.3 or higher
- Composer 2.0+
- Node.js 14+ and NPM
- A supported database system:
  - MySQL 8.0+
  - PostgreSQL 12+
  - MariaDB 10.5+
- Web server:
  - Apache 2.4+ with mod_rewrite enabled
  - Nginx 1.18+
- SSL certificate (strongly recommended for production environments)

For Docker-based installations:
- Docker 20.10+
- Docker Compose 1.29+ (for multi-container setups)

### Installation

#### Running Marmotte with Docker

1. Create a Docker network:
   ```bash
   docker network create marmotte-network
   ```

2. Run a MariaDB container:
   ```bash
   docker run -d \
     --name marmotte-db \
     --network marmotte-network \
     -e MYSQL_ROOT_PASSWORD=your_root_password \
     -e MYSQL_DATABASE=marmotte \
     -e MYSQL_USER=marmotte \
     -e MYSQL_PASSWORD=your_marmotte_password \
     -v marmotte-db-data:/var/lib/mysql \
     mariadb:latest
   ```

3. Run the Marmotte container:
   ```bash
   docker run -d \
     --name marmotteio \
     --network marmotte-network \
     -p 8000:8000 \
     -e APP_NAME=Marmotte.io \
     -e APP_ENV=production \
     -e APP_DEBUG=false \
     -e APP_URL=http://localhost:8000 \
     -e ASSET_URL=http://localhost:8000 \
     -e APP_KEY=base64:RVvW9+2jO9MpuTDyxmIO45Z9t7BY0VWxgDImBNmhFwA= \
     -e DB_CONNECTION=mysql \
     -e DB_HOST=marmotte-db \
     -e DB_PORT=3306 \
     -e DB_DATABASE=marmotte \
     -e DB_USERNAME=marmotte \
     -e DB_PASSWORD=your_marmotte_password \
     -v marmotteio:/app \
     marmotteio/marmotteio:latest
   ```

4. Access Marmotte at `http://localhost:8000`.
5. Log in with the default credentials:
   - Email: `admin@marmotte.io`
   - Password: `marmotte.io`

#### Running Marmotte with Docker Compose

1. Clone the Marmotte repository:
   ```bash
   git clone https://github.com/marmotteio/marmotteio.git
   cd marmotteio
   ```

2. Create a `docker-compose.yml` file with the following content:
   ```yaml
   version: '3'
   services:
     app:
       image: marmotteio/marmotteio:latest
       ports:
         - "8000:8000"
       environment:
         APP_NAME: Marmotte.io
         APP_ENV: production
         APP_DEBUG: 'false'
         APP_URL: http://localhost:8000
         ASSET_URL: http://localhost:8000
         APP_KEY: base64:RVvW9+2jO9MpuTDyxmIO45Z9t7BY0VWxgDImBNmhFwA=
         DB_CONNECTION: mysql
         DB_HOST: db
         DB_PORT: 3306
         DB_DATABASE: marmotte
         DB_USERNAME: marmotte
         DB_PASSWORD: your_marmotte_password
       volumes:
         - marmotteio:/app
       depends_on:
         - db

     db:
       image: mariadb:latest
       environment:
         MYSQL_ROOT_PASSWORD: your_root_password
         MYSQL_DATABASE: marmotte
         MYSQL_USER: marmotte
         MYSQL_PASSWORD: your_marmotte_password
       volumes:
         - marmotte-db-data:/var/lib/mysql

   volumes:
     marmotteio:
     marmotte-db-data:
   ```

3. Run Docker Compose:
   ```bash
   docker-compose up -d
   ```

4. Access Marmotte at `http://localhost:8000`.

### Configuration

After installation, configure Marmotte to suit your needs:

1. Environment Settings: Edit the `.env` file to configure database connection, mail settings, and other options.
2. User Authentication: Set up your preferred authentication method in the admin panel.
3. Customize Branding: Add your company logo and adjust color schemes in the settings.
4. Set Up Integrations: Configure connections to other tools and services your organization uses.
5. Define Asset Categories: Create custom asset categories and types that match your organization's structure.
6. Configure Notifications: Set up email and in-app notification preferences.
7. Set Up Reporting: Configure default reports and dashboards.

## Usage

Once Marmotte is set up, you can start managing your IT assets:

1. Add Assets: Use the "Add Asset" feature to input details of your IT resources.
2. Assign Assets: Allocate assets to users or departments.
3. Track Maintenance: Schedule and log maintenance activities for your assets.
4. Generate Reports: Use the reporting feature to get insights into your asset utilization and status.
5. Set Up Alerts: Configure notifications for important events like license renewals or end-of-life dates.
6. Manage Software Licenses: Track software installations and usage across your organization.
7. Conduct Audits: Perform regular audits of your IT assets.
8. Analyze Costs: Track asset-related expenses throughout their lifecycle.
9. Manage Vendors: Maintain a database of vendors and their associated assets.
10. Collaborate: Use built-in commenting and tagging features to facilitate team communication.

## Tech Stack

Marmotte is built on a robust and modern tech stack:

- **Backend:** Laravel 10, PHP 8.3, Filament
- **Frontend:** Livewire, Alpine.js, Tailwind CSS
- **Database:** MariaDB, MySQL, PostgreSQL
- **Caching:** Redis
- **Search:** Meilisearch
- **API:** Laravel Sanctum, Laravel OpenAPI
- **Authentication:** Laravel Socialite
- **Charting:** ApexCharts
- **QR Code Generation:** SimpleSoftwareIO QrCode
- **Multi-tenancy:** stancl/tenancy
- **Error Tracking:** Sentry

## Database Compatibility

Marmotte supports multiple database systems:

- MariaDB 10.5+
- MySQL 8.0+
- PostgreSQL 12+

## API Documentation

Marmotte provides a comprehensive API for integrating with other systems. Our API documentation covers authentication, CRUD operations, reporting endpoints, and webhook configurations.

## Customization and Extensibility

- **Custom Fields:** Add custom fields to assets to track organization-specific information.
- **Plugins:** Extend Marmotte's functionality with our plugin system.
- **Theming:** Customize the look and feel of Marmotte with our theming system.
- **Localization:** Contribute translations to make Marmotte available in more languages.

## Frequently Asked Questions

For a list of frequently asked questions, please refer to our [FAQ page](https://marmotte.io/faq).

## Troubleshooting

If you're experiencing issues, check our [TROUBLESHOOTING.md](TROUBLESHOOTING.md) file for solutions to common problems.

## Roadmap

For a detailed roadmap of future features and improvements, please refer to our [ROADMAP.md](ROADMAP.md) file.

## Contributing

We welcome contributions to Marmotte! Please read our [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct and the process for submitting pull requests.

## Security

If you discover a security vulnerability, please send an email to `hello@marmotte.io`. All security vulnerabilities will be promptly addressed.

## Support

For support options, please see the [Support](#support) section in our full documentation.

## Authors

Marmotte is maintained by a dedicated team of developers. See the list of contributors in our [CONTRIBUTORS.md](CONTRIBUTORS.md) file.

## License

Marmotte is open-source software licensed under the [GNU Affero General Public License v3.0 (AGPL-3.0)](https://www.gnu.org/licenses/agpl-3.0.en.html).

## Acknowledgments

We would like to express our gratitude to all contributors and open-source projects that Marmotte relies on.

## Community and Resources

- **Documentation:** [docs.marmotte.io](https://docs.marmotte.io)
- **Discord Community:** [Join our Discord](https://discord.gg/CmfnnkUx)
- **Blog:** [blog.marmotte.io](https://blog.marmotte.io)
- **Twitter:** [@MarmotteIO](https://twitter.com/MarmotteIO)
- **YouTube:** [Marmotte YouTube Channel](https://youtube.com/MarmotteIO)

## Sponsors

[Sponsor information would go here]

## Changelog

For a detailed changelog of Marmotte releases, please refer to our [CHANGELOG.md](CHANGELOG.md) file.

## Upgrading

When upgrading to a new version of Marmotte, please refer to our [UPGRADING.md](UPGRADING.md) file for version-specific instructions.

## Benchmarks

For performance benchmarks, see our [benchmarks page](https://marmotte.io/benchmarks).

## Code of Conduct

Please read our [Code of Conduct](CODE_OF_CONDUCT.md) to understand the behavior we expect from all community members.

## Final Notes

Thank you for choosing Marmotte for your IT asset management needs. We're excited to see how you use it and look forward to your contributions!

For more information, visit [marmotte.io](https://marmotte.io).

---

© 2024 Marmotte Team. All Rights Reserved.