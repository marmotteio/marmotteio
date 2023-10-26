![Marmotte](https://raw.githubusercontent.com/marmotteio/marmotteio/main/public/readme.png)

Marmotte is an open-source IT asset management system built with Laravel, Filament, PHP, and MySQL. It's designed to help you keep track of all your IT resources in your business environment.

## Features

Marmotte offers the following features:

- **Asset Tracking:** Keep an inventory of all your IT assets and track their status in real time.
- **User-Friendly Interface:** Navigate through the system with an intuitive and user-friendly interface, powered by Filament.
- **Reports and Analytics:** Generate detailed reports about your IT assets for better decision-making.
- **Secure:** Security is a top priority. Marmotte is designed with robust security measures to protect your data.

## Tech Stack

Marmotte is built with the following technologies:

- [Laravel 10](https://laravel.com): A robust framework for web artisans.
- [Filament 3](https://filamentadmin.com): A powerful admin panel for Laravel.
- [PHP 8.2](https://www.php.net): A popular general-purpose scripting language that is especially suited to web development.
- [MySQL](https://www.mysql.com): The world's most popular open-source relational database.
- [Redis](https://redis.io): An open-source, in-memory data structure store, used as a database, cache, and message broker.
- [Meilisearch](https://www.meilisearch.com): An open-source, instant, and relevant search engine.

Additional PHP packages used in Marmotte:

- [alperenersoy/filament-export](https://github.com/alperenersoy/filament-export): Allows exporting of resources in Filament.
- [flowframe/laravel-trend](https://github.com/flowframe/laravel-trend): Provides trendline functionality in Laravel.
- [guzzlehttp/guzzle](https://github.com/guzzle/guzzle): A PHP HTTP client and framework for building RESTful web service clients.
- [laravel/sanctum](https://laravel.com/docs/8.x/sanctum): Laravel Sanctum provides a featherweight authentication system for SPAs and simple APIs.
- [laravel/tinker](https://github.com/laravel/tinker): A REPL for Laravel.
- [league/flysystem-aws-s3-v3](https://github.com/thephpleague/flysystem-aws-s3-v3): An AWS S3 adapter for Flysystem.
- [leandrocfe/filament-apex-charts](https://github.com/LeandroCFe/filament-apex-charts): A Filament package that provides ApexChart integration.
- [livewire/livewire](https://github.com/livewire/livewire): A full-stack framework for Laravel that makes building dynamic interfaces simple, without leaving the comfort of Laravel.
- [predis/predis](https://github.com/nrk/predis): A flexible and feature-complete Redis client for PHP.
- [pxlrbt/filament-spotlight](https://github.com/pxlrbt/filament-spotlight): Adds a Spotlight feature to Filament.
- [rackbeat/laravel-ui-avatars](https://github.com/rackbeat/laravel-ui-avatars): Generate avatars on the fly in Laravel.
- [spatie/laravel-backup](https://github.com/spatie/laravel-backup): A package to backup your Laravel app.
- [spatie/laravel-discord-alerts](https://github.com/spatie/laravel-discord-alerts): Send alerts to Discord from a Laravel app.
- [stancl/tenancy](https://github.com/stancl/tenancy): Automatic multi-tenancy for your Laravel app.

Development dependencies include tools such as PHPUnit for testing, Laravel Sail for managing the Docker environment, and Faker for generating fake data.

Please refer to the `composer.json` file for the full list of dependencies.

## Installation

Marmotte utilizes Docker for easy setup and deployment via Laravel Sail, a light-weight command-line interface for interacting with Laravel's default Docker development environment. To get started, ensure you have Docker and Docker Compose installed on your system.

Before installing Marmotte, please make sure that no other web servers or databases are running on your local machine.

1. **Clone this repository to your local machine.**
    ```
    git clone https://github.com/marmotteio/marmotteio.git
    ```

2. **Navigate to the project directory.**
    ```
    cd marmotteio
    ```

3. **Start the Docker environment.**

    Laravel Sail provides a convenient method for starting and managing the Docker services defined by your application's `docker-compose.yml` file. You may start the Docker environment using the `sail up` command:

    ```
    ./vendor/bin/sail up
    ```

    The first time you run the Sail `up` command, Sail's Docker images will be built on your machine. This could take several minutes. Subsequent attempts to start Sail will be much faster.

    Sail publishes various services on standard ports on your system. For example, Laravel is accessible on port `80`. Therefore, you may access the project in your web browser at: `http://localhost`.

4. **Visit `localhost` in your browser to access Marmotte.**

   After the Docker containers are running, navigate to `http://localhost` in your web browser. You should see the Marmotte application running.

## Frequently Asked Questions

### General

**Q: Is Marmotte really free?**
A: Yes, Marmotte is an open-source project and is free to use. However, we also offer paid support and additional features for our paying customers.

**Q: What technologies does Marmotte use?**
A: Marmotte is built with Laravel, Filament, PHP, MySQL, Redis, and Meilisearch. You can find more details in the [Tech Stack](#tech-stack) section.

### Features and Support

**Q: I have a feature request. How can I suggest it?**
A: We welcome feature requests! You can suggest new features by opening an issue on our [GitHub repository](https://github.com/marmotteio/marmotteio/issues). Please ensure that the feature hasn't been requested already before creating a new issue.

**Q: I need help with Marmotte. Where can I ask questions?**
A: We have a few ways you can get help. Check out our [documentation](https://link-to-documentation), join our [Discord community](https://discord.gg/marmotteio), or open an issue on our GitHub repository. If you're a paying customer, you can contact us directly at `hello@marmotte.io`.

**Q: What kind of support do you provide for paying customers?**
A: Paying customers have direct access to our support team at `hello@marmotte.io`. They also have access to premium features not available in the free version.

### Bugs and Contributions

**Q: I found a bug. Where can I report it?**
A: You can report bugs by opening an issue on our [GitHub repository](https://github.com/marmotteio/marmotteio/issues). Please ensure that the bug hasn't been reported already before creating a new issue.

**Q: I want to contribute to Marmotte. How can I do that?**
A: We welcome all contributions! You can read our [CONTRIBUTING.md](CONTRIBUTING.md) file for details on our code of conduct and the process for submitting pull requests.

**Q: How can I stay updated about new releases and changes?**
A: You can keep track of updates by following our [GitHub repository](https://github.com/marmotteio/marmotteio). We also publish updates in our [Discord community](https://discord.gg/marmotteio).

## Troubleshooting

Experiencing issues with Marmotte? We're here to help!

Before reaching out to us, we recommend that you first check our [TROUBLESHOOTING.md](TROUBLESHOOTING.md) file. This document contains solutions to some common problems encountered by Marmotte users.

If your issue isn't covered in the troubleshooting guide, you can:

- Check if there's already an answer to your question in the [Frequently Asked Questions](#frequently-asked-questions) section.
- Search for your issue in our [GitHub repository's issues](https://github.com/marmotteio/marmotteio/issues) to see if it has been reported or solved already.
- Join our [Discord community](https://discord.gg/marmotteio) and ask for help.
- Contact us directly at `hello@marmotte.io` if you're a paying customer.

Remember, the more details you provide about your problem, the easier it will be for us to help you.

## Roadmap

We are constantly working to improve Marmotte and expand its capabilities. Here are some features we plan to implement in the future:

- Asset Lifecycle Management: Track the complete lifecycle of an asset from procurement to retirement.
- Integrations: Integrate with other systems to provide a seamless IT asset management experience.
- Enhanced Security: Implement advanced security features to further protect your data.

Detailed roadmap can be found in the `ROADMAP.md` file.

## Contributing

Contributions to Marmotte are always welcome! Whether it's improving documentation, reporting bugs, or writing code, we appreciate all forms of help.

Please read our `CONTRIBUTING.md` for details on our code of conduct, and the process for submitting pull requests.

## Security

Security is of the utmost importance to us and we take it very seriously. If you discover a security vulnerability within Marmotte, we encourage you to report it to us right away. We appreciate your efforts to responsibly disclose your findings.

Please **DO NOT** create a GitHub issue for a security vulnerability. Instead, send an email directly to our security team at `hello@marmotte.io`. This will help us to assess the issue quickly and respond as necessary to prevent any potential exploits.

Upon receiving a security vulnerability, we will:

- Confirm the receipt of your vulnerability report
- Assess the impact and severity of the issue
- Work towards patching the vulnerability promptly
- Notify all users about the issue and the recommended action they should take

To learn more about the process, please refer to our `SECURITY.md` file, where we outline our security policy and provide more details about how we handle security vulnerabilities.

We are committed to working with security researchers and the open-source community to make Marmotte secure for everyone. We thank you in advance for your contribution.

## Support

If you encounter any problems or have questions about Marmotte, we are here to help. Here are a few ways you can get support:

1. **Documentation:** We have extensive [documentation](https://link-to-documentation) that covers a wide range of topics about how to use Marmotte. It's often the fastest way to get the answers to your questions.

2. **Issue Tracker:** If you've found a bug or want to suggest a new feature, please use our [GitHub issue tracker](https://github.com/marmotteio/marmotteio/issues). Before submitting a new issue, please make sure to check if a similar issue hasn't been reported already.

3. **Discord Community:** We have a lively Discord community where you can ask questions, share your experiences, and connect with other Marmotte users. Join us on [Discord](https://discord.gg/marmotteio).

4. **Direct Support:** If you're a paying customer and need direct assistance or have a specific request, you can contact us at `hello@marmotte.io`. We aim to respond to all queries within 48 hours. Please note that this support channel is reserved for our paying customers.

When asking for help, remember to provide as much context as possible. The more details you provide, the easier it will be for us or the community to assist you.

Marmotte is an open-source project, and while we strive to provide the best support possible, please note that response times may vary.

## Authors

See the list of contributors who participated in this project. This includes people who have submitted pull requests or contributed in other ways. You can find a detailed breakdown in the [CONTRIBUTORS.md](CONTRIBUTORS.md) file.

## License

This project is licensed under the [GNU Affero General Public License v3.0 (AGPL-3.0)](https://www.gnu.org/licenses/agpl-3.0.en.html). This license permits you to use, modify, and distribute the project, but with the critical requirement that source code of any modifications or derivative works MUST BE PROVIDED to the recipients under the same license.

Importantly, if your version of this project is network-accessible, the AGPL stipulates that users who interact with it remotely via a computer network must be given access to its source code. This key requirement ensures that all users, even those who interact with the software over a network, can see the code and modify it for their own needs.

For full details on the rights, obligations, and limitations, please refer to the `LICENSE` file in this repository, or check the [official text](https://www.gnu.org/licenses/agpl-3.0.en.html) of the GNU AGPL v3.0.

## Acknowledgments

Thanks to all the contributors who have helped to build Marmotte, making IT asset management easier for everyone.

For more information on Marmotte, please visit our [website](https://marmotte.io).
