# Microservice client

At the top of the file there should be a short introduction and/ or overview that explains **what** the library provides. This description should match descriptions added for package managers (Gemspec, package.json, etc.)

## Requirements

Provide information about the requirements, like PHP version or certain packages.

## Installation

Provide code examples and explanations of how to get the project:

`composer require vdhicts/microservice-client`

## Quick Usage

```php
$client = new \Vdhicts\MicroserviceClient\Client($apiKey);
$response = $client->get($endpoint, $parameters);
```

## Usage

Initialize the client:

```php
$client = new \Vdhicts\MicroserviceClient\Client();
```

Or initialize the client with the API key when the endpoint requires an API key:

```php
$client = new \Vdhicts\MicroserviceClient\Client($apiKey);
```

Perform the request and retrieve the `Response`:

```php
$response = $client->get($endpoint, $parameters);

// Determine if the request was succesful
$isSuccess = $response->isSuccess();
// Retrieve the error, empty string when no error is occurred
$error = $response->getError();
// When provided parameters are invalid, they are listed as [field => error]
$validationErrors = $response->getValidationErrors();
// The data from the endpoint, or null when the request was invalid
$data = $response->getData();
```

## Contribution

Any contribution is welcome, but it should meet the PSR-2 standard and please create one pull request per feature. In 
exchange you will be credited as contributor on this page.

## Security

If you discover any security related issues in this or other packages of Vdhicts, please email info@vdhicts.nl instead
of using the issue tracker.

## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

## About vdhicts

Van der Heiden ICT services is the name of my personal company for which I work as freelancer. Van der Heiden ICT 
services develops and implements IT solutions for businesses and educational institutions.