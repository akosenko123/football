<?php declare(strict_types=1);

namespace Service;


class Request
{
    protected $method;
    protected $getData;
    protected $postData;

    public function __construct()
    {
        $this->method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
        $this->getData = $_GET;
        $this->postData = $_POST;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getQueryData(string $key): ?string
    {
        return $this->getData[$key] ?? null;
    }

    public function getPostData(string $key): ?string
    {
        return $this->postData[$key] ?? null;
    }
}