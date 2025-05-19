<?php

namespace Libs\Database;


use Libs\Database\MySQL;
use PDO;
use PDOException;

class UsersTable
{

    private $db;

    // db connect
    public function __construct(MySQL $mysql)
    {
        $this->db = $mysql->connect();
    }

    public function insert($data)
    {
        echo "UsersTable insert <br>";
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        try {
            //prepare
            print_r($data);
            $statement = $this->db->prepare(
                'INSERT INTO users (name,email,phone,address,password,created_at) VALUES (:name,:email,:phone,:address,:password, NOW())'
            );
            $statement->execute($data);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    public function update($users)
    {
        try {
            foreach ($users as $user) {
                $password = password_hash($user->password, PASSWORD_DEFAULT);
                $statement = $this->db->prepare(
                    "UPDATE users SET password=:password"
                );
                $statement->execute([
                    "password" => $password
                ]);
            }
            return $statement->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // find
    public function find($email, $password)
    {
        echo $password;
        echo "<br>";
        try {
            $statement = $this->db->prepare("SELECT * FROM users WHERE email=:email");
            $statement->execute([
                'email' => $email
            ]);
            $user = $statement->fetch();

            if ($user) {
                var_dump([
                    'input_password' => $password,
                    'db_hash' => $user->password,
                    'verify' => password_verify($password, $user->password)
                ]);
                if (password_verify($password, $user->password)) {
                    return $user;
                }
            }
            return "wrong password";
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    //update
    public function updatePhoto($id, $photo)
    {
        try {
            $statement = $this->db->prepare("UPDATE users SET photo=:photo WHERE id=:id");
            $statement->execute([
                'id' => $id,
                'photo' => $photo
            ]);
            return $statement->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }


    public function all()
    {
        try {
            $statement = $this->db->prepare(
                "SELECT users.*, roles.name as role FROM users INNER JOIN roles ON users.role_id = roles.id"
            );
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }


    public function delete($id)
    {
        $statement = $this->db->prepare(
            "DELETE FROM users WHERE id=:id"
        );
        $statement->execute(['id' => $id]);
        return $statement->rowCount();
    }

    public function suspend($id)
    {
        $statement = $this->db->prepare(
            "UPDATE users SET suspended=1 WHERE id=:id"
        );
        $statement->execute(['id' => $id]);
        return $statement->rowCount();
    }

    public function unsuspend($id)
    {
        $statement = $this->db->prepare(
            "UPDATE users SET suspended=0 WHERE id=:id"
        );
        $statement->execute(['id' => $id]);
        return $statement->rowCount();
    }


    public function changeRole($id, $role_id)
    {
        $statement = $this->db->prepare(
            "UPDATE users SET role_id=:role_id WHERE id=:id"
        );
        $statement->execute([
            'id' => $id,
            'role_id' => $role_id
        ]);
        return $statement->rowCount();
    }

    public function allRoles()
    {
        try {
            $statement = $this->db->prepare(
                "SELECT * FROM roles"
            );
            $statement->execute();
            return $statement->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
