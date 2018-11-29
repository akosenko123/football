<?php
$id = $_POST['id'];
$name = $_POST['name'];
$team_1 = $_POST['team_1'];
$team_2 = $_POST['team_2'];

    $dbc = mysqli_connect('localhost', 'root', '', 'football_championship');
    $query = "UPDATE matches SET date='$date', name='$name', team_1='$team_1', team_2='$team_2' WHERE matches.id=$id";
    $data = mysqli_query($dbc, $query);
    {
  echo 'Data Updated';
 }  
   mysqli_close($dbc);
?>