<?php

namespace managers;

use models\User;
use PDO;

class UsersManager
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function create(array $data): void
    {
        $req = $this->db->prepare('INSERT INTO users (name, password) VALUES (:name, :password)');
        $req->bindValue(':name', htmlspecialchars($data['name']));
        $req->bindValue(':password', htmlspecialchars($data['password']));
        $req->execute();
    }

    public function readByName(string $name): User
    {
        $req = $this->db->prepare('SELECT * FROM users WHERE name = :name');
        $req->bindValue(':name', $name);
        $req->execute();
        $data = $req->fetch();
        return new User($data);
    }
}