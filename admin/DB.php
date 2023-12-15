<?php

namespace PO\Lib;

use DatePeriod;
use DateTime;

class DB
{
    private $host = "localhost";
    private $port = 3306;
    private $username = "root";
    private $password = "";
    private $dbName = "phpschemafinal";

    private \PDO $connection;

    public function __construct(
        string $host = "",
        int $port = 3306,
        string $username = "",
        string $password = "",
        string $dbName = ""
    ) {
        if (!empty($host)) {
            $this->host = $host;
        }

        if (!empty($port)) {
            $this->port = $port;
        }

        if (!empty($username)) {
            $this->username = $username;
        }

        if (!empty($password)) {
            $this->password = $password;
        }

        if (!empty($dbName)) {
            $this->dbName = $dbName;
        }

        try {
            $this->connection = new \PDO(
                "mysql:host=$this->host;dbname=$this->dbName;charset=utf8mb4",
                $this->username,
                $this->password
            );
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getArticles(): array
    {
        $sql = "SELECT articles.id, articles.title, articles.image_url, articles.date, articles.users_id, articles.articles_content_id, articles.categories_id, articles_content.content, categories.category_name,users.username FROM articles INNER JOIN articles_content ON articles.articles_content_id = articles_content.id INNER JOIN categories ON articles.categories_id = categories.id INNER JOIN users ON articles.users_id = users.id";
        $query = $this->connection->query($sql);
        $data = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }

    public function getDepartments(): array
    {
        $sql = "SELECT * FROM departments";
        $query = $this->connection->query($sql);
        $data = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }
    public function getArticleCategories(): array
    {
        $sql = "SELECT * FROM categories";
        $query = $this->connection->query($sql);
        $data = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }
    public function getArticleCategory(int $id): array
    {
        $sql = "SELECT * FROM categories  WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }
    public function getArticlesById(int $userId): array
    {
        $sql = "SELECT * FROM articles WHERE users_id = :userId";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }
    public function getArticlesByCategory(int $categoryId): array
    {
        $sql = "SELECT articles.id, articles.title, articles.image_url, articles.date, articles.users_id, articles.articles_content_id, articles.categories_id, articles_content.content, categories.category_name,users.username FROM articles INNER JOIN articles_content ON articles.articles_content_id = articles_content.id INNER JOIN categories ON articles.categories_id = categories.id INNER JOIN users ON articles.users_id = users.id WHERE categories_id = :categoryId";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':categoryId', $categoryId, \PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }

    public function getArticleById(int $id): array
    {
        $sql = "SELECT * FROM articles WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }

    public function getArticleWithContentById(int $id): array
    {
        $sql = "SELECT articles.id, articles.title, articles.image_url, articles.date, articles.users_id, articles.articles_content_id, articles.categories_id, articles_content.content, categories.category_name FROM articles INNER JOIN articles_content ON articles.articles_content_id = articles_content.id INNER JOIN categories ON articles.categories_id = categories.id WHERE articles.id = :id";


        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }
    public function getContentByArticleId(int $id): array
    {
        $sql = "SELECT * FROM articles_content WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $data ? [$data] : [];
    }

    public function logIn(string $username, string $password): ?int
    {

        $sql = "SELECT id, password FROM users WHERE username = :username";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->execute();

        $userData = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($userData) {

            if (password_verify($password, $userData['password'])) {
                return $userData['id'];
            }
        }

        return null; 
    }

    public function insertArticle(string $title, string $content, string $image_url, string $category, int $userId): bool
    {

        $sqlContent = "INSERT INTO articles_content (content) VALUES (:content)";
        $stmtContent = $this->connection->prepare($sqlContent);
        $stmtContent->bindParam(':content', $content, \PDO::PARAM_STR);
        $stmtContent->execute();

        $contentId = $this->connection->lastInsertId();

        $sqlArticle = "INSERT INTO articles (title, image_url, date, users_id, articles_content_id,categories_id) VALUES (:title, :image_url, NOW(), :userId, :contentId,:category)";
        $stmtArticle = $this->connection->prepare($sqlArticle);
        $stmtArticle->bindParam(':title', $title, \PDO::PARAM_STR);
        $stmtArticle->bindParam(':category', $category, \PDO::PARAM_STR);
        $stmtArticle->bindParam(':image_url', $image_url, \PDO::PARAM_STR);
        $stmtArticle->bindParam(':userId', $userId, \PDO::PARAM_INT);
        $stmtArticle->bindParam(':contentId', $contentId, \PDO::PARAM_INT);
        $stmtArticle->execute();


        return true; 
    }



    public function makeAppointment(string $first_name, string $last_name, string $date, int $phone_number, string $message, int $departments_id): bool
    {
        $sql = "INSERT INTO appointments(first_name, last_name,date,phone_number,message,departments_id) VALUE ('" . $first_name . "', '" . $last_name . "', '" . $date . "' ,'" . $phone_number . "','" . $message . "','" . $departments_id . "' )";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute();
    }

    public function getAuthor(int $id): array
    {
        $sql = "SELECT *
                FROM `users`
                WHERE id != :userID
                ORDER BY date DESC
                LIMIT 2;";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':userID', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }

    public function getLastTwoArticles(int $id): array
    {
        $sql = "SELECT id, title, image_url
                FROM `articles`
                WHERE id != :excludeId
                ORDER BY date DESC
                LIMIT 2;";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':excludeId', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }

    public function updateArticle(string $title, string $image_url, int $articleId): bool
    {
        $sql = "UPDATE articles 
        SET title = '" . $title . "', 
            image_url = '" . $image_url . "'
        WHERE id = " . $articleId . ";";


        $stmt = $this->connection->prepare($sql);
        return $stmt->execute();
    }


    public function updateContent(string $content, string $contentId): bool
    {

        $sql = "UPDATE articles_content 
           SET content = :content
           WHERE id = :contentId";

        $stmt = $this->connection->prepare($sql);

  
        $stmt->bindParam(':content', $content, \PDO::PARAM_STR);
        $stmt->bindParam(':contentId', $contentId, \PDO::PARAM_INT);

        return $stmt->execute();
    }

    


    public function getDoctors(): array
    {
        $sql = "SELECT doctors.id, doctors.first_name, doctors.second_name, doctors.phone_number, departments.name FROM `doctors` INNER JOIN departments ON departments.id = doctors.departments_id;";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
    


    public function updateCategory(string $articleId, string $category): bool
    {

        $sql = "UPDATE articles 
                SET categories_id = :category
                WHERE id = :articleId";

        $stmt = $this->connection->prepare($sql);


        $stmt->bindParam(':category', $category, \PDO::PARAM_STR);
        $stmt->bindParam(':articleId', $articleId, \PDO::PARAM_INT);

        return $stmt->execute();
    }




    public function deleteArticle(int $id): bool
    {
        $sql = "DELETE FROM articles WHERE id = " . $id;
        $stmt = $this->connection->prepare($sql);

        return $stmt->execute();
    }


    public function deleteContent(int $id): bool
    {
        $sql = "DELETE FROM articles_content WHERE id = " . $id;
        $stmt = $this->connection->prepare($sql);

        return $stmt->execute();
    }


    public function register(string $username, string $password): bool
    {
        $options = [
            'cost' => 12, 
        ];

        $existingUser = $this->getUserByUsername($username);

        if ($existingUser) {
            return false;
        }
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

        $sql = "INSERT INTO users(username, password) VALUE ('" . $username . "', '" . $hashedPassword . "')";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute();
    }

    private function getUserByUsername(string $username)
    {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }
}
