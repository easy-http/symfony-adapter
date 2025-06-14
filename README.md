<p align="center"><img src="https://blog.pleets.org/img/articles/easy-http-logo-320.png"></p>

<p align="center">
<a href="https://github.com/easy-http/symfony-adapter/actions/workflows/tests.yml"><img src="https://github.com/easy-http/symfony-adapter/actions/workflows/tests.yml/badge.svg?branch=2.x" alt="Build Status"></a>
<a href="https://sonarcloud.io/component_measures?metric=reliability_rating&branch=2.x&id=easy-http_symfony-adapter"><img src="https://sonarcloud.io/api/project_badges/measure?project=easy-http_symfony-adapter&metric=reliability_rating&branch=2.x" alt="Bugs"></a>
<a href="https://sonarcloud.io/component_measures?metric=coverage&branch=2.x&id=easy-http_symfony-adapter"><img src="https://sonarcloud.io/api/project_badges/measure?project=easy-http_symfony-adapter&metric=coverage&branch=2.x" alt="Bugs"></a>
</p>
<p align="center">
    <a href="#tada-php-support" title="PHP Versions Supported"><img alt="PHP Versions Supported" src="https://img.shields.io/badge/php-7.4%20to%208.3-777bb3.svg?logo=php&logoColor=white&labelColor=555555"></a>
</p>

<p align="center">
    :bookmark: Standardized HTTP client interface
</p>

<p align="center">
    :rocket: Seamlessly switch between HTTP clients using the adapter pattern
</p>

# Symfony HTTP Adapter

<a href="https://sonarcloud.io/component_measures?metric=security_rating&branch=2.x&id=easy-http_symfony-adapter"><img src="https://sonarcloud.io/api/project_badges/measure?project=easy-http_symfony-adapter&metric=security_rating&branch=2.x" alt="Bugs"></a>
<a href="https://sonarcloud.io/component_measures?metric=bugs&branch=2.x&id=easy-http_symfony-adapter"><img src="https://sonarcloud.io/api/project_badges/measure?project=easy-http_symfony-adapter&metric=bugs&branch=2.x" alt="Bugs"></a>
<a href="https://sonarcloud.io/component_measures?metric=code_smells&branch=2.x&id=easy-http_symfony-adapter"><img src="https://sonarcloud.io/api/project_badges/measure?project=easy-http_symfony-adapter&metric=code_smells&branch=2.x" alt="Bugs"></a>

This is an HTTP adapter for Symfony Client that implements the [HTTP client contracts](https://github.com/easy-http/layer-contracts).
These contracts standardize the way you consume HTTP clients like Guzzle, Symfony, and others by providing a consistent interface. The adapter pattern ensures that regardless of which HTTP client you're using,
the methods and behavior remain consistent across all implementations.

:books: Check out the [Documentation](https://easy-http.com/docs) to learn how to use any adapter that implements these contracts.

This adapter supports the following versions of Guzzle HTTP Client:Add commentMore actions

<a href="#tada-php-support" title="Guzzle Version Supported"><img alt="symfony Versions Supported" src="https://img.shields.io/badge/symfony-5.1-blue"></a>

# Installation

Use following command to install this library:

```bash
composer require easy-http/symfony-adapter
```

# Usage

## Simple requests

You can execute a simple request as follows.

```php
use EasyHttp\SymfonyAdapter\SymfonyClient;

$client = new SymfonyClient();
$response = $client->call('GET', 'https://api.ratesapi.io/api/2020-07-24/?base=USD');

$response->getStatusCode(); // 200
$response->parseJson();     // array
```

## Prepared requests

A prepared request is a more flexible way to generate a request. You can use the `setQuery` method
to specify request query.

```php
use EasyHttp\SymfonyAdapter\SymfonyClient;

$client = new SymfonyClient();

$client->prepareRequest('POST', 'https://api.ratesapi.io/api/2020-07-24/');
$client->getRequest()->setQuery(['base' => 'USD']);
$response = $client->execute();

$response->getStatusCode(); // 200
$response->parseJson();     // array
```

Also, you can use the `setJson` method to set a json string as the body.

```php
use EasyHttp\SymfonyAdapter\SymfonyClient;

$client = new SymfonyClient();

$client->prepareRequest('POST', 'https://jsonplaceholder.typicode.com/posts');
$client->getRequest()->setJson([
    'title' => 'foo',
    'body' => 'bar',
    'userId' => 1,
]);
$response = $client->execute();

$response->getStatusCode(); // 201
$response->parseJson();     // array
```

## HTTP Authentication

Actually this library supports basic authentication natively.

```php
use EasyHttp\SymfonyAdapter\SymfonyClient;

$client = new SymfonyClient();

$client->prepareRequest('POST', 'https://api.sandbox.paypal.com/v1/oauth2/token');
$user = 'AeA1QIZXiflr1_-r0U2UbWTziOWX1GRQer5jkUq4ZfWT5qwb6qQRPq7jDtv57TL4POEEezGLdutcxnkJ';
$pass = 'ECYYrrSHdKfk_Q0EdvzdGkzj58a66kKaUQ5dZAEv4HvvtDId2_DpSuYDB088BZxGuMji7G4OFUnPog6p';
$client->getRequest()->setBasicAuth($user, $pass);
$client->getRequest()->setQuery(['grant_type' => 'client_credentials']);
$response = $client->execute();

$response->getStatusCode(); // 200
$response->parseJson();     // array
```
