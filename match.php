<?php

include_once '_load.php';

$request = new \Service\Request();
$matchDb = new \DB\MatchDatabase();
$teamDb = new \DB\TeamDatabase();

switch ($request->getMethod()) {
    case 'GET': # GET matches.php
        $requestId = $request->getQueryData('id');
        if ($requestId) { # GET matches.php?id=1
            echo json_encode($matchDb->all());
        } else {
            echo json_encode($matchDb->get($requestId));
        }
        break;

    /**
     * POST matches.php, POST matches.php?id=1
     * accepts form data: name, data, team1_name, team2_name
     */
    case 'POST':
        $requestId = $request->getQueryData('id');
        $match = $requestId ? $matchDb->get($id) : new \Model\Match();

        $match->name = $request->getPostData('name');
        $match->date = $request->getPostData('date');

        # Resolve team1 by name
        $team1Name = $request->getPostData('team1_name');
        $match->team1 = $teamDb->getByName($team1Name);
        if (!$match->team1) {
            # When team not found by name - create it
            $team1 = new \Model\Team();
            $team1->name = $team1Name;
            $team1->id = $teamDb->create($team1); # apply id of just inserted team
        }

        # Resolve team2 by name
        $team2Name = $request->getPostData('team2_name');
        $match->team2 = $teamDb->getByName($team2Name);
        if (!$match->team2) {
            # When team not found by name - create it
            $team2 = new \Model\Team();
            $team2->name = $team1Name;
            $team2->id = $teamDb->create($team2); # apply id of just inserted team
        }

        $matchDb->create($match);
        echo json_encode($match);
        break;
    case 'DELETE': # DELETE matches.php?id=1
        break;
}

$matchDb->closeDb();