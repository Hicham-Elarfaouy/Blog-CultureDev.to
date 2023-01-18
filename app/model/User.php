<?php

class User extends Connection
{
    public int $id;
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $password;
    public bool $is_admin;

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

    public function setAdmin($is_admin): void
    {
        $this->is_admin = $is_admin;
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

//    public function display($id)
//    {
//
//        $stmt = $this->con()->prepare("SELECT * FROM user WHERE id=? ");
//        $stmt->execute([$id]);
//        return $stmt->fetch();
//
//    }
//
//    public function logout()
//    {
//        unset($_SESSION['userId']);
//        unset($_SESSION['isAdmin']);
//    }
}


