<?php

namespace App\Models;

use App\Core\BaseModel;

class User extends BaseModel
{
    public function index(): array|null|false
    {
        $sql = "SELECT * FROM users";
        return $this->getAll($sql);
    }
    public function find(int $id)
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        return $this->getById($sql, $id);
    }
    public function store($data): ?string
    {
        $sql = "INSERT INTO users(
            first_name,
            last_name,
            email,
            phone,
            address
        ) VALUES(?, ?, ?, ?, ?)";
        return $this->insert($sql, $data);
    }
    public function update($data)
    {
        $sql = "UPDATE users 
            SET 
                first_name = ?, 
                last_name = ?, 
                email = ?, 
                phone = ?, 
                address = ? 
            WHERE id = ?";
        return $this->update($sql, $data);
    }

}