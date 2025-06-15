<?php

namespace EasyHttp\SymfonyAdapter;

use EasyHttp\Contracts\AbstractClient;
use EasyHttp\Contracts\Contracts\HttpClientAdapter;
use EasyHttp\Contracts\Contracts\HttpClientRequest;
use EasyHttp\SymfonyAdapter\Factories\ClientFactory;

class SymfonyClient extends AbstractClient
{
    protected function buildRequest(string $method, string $uri): HttpClientRequest
    {
        return new SymfonyRequest($method, $uri);
    }

    protected function buildAdapter(): HttpClientAdapter
    {
        return new SymfonyAdapter(ClientFactory::build($this->handler));
    }
}
