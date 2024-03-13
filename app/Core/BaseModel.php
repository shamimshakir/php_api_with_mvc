<?php

namespace App\Core;
use PDO;
use PDOException;

class BaseModel extends Database
{
    public PDO $connection;
    public function __construct()
    {
        parent::__construct();
        $this->connection = $this->getConnection();
    }
    public function getAll($sql)
    {
        try {
            $statement = $this->connection->prepare($sql);
            $result = $statement->execute();
            if($result) {
                if($statement->rowCount() > 0) {
                    $rows = $statement->fetchAll();
                    $data = [
                        'status' => 200,
                        'data' => $rows
                    ];
                    header("HTTP/1.0 200 ok");
                } else {
                    $data = [
                        'status' => 400,
                        'message' => "No record found"
                    ];
                    header("HTTP/1.0 400 No record found");
                }
            } else {
                $data = [
                    'status' => 500,
                    'message' => "Internal server error"
                ];
                header("HTTP/1.0 500 Internal server error");
            }
            return $data;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function getById(string $sql, int $id)
    {
        try {
            $statement = $this->connection->prepare($sql);
            $result = $statement->execute(array($id));
            if($result) {
                if($statement->rowCount() > 0) {
                    $data = [
                        "status" => 200,
                        "data" => $statement->fetch()
                    ];
                    header("HTTP/1.0 200 ok");
                } else {
                    $data = [
                        "status" => 400,
                        "message" => "No record found"
                    ];
                    header("HTTP/1.0 400 No record found");
                }
            } else {
                $data = [
                    "status" => 500,
                    "message" => "Internal server error"
                ];
                header("HTTP/1.0 500 Internal server error");
            }
            return $data;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function insert($sql, $data)
    {
        try {
            $statement = $this->connection->prepare($sql);
            $result = $statement->execute($data);
            if($result) {
                $data = [
                    'status' => 201,
                    'message' => "New record created"
                ];
                header("HTTP/1.0 201 created");
            } else {
                $data = [
                    'status' => 500,
                    'message' => "Internal server error"
                ];
                header("HTTP/1.0 500 Internal server error");
            }
            return $data;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}