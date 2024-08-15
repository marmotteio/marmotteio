# Marmotte: Open-Source IT Asset Management System

![Marmotte](https://raw.githubusercontent.com/marmotteio/marmotteio/main/public/readme.png)

Marmotte is a powerful, open-source IT asset management system built with Laravel and PHP. Designed to help businesses of all sizes efficiently track and manage their IT resources, Marmotte offers a user-friendly interface, robust features, and seamless integration capabilities.

## Table of Contents

- [Quick Deploy](#quick-deploy)
- [Introduction](#introduction)
- [Key Features](#key-features)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
    - [Running Marmotte with Docker](#running-marmotte-with-docker)
    - [Running Marmotte with Docker Compose](#running-marmotte-with-docker-compose)
  - [Configuration](#configuration)
- [Usage](#usage)
- [Tech Stack](#tech-stack)
- [Database Compatibility](#database-compatibility)
- [API Documentation](#api-documentation)
- [Customization and Extensibility](#customization-and-extensibility)
- [Frequently Asked Questions](#frequently-asked-questions)
- [Troubleshooting](#troubleshooting)
- [Roadmap](#roadmap)
- [Contributing](#contributing)
- [Security](#security)
- [Support](#support)
- [Authors](#authors)
- [License](#license)
- [Acknowledgments](#acknowledgments)

## Quick Deploy

Get Marmotte up and running quickly with these one-click deploy options:

<a href="https://railway.app/template/r6as-H?referralCode=24E22L">
    <img src="https://railway.app/button.svg" width="149px" alt="Deploy on Railway" />
</a>
&nbsp;
<a href="https://cloud.digitalocean.com/apps/new?repo=https://github.com/marmotteio/marmotteio/tree/main">
    <img src="https://www.deploytodo.com/do-btn-blue.svg" width="200px" alt="Deploy to DO" />
</a>

## Introduction

In today's fast-paced business environment, managing IT assets efficiently is crucial for maintaining productivity, security, and cost-effectiveness. Marmotte provides a comprehensive solution for tracking, managing, and optimizing your organization's IT resources, from hardware to software licenses.

## Key Features

Marmotte offers a rich set of features to streamline your IT asset management:

- **Asset Tracking:** Maintain a detailed inventory of all IT assets, including hardware, software, and digital resources.
- **Real-time Status Monitoring:** Keep track of asset status, location, and utilization in real-time.
- **User-Friendly Interface:** Navigate through the system with an intuitive, responsive interface designed for ease of use.
- **Customizable Dashboard:** Get a quick overview of your IT asset landscape with customizable widgets and data visualizations.
- **Reports and Analytics:** Generate comprehensive reports and gain valuable insights to inform decision-making.
- **Asset Lifecycle Management:** Track assets from procurement to retirement, including maintenance schedules and depreciation.
- **User and Role Management:** Define user roles and permissions to ensure secure access to asset information.
- **Alerts and Notifications:** Set up custom alerts for maintenance, renewals, or other important events.
- **Audit Trail:** Maintain a detailed history of all asset-related activities for compliance and accountability.
- **API Integration:** Connect Marmotte with other systems in your IT ecosystem through our robust API.
- **Multi-language Support:** Use Marmotte in your preferred language with our built-in localization features.
- **Mobile-Friendly:** Access and manage your IT assets on-the-go with our responsive mobile interface.

## Getting Started

### Prerequisites

Before installing Marmotte, ensure you have the following:

- PHP 8.3 or higher
- Composer
- Node.js and NPM
- A supported database system (MySQL, PostgreSQL, or MariaDB)
- Web server (Apache, Nginx, etc.)

For Docker-based installations, you'll need:

- Docker
- Docker Compose (for multi-container setups)

### Installation

#### Running Marmotte with Docker

Docker provides a quick and consistent way to deploy Marmotte. Here's how to get started using MariaDB:

1. First, create a Docker network for Marmotte and MariaDB to communicate:

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

3. Now, run the Marmotte container:

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

4. Once the containers are running, access Marmotte at `http://localhost:8000`.
5. Log in with the default credentials:
   - Email: `admin@marmotte.io`
   - Password: `marmotte.io`

For more advanced Docker usage, including viewing logs and managing containers, refer to our [Docker Guide](docs/docker-guide.md).

#### Running Marmotte with Docker Compose

For multi-container setups, Docker Compose offers a more flexible deployment option:

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

For more detailed instructions and troubleshooting, see our [Docker Compose Guide](docs/docker-compose-guide.md).

### Configuration

After installation, you may want to configure Marmotte to suit your needs:

1. Environment Settings: Edit the `.env` file to configure your database connection, mail settings, and other environment-specific options.
2. User Authentication: Set up your preferred authentication method (local, LDAP, SSO, etc.) in the admin panel.
3. Customize Branding: Add your company logo and adjust color schemes in the settings.
4. Set Up Integrations: Configure connections to other tools and services your organization uses.

For detailed configuration options, refer to our [Configuration Guide](docs/configuration-guide.md).

## Usage

Once Marmotte is set up, you can start managing your IT assets:

1. Add Assets: Use the "Add Asset" feature to input details of your IT resources.
2. Assign Assets: Allocate assets to users or departments.
3. Track Maintenance: Schedule and log maintenance activities for your assets.
4. Generate Reports: Use the reporting feature to get insights into your asset utilization and status.
5. Set Up Alerts: Configure notifications for important events like license renewals or end-of-life dates.

For a comprehensive guide on using Marmotte, check out our [User Manual](docs/user-manual.md).

## Tech Stack

Marmotte is built on a robust and modern tech stack:

- **Backend:**
  - [Laravel 10](https://laravel.com): A powerful PHP framework for web artisans.
  - [PHP 8.3](https://www.php.net): The latest version of PHP for improved performance and features.

- **Frontend:**
  - [Livewire](https://laravel-livewire.com): For dynamic, reactive interfaces.
  - [Alpine.js](https://alpinejs.dev): A lightweight JavaScript framework for composing behavior directly in your markup.

- **Database:**
  - Support for MariaDB, MySQL, and PostgreSQL.

- **Caching:**
  - [Redis](https://redis.io): For high-performance caching and session management.

- **Search:**
  - [Meilisearch](https://www.meilisearch.com): A lightning-fast search engine that integrates seamlessly with Laravel.

For a complete list of dependencies and their versions, refer to our `composer.json` and `package.json` files.

## Database Compatibility

Marmotte supports multiple database systems to accommodate various deployment scenarios:

- **MariaDB:** A community-developed fork of MySQL, offering enhanced performance and features.
- **MySQL:** Perfect for most production environments, offering a balance of features and performance.
- **PostgreSQL:** Suitable for large-scale deployments or when advanced data types and query capabilities are needed.

To switch between database systems, update your `.env` file with the appropriate connection details.

## API Documentation

Marmotte provides a comprehensive API for integrating with other systems and automating asset management tasks. Our API documentation covers:

- Authentication
- Endpoints for CRUD operations on assets, users, and other entities
- Reporting endpoints
- Webhook configurations

Access our full API documentation [here](docs/api-documentation.md).

## Customization and Extensibility

Marmotte is designed to be highly customizable and extensible:

- **Custom Fields:** Add custom fields to assets to track information specific to your organization.
- **Plugins:** Extend Marmotte's functionality with our plugin system. [Learn more about developing plugins](docs/plugin-development-guide.md).
- **Theming:** Customize the look and feel of Marmotte with our theming system. [Theming Guide](docs/theming-guide.md).
- **Localization:** Contribute translations to make Marmotte available in more languages. [Translation Guide](docs/translation-guide.md).

## Frequently Asked Questions

### General

**Q: Is Marmotte really free?**
A: Yes, Marmotte is an open-source project and is free to use. However, we also offer paid support and additional features for our paying customers.

**Q: What technologies does Marmotte use?**
A: Marmotte is built with Laravel, PHP, Redis, and Meilisearch. You can find more details in the [Tech Stack](#tech-stack) section.

### Features and Support

**Q: I have a feature request. How can I suggest it?**
A: We welcome feature requests! You can suggest new features by opening an issue on our [GitHub repository](https://github.com/marmotteio/marmotteio/issues). Please ensure that the feature hasn't been requested already before creating a new issue.

**Q: I need help with Marmotte. Where can I ask questions?**
A: We have a few ways you can get help. Check out our [documentation](https://docs.marmotte.io), join our [Discord community](https://discord.gg/CmfnnkUx), or open an issue on our GitHub repository. If you're a paying customer, you can contact us directly at `hello@marmotte.io`.

**Q: What kind of support do you provide for paying customers?**
A: Paying customers have direct access to our support team at `hello@marmotte.io`. They also have access to premium features not available in the free version.

### Bugs and Contributions

**Q: I found a bug. Where can I report it?**
A: You can report bugs by opening an issue on our [GitHub repository](https://github.com/marmotteio/marmotteio/issues). Please ensure that the bug hasn't been reported already before creating a new issue.

**Q: I want to contribute to Marmotte. How can I do that?**
A: We welcome all contributions! You can read our [CONTRIBUTING.md](CONTRIBUTING.md) file for details on our code of conduct and the process for submitting pull requests.

**Q: How can I stay updated about new releases and changes?**
A: You can keep track of updates by following our [GitHub repository](https://github.com/marmotteio/marmotteio). We also publish updates in our [Discord community](https://discord.gg/CmfnnkUx).

## Troubleshooting

If you're experiencing issues with Marmotte, please check our [TROUBLESHOOTING.md](TROUBLESHOOTING.md) file for solutions to common problems. If your issue isn't covered there, you can:

- Search for your issue in our [GitHub repository's issues](https://github.com/marmotteio/marmotteio/issues).
- Join our [Discord community](https://discord.gg/CmfnnkUx) for community support.
- Contact us directly at `hello@marmotte.io` if you're a paying customer.

## Roadmap

We are constantly working to improve Marmotte and expand its capabilities. Here are some features we plan to implement in the future:

- Enhanced Asset Lifecycle Management
- Advanced Reporting and Analytics
- Integration with popular cloud services
- Mobile app for on-the-go asset management

For a detailed roadmap, please refer to our [ROADMAP.md](ROADMAP.md) file.

## Contributing

We welcome contributions to Marmotte! Whether it's improving documentation, reporting bugs, or writing code, we appreciate all forms of help. Please read our [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct and the process for submitting pull requests.

## Security

We take security seriously. If you discover a security vulnerability within Marmotte, please send an email to `hello@marmotte.io`. All security vulnerabilities will be promptly addressed. Please refer to our [SECURITY.md](SECURITY.md) file for more details on our security policy.

## Support

For support options, please see the [Support](#support) section above. Remember, the more details you provide about your problem, the easier it will be for us to help you.

## Authors

Marmotte is maintained by a dedicated team of developers. See the list of contributors in our [CONTRIBUTORS.md](CONTRIBUTORS.md) file.

## License

Marmotte is open-source software licensed under the [GNU Affero General Public License v3.0 (AGPL-3.0)](https://www.gnu.org/licenses/agpl-3.0.en.html). This license permits you to use, modify, and distribute the project, but with the critical requirement that source code of any modifications or derivative works MUST BE PROVIDED to the recipients under the same license.

Key points of the AGPL-3.0 license:

- You can use Marmotte for any purpose, including commercial use.
- You can modify Marmotte to suit your needs.
- If you distribute Marmotte or any derivative works, you must do so under the AGPL-3.0 license.
- If you run a modified version of Marmotte on a server and allow users to interact with it over a network, you must make the source code of your modified version available to those users.

For full details, please refer to the [LICENSE](LICENSE) file in this repository or the [official text of the GNU AGPL v3.0](https://www.gnu.org/licenses/agpl-3.0.en.html).

## Acknowledgments

We would like to express our gratitude to:

- All contributors who have helped build and improve Marmotte
- The Laravel community for providing an excellent framework
- Our users for their valuable feedback and support

Special thanks to the following open-source projects that Marmotte relies on:

- [Laravel](https://laravel.com)
- [Livewire](https://laravel-livewire.com)
- [Alpine.js](https://alpinejs.dev)
- [MariaDB](https://mariadb.org)
- [Redis](https://redis.io)
- [Meilisearch](https://www.meilisearch.com)

## Community and Resources

Join our vibrant community to get the most out of Marmotte:

- **Documentation:** Comprehensive guides and API references are available at [docs.marmotte.io](https://docs.marmotte.io)
- **Discord Community:** Join our [Discord server](https://discord.gg/CmfnnkUx) for real-time discussions, support, and networking with other Marmotte users.
- **Blog:** Stay updated with the latest features, best practices, and community highlights on our [blog](https://blog.marmotte.io).
- **Twitter:** Follow us [@MarmotteIO](https://twitter.com/MarmotteIO) for announcements and tips.
- **YouTube:** Check out our [YouTube channel](https://youtube.com/MarmotteIO) for tutorials and feature demonstrations.

## Sponsors

Marmotte is supported by these amazing companies:

[Sponsor logos and links would go here]

Interested in sponsoring Marmotte? Check out our [sponsorship page](https://marmotte.io/sponsor) for more information.

## Changelog

For a detailed changelog of Marmotte releases, please refer to our [CHANGELOG.md](CHANGELOG.md) file.

## Upgrading

When upgrading to a new version of Marmotte, please refer to our [UPGRADING.md](UPGRADING.md) file for version-specific instructions and potential breaking changes.

## Benchmarks

For performance benchmarks and comparisons with other IT asset management solutions, see our [benchmarks page](https://marmotte.io/benchmarks).

## Code of Conduct

We are committed to fostering an open and welcoming environment in the Marmotte community. Please read our [Code of Conduct](CODE_OF_CONDUCT.md) to understand the behavior we expect from all community members.

## Final Notes

Thank you for choosing Marmotte for your IT asset management needs. We're excited to see how you use it and look forward to your contributions to make it even better!

For more information on Marmotte, please visit our [website](https://marmotte.io).

---

© 2024 Marmotte Team. All Rights Reserved.