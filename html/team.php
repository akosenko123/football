



teams.php
teams.php?id=1

1. SELECT * FROM teams ORDER BY id;

$teams = [];

while($row = mysqli_fetch_row($stmt) {

$team = new Team;
$team->id = $row['id'];

$teams[] = $team;
}


<?php
$selectedTeamId = $_GET['id'];
if (!$selectedTeamId) {
    $selectedTeamId = $teams[0]->id;
}

?>
SELECT * FROM players WHERE team_id = $selectedTeamId;

$players = [];

while($row = mysqli_fetch_row($stmt) {

    $player = new Player;
$player->id = $row['id'];

$players[] = $player;
}


------

<table>
    <tr>

        <td>
            <ul>
            <?php foreach($teams as $team) { ?>
                <li <?php if ($selectedTeamId === $team->id) { ?> class="selected" <?php } ?>>
                    <a href="teams.php?id=<?php echo $team->id ?>"><?php echo $team->name?></a>
                </li>
            <?php } ?>
            </ul>
        </td>

        <td>
            <ul>
                <?php foreach($players as $player) { ?>
                    <li><a href="players.php?id=<?php echo $player->id ?>"><?php echo $player->name?></a></li>
                <?php } ?>
            </ul>
            </ul>
        </td>
    </tr>
</table>