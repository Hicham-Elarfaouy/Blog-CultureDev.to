<?php

class Categories extends Connection
{
    private int $id;
    private string $name;

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    function read(): bool|array
    {
        try {
            $sql = "SELECT * FROM categories";
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
            $sql = "INSERT INTO categories VALUES (NULL, :name)";
            $stmt = $this->con()->prepare($sql);

            $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);

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
            $sql = "UPDATE categories SET name = :name WHERE id = :id";
            $stmt = $this->con()->prepare($sql);

            $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
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

    function delete(): bool
    {
        try {
            $sql = "DELETE FROM categories WHERE id = :id";
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