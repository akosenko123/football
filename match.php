<?php

include_once '_load.php';

$request = new \Service\Request();
$matchDb = new \DB\MatchDatabase();
$teamDb = new \DB\TeamDatabase();

switch ($request->getMethod()) {
    case 'GET':
        $requestId = $request->getQueryData('id');
        if ($requestId) {
            echo json_encode($matchDb->all());
        } else {
            echo json_encode($matchDb->get($requestId));
        }
        break;

    case 'POST':
        $requestId = $request->getQueryData('id');
        $match = $requestId ? $matchDb->get($id) : new \Model\Match();

        $match->name = $request->getPostData('name');
        $match->date = $request->getPostData('date');
        $match->team1 = $teamDb->getByName($request->getPostData('team1_name'));
        $match->team2 = $teamDb->getByName($request->getPostData('team2_name'));

        $matchDb->create($match);
        echo json_encode($match);
        break;
    case 'PUT':
    case 'DELETE':
        break;
}

$matchDb->closeDb();