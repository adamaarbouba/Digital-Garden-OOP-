<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../Entity/Note.php';

class NoteRepository
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }


    public function create(Note $note)
    {
        $sql = "INSERT INTO notes (theme_id, title, importance, content)
                VALUES (:theme_id, :title, :importance, :content)";

        try {
            $stmt = $this->conn->prepare($sql);

            $success = $stmt->execute([
                ':theme_id'   => $note->getThemeId(),
                ':title'      => $note->getTitle(),
                ':importance' => $note->getImportance(),
                ':content'    => $note->getContent()
            ]);

            if ($success) {
                $noteId = $this->conn->lastInsertId();
                $note->setId($noteId);
                return $noteId;
            }

            return false;
        } catch (PDOException $e) {
            error_log("Error creating note: " . $e->getMessage());
            return false;
        }
    }


    public function findById(int $id): ?Note
    {
        $sql = "SELECT * FROM notes WHERE id = :id";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);

            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$data) {
                return null;
            }

            return new Note(
                $data['title'],
                $data['content'],
                $data['importance'],
                $data['theme_id'],
                $data['created_at'],
                $data['id']
            );
        } catch (PDOException $e) {
            error_log("Error finding note by ID: " . $e->getMessage());
            return null;
        }
    }


    public function findByTheme(int $themeId): array
    {
        $sql = "SELECT * FROM notes WHERE theme_id = :theme_id ORDER BY created_at DESC";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':theme_id' => $themeId]);

            $notes = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $notes[] = new Note(
                    $row['title'],
                    $row['content'],
                    $row['importance'],
                    $row['theme_id'],
                    $row['created_at'],
                    $row['id']
                );
            }

            return $notes;
        } catch (PDOException $e) {
            error_log("Error finding notes by theme: " . $e->getMessage());
            return [];
        }
    }


    public function findAll(): array
    {
        $sql = "SELECT * FROM notes ORDER BY created_at DESC";

        try {
            $stmt = $this->conn->query($sql);

            $notes = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $notes[] = new Note(
                    $row['title'],
                    $row['content'],
                    $row['importance'],
                    $row['theme_id'],
                    $row['created_at'],
                    $row['id']
                );
            }

            return $notes;
        } catch (PDOException $e) {
            error_log("Error finding all notes: " . $e->getMessage());
            return [];
        }
    }


    public function findByUser(int $userId): array
    {
        $sql = "SELECT n.* FROM notes n
                INNER JOIN themes t ON n.theme_id = t.id
                WHERE t.user_id = :user_id
                ORDER BY n.created_at DESC";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':user_id' => $userId]);

            $notes = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $notes[] = new Note(
                    $row['title'],
                    $row['content'],
                    $row['importance'],
                    $row['theme_id'],
                    $row['created_at'],
                    $row['id']
                );
            }

            return $notes;
        } catch (PDOException $e) {
            error_log("Error finding notes by user: " . $e->getMessage());
            return [];
        }
    }


    public function update(Note $note): bool
    {
        $sql = "UPDATE notes
                SET title = :title,
                    importance = :importance,
                    content = :content,
                    theme_id = :theme_id
                WHERE id = :id";

        try {
            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([
                ':id'         => $note->getId(),
                ':title'      => $note->getTitle(),
                ':importance' => $note->getImportance(),
                ':content'    => $note->getContent(),
                ':theme_id'   => $note->getThemeId()
            ]);
        } catch (PDOException $e) {
            error_log("Error updating note: " . $e->getMessage());
            return false;
        }
    }


    public function delete(int $id): bool
    {
        $sql = "DELETE FROM notes WHERE id = :id";

        try {
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            error_log("Error deleting note: " . $e->getMessage());
            return false;
        }
    }

    public function deleteByTheme(int $themeId): bool
    {
        $sql = "DELETE FROM notes WHERE theme_id = :theme_id";

        try {
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([':theme_id' => $themeId]);
        } catch (PDOException $e) {
            error_log("Error deleting notes by theme: " . $e->getMessage());
            return false;
        }
    }


    public function search(string $searchTerm, ?int $userId = null): array
    {
        if ($userId) {
            $sql = "SELECT n.* FROM notes n
                    INNER JOIN themes t ON n.theme_id = t.id
                    WHERE t.user_id = :user_id 
                    AND (n.title LIKE :search OR n.content LIKE :search)
                    ORDER BY n.created_at DESC";
        } else {
            $sql = "SELECT * FROM notes 
                    WHERE title LIKE :search OR content LIKE :search
                    ORDER BY created_at DESC";
        }

        try {
            $stmt = $this->conn->prepare($sql);
            $searchParam = '%' . $searchTerm . '%';

            if ($userId) {
                $stmt->execute([
                    ':user_id' => $userId,
                    ':search' => $searchParam
                ]);
            } else {
                $stmt->execute([':search' => $searchParam]);
            }

            $notes = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $notes[] = new Note(
                    $row['title'],
                    $row['content'],
                    $row['importance'],
                    $row['theme_id'],
                    $row['created_at'],
                    $row['id']
                );
            }

            return $notes;
        } catch (PDOException $e) {
            error_log("Error searching notes: " . $e->getMessage());
            return [];
        }
    }


    public function countByTheme(int $themeId): int
    {
        $sql = "SELECT COUNT(*) as count FROM notes WHERE theme_id = :theme_id";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':theme_id' => $themeId]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int) $result['count'];
        } catch (PDOException $e) {
            error_log("Error counting notes: " . $e->getMessage());
            return 0;
        }
    }
}
