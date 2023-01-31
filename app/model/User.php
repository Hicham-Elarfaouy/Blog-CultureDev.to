<?php

class User extends Connection
{
    private int $id;
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $password;

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setFirstName($first_name): void
    {
        $this->first_name = $first_name;
    }

    public function setLastName($last_name): void
    {
        $this->last_name = $last_name;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function signup(): bool
    {
        try {
            $sql = "INSERT INTO user VALUES (NULL, :first_name, :last_name, :email, :pass)";
            $stmt = $this->con()->prepare($sql);

            $stmt->bindParam(':first_name', $this->first_name, PDO::PARAM_STR);
            $stmt->bindParam(':last_name', $this->last_name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindParam(':pass', $this->password, PDO::PARAM_STR);

            $stmt->execute();
            unset($stmt);

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function login()
    {
        try {
            $sql = "SELECT * FROM user WHERE email = :email";
            $stmt = $this->con()->prepare($sql);

            $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function read(): bool|array
    {
        try {
            $sql = "SELECT * FROM user";
            $stmt = $this->con()->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}


