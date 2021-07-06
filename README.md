# php-microframework

A super-minimal PHP microframework that provides basic routing, controller

## Development Status

The framework is currently in development and subject to frequent change. A stable version with
tagged release will be made available when ready.

## Installation

`composer require johnsquibb/php-microframework:dev-main`

## Setup

Point web server at public directory and modify the contents of [index.php](public/index.php) to add
additional controller search paths.

## Run

Use the builtin PHP server to serve from the public directory during development:

`php -S localhost:8080`

Then visit: http://localhost:8080 to view the demo.