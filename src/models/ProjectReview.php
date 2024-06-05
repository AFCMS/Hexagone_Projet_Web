<?php

namespace models;

class ProjectReview
{
    private int $id;
    private int $project_id;
    private string $user_name;
    private int $note;
    private string $text;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->project_id = $data['project_id'];
        $this->user_name = $data['user_name'];
        $this->note = $data['note'];
        $this->text = $data['text'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getProjectId(): int
    {
        return $this->project_id;
    }

    public function getUserName(): string
    {
        return $this->user_name;
    }

    public function getNote(): int
    {
        return $this->note;
    }

    public function getText(): string
    {
        return $this->text;
    }
}