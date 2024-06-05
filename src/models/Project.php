<?php

namespace models;

class Project
{
    private int $id;
    private string $name;
    private string $gh_url;
    private string $icon_url;
    private string $description;

    private string $user_name;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->gh_url = $data['gh_url'];
        $this->icon_url = $data['icon_url'];
        $this->description = $data['description'];
        $this->user_name = $data['user_name'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getGhUrl(): string
    {
        return $this->gh_url;
    }

    public function getIconUrl(): string
    {
        return $this->icon_url;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUserName(): string
    {
        return $this->user_name;
    }
}