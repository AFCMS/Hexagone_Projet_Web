<?php

namespace managers;

use models\Project;
use PDO;

class ProjectsManager
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function create(array $data): void
    {
        $req = $this->db->prepare('INSERT INTO projects (name, gh_url, icon_url, description, user_name) VALUES (:name, :gh_url, :icon_url, :description, :user_name)');
        $req->bindValue(':name', htmlspecialchars($data['name']));
        $req->bindValue(':gh_url', htmlspecialchars($data['gh_url']));
        $req->bindValue(':icon_url', htmlspecialchars($data['icon_url']));
        $req->bindValue(':description', htmlspecialchars($data['description']));
        $req->bindValue(':user_name', htmlspecialchars($data['user_name']));
        $req->execute();
    }

    public function get(int $id): Project
    {
        $req = $this->db->prepare('SELECT * FROM projects WHERE id = :id');
        $req->bindValue(':id', $id);
        $req->execute();

        $data = $req->fetch();
        return new Project($data);
    }

    public function update(array $data): void
    {

        $req = $this->db->prepare('UPDATE projects SET description = :description WHERE id = :id');
        $req->bindValue(':id', $data['id']);
        $req->bindValue(':description', htmlspecialchars($data['description']));
        $req->execute();
    }

    public function delete(int $id): void
    {
        $req = $this->db->prepare('DELETE FROM projects WHERE id = :id');
        $req->bindValue(':id', $id);
        $req->execute();
    }

    public function list(): array
    {
        $req = $this->db->prepare('SELECT * FROM projects');
        $req->execute();
        return $req->fetchAll();
    }

    public function listFiltered(string $filter): array
    {
        $req = $this->db->prepare('SELECT * FROM projects WHERE LOWER(name) LIKE LOWER(:filter)');
        $req->bindValue(':filter', "%$filter%");
        $req->execute();
        return $req->fetchAll();
    }
}