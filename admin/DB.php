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
    private $dbName = "phpschema";

    private \PDO $connection;

    public function __construct(
        string $host = "",
        int $port = 3306,
        string $username = "",
        string $password = "",
        string $dbName = ""
    )
    {
        if(!empty($host)) {
            $this->host = $host;
        }

        if(!empty($port)) {
            $this->port = $port;
        }

        if(!empty($username)) {
            $this->username = $username;
        }

        if(!empty($password)) {
            $this->password = $password;
        }

        if(!empty($dbName)) {
            $this->dbName = $dbName;
        }

        try {
            $this->connection = new \PDO(
                "mysql:host=$this->host;dbname=$this->dbName;charset=utf8mb4",
                $this->username,
                $this->password
            );
            // set the PDO error mode to exception
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getArticles(): array
    {
        $sql = "SELECT * FROM articles";
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
    public function getARticleCategories(): array
    {
        $sql = "SELECT * FROM categories";
        $query = $this->connection->query($sql);
        $data = $query->fetchAll(\PDO::FETCH_ASSOC);

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

    public function getArticleById(int $id): array
    {
        $sql = "SELECT * FROM articles WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }
    public function logIn(string $username, string $password): ?int
    {
        // Získanie uloženého hashovaného hesla z databázy
        $sql = "SELECT id, password FROM users WHERE username = :username";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->execute();
        
        $userData = $stmt->fetch(\PDO::FETCH_ASSOC);
    
        if ($userData) {
            // Overenie hesla pomocou password_verify
            if (password_verify($password, $userData['password'])) {
                return $userData['id'];
            }
        }
    
        return null; // V prípade neúspešného prihlásenia
    }
    
    public function insertArticle(string $title, string $text, string $image_url, int $userId): bool
    {
        // Vložení textu článku do tabulky articles_content
        $sqlContent = "INSERT INTO articles_content (content,date) VALUES (:text,NOW())";
        $stmtContent = $this->connection->prepare($sqlContent);
        $stmtContent->bindParam(':text', $text, \PDO::PARAM_STR);
        $stmtContent->execute();
    
        // Získání ID vloženého obsahu
        $contentId = $this->connection->lastInsertId();
    
        // Vložení článku do tabulky articles s odkazem na articles_content_id
        $sqlArticle = "INSERT INTO articles (title, image_url, date, users_id, articles_content_id) VALUES (:title, :image_url, NOW(), :userId, :contentId)";
        $stmtArticle = $this->connection->prepare($sqlArticle);
        $stmtArticle->bindParam(':title', $title, \PDO::PARAM_STR);
        $stmtArticle->bindParam(':image_url', $image_url, \PDO::PARAM_STR);
        $stmtArticle->bindParam(':userId', $userId, \PDO::PARAM_INT);
        $stmtArticle->bindParam(':contentId', $contentId, \PDO::PARAM_INT);
    
        return $stmtArticle->execute();
    }
    
    
    public function makeAppointment(string $first_name,string $last_name, string $date,int $phone_number,string $message,int $departments_id): bool
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
    
    
    public function updateArticle(string $title,string $text, string $image_url,int $articleId): bool
    {
  $sql = "UPDATE articles 
        SET title = '" . $title . "', 
            text = '" . $text . "', 
            image_url = '" . $image_url . "', 
            date = now()
        WHERE id = " . $articleId . ";";


        $stmt = $this->connection->prepare($sql);
        return $stmt->execute();
    }

    public function deleteArticle(int $id): bool
    {
        $sql = "DELETE FROM articles WHERE id = ".$id;
        $stmt = $this->connection->prepare($sql);
      
        return $stmt->execute();
    }
    
    public function register(string $username, string $password): bool
    {  
        $options = [
            'cost' => 12, // Nastavenie náročnosti hashovania, môžete prispôsobiť podľa potreby
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

?>