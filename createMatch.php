<?php
$date = $_POST['date'];
$name = $_POST['name'];
$team_1 = $_POST['team_1'];
$team_2 = $_POST['team_2'];

function retrieveTeam($dbc, $name)
{
	$query = "SELECT id FROM teams WHERE name = '$name'";
    $resultset = mysqli_query($dbc, $query);
    $row = mysqli_fetch_assoc($resultset);

    return $row['id'] ?? null;
}


function createTeam($dbc, $name)
{
	$query = "INSERT INTO teams (name) VALUES ('$name')";
    if (!mysqli_query($dbc, $query)) {
    	die(mysqli_error($dbc));
    }

    return $dbc->insert_id;
}


    $dbc = mysqli_connect('localhost', 'root', '', 'football_championship');
    
	$team1Id = retrieveTeam($dbc, $team_1);
    if (!$team1Id) {
    	$team1Id = createTeam($dbc, $team_1);
    }

	$team2Id = retrieveTeam($dbc, $team_2);
    if (!$team2Id) {
    	$team2Id = createTeam($dbc, $team_2);
    }

    $query = "INSERT INTO matches (date, name, team1_id, team2_id) VALUES('$date', '$name', '$team1Id', '$team2Id')";
    if(mysqli_query($dbc, $query)) {
    } else {
    	die(mysqli_error($dbc));
    }
   mysqli_close($dbc);
?>