<?php
    include_once '../models/user.php';

    function getAllUsers()
    {
        $db = dbConnect();
        $query = $db->query('SELECT * FROM users ORDER BY last_name');
        $users = $query->fetchAll();
        return $users;
    }

    // On a séparé les deux add pour éviter que quelqu'un force le mode admin depuis le site client
    function addUserWithAdmin($informations)
    {
        $db = dbConnect();
        $query = $db->prepare('INSERT INTO users (first_name, last_name, email, password, is_admin) VALUES (:first_name, :last_name, :email, :password, :is_admin)');
        $result = $query->execute([
            ':first_name' => $informations['first_name'],
            ':last_name' => $informations['last_name'],
            ':email' => $informations['email'],
            ':password' => password_hash($informations['password'], PASSWORD_BCRYPT),
            ':is_admin' => $informations['is_admin']
        ]);

        return $result;
    }

    function getUserDataById($id)
    {
        $db = dbConnect();
        $query = $db->prepare('SELECT * FROM users WHERE id = :id');
        $query->execute([':id' => $id]);
        $user = $query->fetch();
        return $user;
    }

    function updateUserWithAdmin($informations)
    {
        $db = dbConnect();
        if (empty($informations['password']))
        {
            $query = $db->prepare('UPDATE users SET first_name=:first_name, last_name = :last_name, email=:email, phone_number=:phone_number, is_admin=:is_admin WHERE id=:id');
            $result = $query->execute([
                ':id' => $informations['id'],
                ':first_name' => $informations['first_name'],
                ':last_name' => $informations['last_name'],
                ':email' => $informations['email'],
                ':phone_number' => $informations['phone_number'],
                ':is_admin' => $informations['is_admin'],
            ]);
        }
        else
        {
            $query = $db->prepare('UPDATE users SET first_name=:first_name, last_name = :last_name, email=:email, phone_number=:phone_number, is_admin=:is_admin, password=:password WHERE id=:id');
            $result = $query->execute([
                ':id' => $informations['id'],
                ':first_name' => $informations['first_name'],
                ':last_name' => $informations['last_name'],
                ':email' => $informations['email'],
                ':phone_number' => $informations['phone_number'],
                ':is_admin' => $informations['is_admin'],
                ':password' => password_hash($informations['password'], PASSWORD_BCRYPT),
            ]);
        }
        return $result;
    }

    function deleteUser($informations)
    {
        $db = dbConnect();
        $query = $db->prepare('DELETE FROM users WHERE id=:id');
        return $query->execute([
            ':id' => $informations['id'],
        ]);
    }