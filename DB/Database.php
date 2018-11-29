<?php declare(strict_types=1);

namespace DB;

class Database
{
    protected $db;

    public function __construct()
    {
        $this->db = mysqli_connect('localhost', 'root', '', 'football_championship');
    }

    public function query(string $query): \mysqli_result
    {
        $result = $this->db->query($query);

        if (!$result) {
            throw new \BadMethodCallException($this->db->error);
        }

        return $result;
    }

    public function last_insert()
    {
        return $this->db->insert_id;
    }

    public function close(): void
    {
        $this->db->close();
    }
}
