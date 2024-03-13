<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    public function __construct(
        private $model = new User()
    ){}

    public function index(): void
    {
        echo json_encode($this->model->index(), JSON_PRETTY_PRINT);
    }
    public function find(int $id): void
    {
        $result = $this->model->find($id);
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
    public function store($data): void
    {
        $inputs = array_map(fn($val) => $this->sanitizeInput($val), $data);
        $message = $this->model->store(array_values($inputs));
        echo json_encode(['message' => $message]);
    }
    public function update($data, $id): void
    {
        $inputs = array_map(fn($val) => $this->sanitizeInput($val), $data);
        $storable = array_values($inputs);
        $storable[] = $id;
        print_r($storable);
        $message = $this->model->update($storable);
        echo json_encode(['message' => $message]);
    }
    public function sanitizeInput($data): string
    {
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        return trim($data);
    }
}