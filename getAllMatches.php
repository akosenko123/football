<?php
    class Match{
    	public $id;
        public $name;
        public $date;
        public $teams = [];
    }

    $matches = [];
    $dbc = mysqli_connect('localhost', 'root', '', 'football_championship');
    $query = "SELECT m.id as _id, m.name as _name, m.date as _date, t1.name AS _team1_name, t2.name AS _team2_name 
    FROM matches m 
    JOIN teams t1 ON t1.id = m.team1_id
    JOIN teams t2 ON t2.id = m.team2_id
    ORDER BY m.id ASC";
    $data = mysqli_query($dbc, $query);

   while($row = mysqli_fetch_assoc($data)){
        $match = new Match();
        $match->id = $row['_id'];
        $match->name = $row['_name'];
        $match->date = $row['_date'];
        $match->teams = [$row['_team1_name'], $row['_team2_name']];
        $matches[] = $match;
   }

   mysqli_close($dbc);
   echo json_encode($matches);
?>