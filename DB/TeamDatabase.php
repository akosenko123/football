<?php declare(strict_types=1);

namespace DB;

use Model\Team;

class TeamDatabase
{
    protected $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function create(Team $team)
    {
        $this->database->query("INSERT INTO teams (name) VALUES ('{$team->name}')");
    }

    public function all(): array
    {
        $resultset = $this->database->query("SELECT t.id as _id, t.name as _name FROM teams ORDER BY m.id ASC'");

        $matches = [];

        while ($row = $resultset->fetch_assoc()) {
            $matches[] = $this->buildTeam($row);
        }

        return $matches;
    }

    public function get($id): ?Team
    {
        $resultset = $this->database->query("SELECT t.id as _id, t.name as _name FROM teams WHERE id = '$id'");

        $row = $resultset->fetch_assoc();

        return $row ? $this->buildTeam($row) : null;
    }

    public function getByName($name): ?Team
    {
        $resultset = $this->database->query("SELECT t.id as _id, t.name as _name FROM teams WHERE name = '$name'");

        $row = $resultset->fetch_assoc();

        return $row ? $this->buildTeam($row) : null;
    }

    public function closeDb()
    {
        $this->database->close();
    }

    protected function buildTeam(array $row): Team
    {
        $team = new Team();
        $team->id = $row['id'];
        $team->name = $row['name'];

        return $team;
    }
}
