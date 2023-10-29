# Troubleshooting Guide

This guide provides solutions for common issues that you may encounter when using Marmotte. If your issue isn't covered here, please check the [GitHub Issues](https://github.com/marmotteio/marmotteio/issues) or contact our [support team](mailto:hello@marmotte.io) if you're a paying customer.

## Table of Contents

- [Docker and Laravel Sail Issues](#docker-and-laravel-sail-issues)
- [Marmotte Startup Issues](#cube-startup-issues)
- [Database Connection Issues](#database-connection-issues)
- [Performance Issues](#performance-issues)
- [HTTP Errors](#http-errors)
- [Asset Management Issues](#asset-management-issues)

## Docker and Laravel Sail Issues

### Docker or Laravel Sail is not installed

If you're getting an error that Docker or Laravel Sail is not installed, you can download and install Docker from the [official Docker website](https://www.docker.com/products/docker-desktop). Laravel Sail is included with your Marmotte installation, so no additional installation is needed.

### Laravel Sail commands are not working

If Laravel Sail commands are not working:

1. Make sure Docker is running.
2. Check your Docker resources. Laravel Sail requires at least 2GB of RAM allocated to Docker.
3. Try prefixing your commands with `sail`, e.g., `./vendor/bin/sail up`.

## Marmotte Startup Issues

### Marmotte doesn't start after running `./vendor/bin/sail up`

If Marmotte doesn't start after running the `./vendor/bin/sail up` command, try the following steps:

1. Check the Docker logs for any error messages.
2. Make sure all Docker services are running properly.
3. Ensure that there are no conflicting services running on the same ports that Marmotte uses.

## Database Connection Issues

### Marmotte can't connect to the MySQL database

If Marmotte is unable to connect to the MySQL database:

1. Ensure that the MySQL service is running in Docker. You can check this with `./vendor/bin/sail docker ps`.
2. Check the database configuration in the `.env` file and make sure the credentials and database name are correct.
3. Ensure that the MySQL database is correctly initialized and populated with the necessary tables.

## Performance Issues

### Marmotte is running slowly

If Marmotte is running slowly, you might want to check the following:

1. Ensure your system has sufficient resources (CPU, RAM, Disk Space). Marmotte and its associated services (like MySQL and Redis) need enough resources to run efficiently.
2. Check the Docker logs for any error messages or warnings. These can often provide clues about performance issues.
3. If you're using Marmotte in a production environment, make sure you're using a production-ready configuration for your services (e.g., MySQL, Redis), and that they're appropriately optimized for your workload.

## HTTP Errors

### Encountering 4xx or 5xx error codes

If you're encountering 4xx or 5xx HTTP error codes:

1. Check the Laravel log files for any error messages.
2. Ensure that your `.env` file settings are correct.
3. Check your application's route configurations to ensure they're correct.

## Asset Management Issues

### Unable to add or update assets

If you're having issues with asset management:

1. Check the Laravel log files for any error messages.
2. Ensure that the MySQL database is correctly initialized and populated with the necessary tables.
3. Make sure you have the necessary permissions to add or update assets.

Remember, if you can't find a solution to your problem in this guide, feel free to ask for help in our [Discord community](https://discord.gg/marmotteio) or contact our [support team](mailto:hello@marmotte.io) if you're a paying customer.
