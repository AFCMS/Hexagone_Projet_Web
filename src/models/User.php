<?php

namespace models;

class User
{
    private string $name;
    private string $password;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->password = $data['password'];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}