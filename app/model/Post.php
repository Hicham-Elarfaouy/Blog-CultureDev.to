<?php

class Post extends Connection
{
    private int $id;
    private string $title;
    private int $cat;
    private string $description;
    private string $date;
    private int $auteur;
    private string $image;

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setCat(int $cat): void
    {
        $this->cat = $cat;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function setAuteur(int $auteur): void
    {
        $this->auteur = $auteur;
    }

    function specific_post(): bool|array
    {
        try {
            $sql = "SELECT * FROM posts WHERE id = :id";
            $stmt = $this->con()->prepare($sql);

            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->fetch();

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function read(): bool|array
    {
        try {
            $sql = "SELECT p.id, p.title, c.name AS cat, p.description, p.date, CONCAT(u.first_name,' ', u.last_name) AS auteur, p.image 
                    FROM posts AS p
                    INNER JOIN categories AS c ON p.cat = c.id
                    INNER JOIN user AS u ON p.auteur = u.id";
            $stmt = $this->con()->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function add(): bool
    {
        try {
            $sql = "INSERT INTO posts VALUES (NULL, :title, :cat, :desc, :date, :auteur, :image)";
            $stmt = $this->con()->prepare($sql);

            $stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindParam(':cat', $this->cat, PDO::PARAM_INT);
            $stmt->bindParam(':desc', $this->description, PDO::PARAM_STR);
            $stmt->bindParam(':date', $this->date, PDO::PARAM_STR);
            $stmt->bindParam(':auteur', $this->auteur, PDO::PARAM_INT);
            $stmt->bindParam(':image', $this->image);

            $stmt->execute();

            // Close statement
            unset($stmt);

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function update(): bool
    {
        try {
            if($this->image != ''){
                $sql = "UPDATE posts SET title = :title, cat = :cat, description = :desc, date = :date, auteur = :auteur, image = :image WHERE id = :id";
                $stmt = $this->con()->prepare($sql);
                $stmt->bindParam(':image', $this->image);
            }else{
                $sql = "UPDATE posts SET title = :title, cat = :cat, description = :desc, date = :date, auteur = :auteur WHERE id = :id";
                $stmt = $this->con()->prepare($sql);
            }

            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindParam(':cat', $this->cat, PDO::PARAM_INT);
            $stmt->bindParam(':desc', $this->description, PDO::PARAM_STR);
            $stmt->bindParam(':date', $this->date, PDO::PARAM_STR);
            $stmt->bindParam(':auteur', $this->auteur, PDO::PARAM_INT);

            $stmt->execute();

            // Close statement
            unset($stmt);

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function delete(): bool
    {
        try {
            $sql = "DELETE FROM posts WHERE id = :id";
            $stmt = $this->con()->prepare($sql);

            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

            $stmt->execute();

            // Close statement
            unset($stmt);

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}