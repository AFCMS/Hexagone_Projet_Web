<?php

namespace managers;

use models\ProjectReview;
use PDO;

class ProjectsReviewManager
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function create(array $data): void
    {
        $req = $this->db->prepare('INSERT INTO projects_reviews (project_id, user_name, note, text) VALUES (:project_id, :user_name, :note, :text)');
        $req->bindValue(':project_id', htmlspecialchars($data['project_id']));
        $req->bindValue(':user_name', htmlspecialchars($data['user_name']));
        $req->bindValue(':note', $data['note'], PDO::PARAM_INT);
        $req->bindValue(':text', htmlspecialchars($data['text']));
        $req->execute();
    }

    public function get(int $id): ProjectReview
    {
        $req = $this->db->prepare('SELECT * FROM projects_reviews WHERE id = :id');
        $req->bindValue(':id', $id);
        $req->execute();

        $data = $req->fetch();
        return new ProjectReview($data);
    }

    /**
     * @return ProjectReview[]
     */
    public function getForProject(int $projectId): array
    {
        $req = $this->db->prepare('SELECT * FROM projects_reviews WHERE project_id = :project_id');
        $req->bindValue(':project_id', $projectId);
        $req->execute();

        $data = $req->fetchAll();
        return array_map(fn($d) => new ProjectReview($d), $data);
    }

    public function getAvgForProject(int $projectId): float|null
    {
        $req = $this->db->prepare('SELECT AVG(note) FROM projects_reviews WHERE project_id = :project_id');
        $req->bindValue(':project_id', $projectId);
        $req->execute();

        return $req->fetchColumn();
    }

    public function update(array $data): void
    {
        $req = $this->db->prepare('UPDATE projects_reviews SET note = :note, text = :text WHERE id = :id');
        $req->bindValue(':id', $data['id']);
        $req->bindValue(':note', $data['note'], PDO::PARAM_INT);
        $req->bindValue(':text', htmlspecialchars($data['text']));
        $req->execute();
    }

    public function delete(int $id): void
    {
        $req = $this->db->prepare('DELETE FROM projects_reviews WHERE id = :id');
        $req->bindValue(':id', $id);
        $req->execute();
    }

    public function list(): array
    {
        $req = $this->db->prepare('SELECT * FROM projects_reviews');
        $req->execute();
        return $req->fetchAll();
    }

    public function hasReviewed(string $user_name, int $id): bool
    {
        return $this->getUserReview($user_name, $id) !== false;
    }

    public function getUserReview(string $user_name, int $id): ProjectReview|false
    {
        $req = $this->db->prepare('SELECT * FROM projects_reviews WHERE user_name = :user_name AND project_id = :id');
        $req->bindValue(':user_name', $user_name);
        $req->bindValue(':id', $id);
        $req->execute();
        $data = $req->fetch();
        return $data ? new ProjectReview($data) : false;
    }
}