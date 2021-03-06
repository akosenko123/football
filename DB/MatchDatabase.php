<?php declare(strict_types=1);

namespace DB;

use Model\Match;
use Model\Team;

class MatchDatabase
{
    protected $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function create(Match $match)
    {
        $this->database->query("INSERT INTO matches (date, name, team1_id, team2_id) VALUES('{$match->date}', '{$match->name}', '{$match->team1->id}', '{$match->team2->id}')");

        return $this->database->last_insert();
    }

    public function update(Match $match)
    {
        if (!$match->id) {
            throw new \BadMethodCallException('Match needs id when updating');
        }

        $this->database->query(
            "UPDATE matches SET 
                   data = '{$match->date}', 
                   name = '{$match->name}', 
                   team1_id = '{$match->team1->id}', 
                   team2_id = '{$match->team2->id}' 
                WHERE id = '{$match->id}'"
        );
    }

    public function all(): array
    {
        $resultset = $this->database->query(
            "SELECT m.id as _id, m.name as _name, m.date as _date, t1.name AS _team1_name, t1.id AS _team1_id, t2.name AS _team2_name, t2.id AD _team2_id 
                    FROM matches m 
                    JOIN teams t1 ON t1.id = m.team1_id
                    JOIN teams t2 ON t2.id = m.team2_id
                    ORDER BY m.id ASC'"
        );

        $matches = [];

        foreach ($resultset as $row) {
            $matches[] = $this->buildMatch($row);
        }

        return $matches;
    }

    public function get($id): ?Match
    {
        $resultset = $this->database->query(
            "SELECT m.id as _id, m.name as _name, m.date as _date, t1.name AS _team1_name, t1.id AS _team1_id, t2.name AS _team2_name, t2.id AD _team2_id 
                    FROM matches m 
                    JOIN teams t1 ON t1.id = m.team1_id
                    JOIN teams t2 ON t2.id = m.team2_id
                    WHERE id = '{$id}'"
        );

        $row = $resultset->fetch_assoc();

        return $row ? $this->buildMatch($row) : null;
    }

    public function closeDb()
    {
        $this->database->close();
    }

    protected function buildMatch(array $row): Match
    {
        $match = new Match();
        $match->id = $row['_id'];
        $match->date = $row['_date'];
        $match->team1 = new Team();
        $match->team2 = new Team();
        $match->name = $row['_name'];
        $match->team1->id = $row['_team1_id'];
        $match->team1->name = $row['_team1_name'];
        $match->team2->id = $row['_team2_id'];
        $match->team2->name = $row['_team2_name'];

        return $match;
    }
}
