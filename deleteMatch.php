<?php
$id = $_GET['id'];

    $dbc = mysqli_connect('localhost', 'root', '', 'football_championship');
    $query = "DELETE FROM matches WHERE id = '".$_POST["id"]."'";
    $data = mysqli_query($dbc, $query);
   mysqli_close($dbc);
?>