<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $db_name = "lab9_modulardb";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db_name);
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
        $this->conn->set_charset("utf8");
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function get($table, $where = null) {
        $sql = "SELECT * FROM $table";
        if ($where) $sql .= " WHERE $where";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    public function insert($table, $data) {
        $columns = implode(",", array_keys($data));
        $values = implode("','", array_values($data));
        $sql = "INSERT INTO $table ($columns) VALUES ('$values')";
        return $this->conn->query($sql);
    }

    public function update($table, $data, $where) {
        $update = [];
        foreach ($data as $key => $val) {
            $update[] = "$key='$val'";
        }
        $update_str = implode(",", $update);
        $sql = "UPDATE $table SET $update_str WHERE $where";
        return $this->conn->query($sql);
    }

    public function delete($table, $where) {
        $sql = "DELETE FROM $table WHERE $where";
        return $this->conn->query($sql);
    }
}
?>