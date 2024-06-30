<?php

namespace App\Application\Request;

class Request implements RequestInterface
{
    use RequestValidation;

    private array $post;
    private array $get;
    private array $files;
    private array $params;

    public function __construct(array $post, array $get, array $files, array $params)
    {
        $this->post = $post;
        $this->get = $get;
        $this->files = $files;
        $this->params = $params;
    }

    public function post(string $key): mixed
    {
        return $this->post[$key] ?? NULL;
    }
    public function get(string $key): mixed
    {
        return $this->get[$key] ?? NULL;
    }
    public function file(string $key): mixed
    {
        return $this->files[$key] ?? NULL;
    }

    public function validation(array $rules): array|bool
    {
        return $this->validate(
            $this->post,
            $rules,
        );
    }
}
