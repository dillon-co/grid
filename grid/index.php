<?php

require 'vendor/autoload.php';

function getDB()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "MwiMwaSwd1!";
    $dbname = "proximity";

    $mysql_conn_string = "mysql:host=$dbhost;dbname=$dbname";
    $dbConnection = new PDO($mysql_conn_string, $dbuser, $dbpass);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbConnection;
}

$app = new \Slim\Slim();

$app->get('/', function() use($app) {
    $app->response->setStatus(200);
    echo "Welcome to Slim based API";
});

// Get Event
$app->get('/getEvent/:id', function ($id) {
    $app = \Slim\Slim::getInstance();

    try
    {
        $db = getDB();
        $sth = $db->prepare("SELECT *
            FROM events
            WHERE eventId = :id");

        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->execute();

        $event = $sth->fetch(PDO::FETCH_OBJ);

        if($event) {
            $app->response->setStatus(200);
            $app->response()->headers->set('Content-Type', 'application/json');
            echo json_encode($event);
            $db = null;
        } else {
            throw new PDOException('No records found.');
        }

    } catch(PDOException $e) {
        $app->response()->setStatus(404);
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
});


// Update Event Description
$app->post('/updateEventDescription', function() use($app) {

    $allPostVars = $app->request->post();
    $eventDescription = $allPostVars['eventDescription'];
    $eventId = $allPostVars['eventId'];

    try
    {
        $db = getDB();

        $sth = $db->prepare("UPDATE events
            SET eventDescription = :eventDescription
            WHERE eventId = :eventId");

        $sth->bindParam(':eventDescription', $eventDescription, PDO::PARAM_INT);
        $sth->bindParam(':eventId', $eventId, PDO::PARAM_INT);
        $sth->execute();

        $app->response->setStatus(200);
        $app->response()->headers->set('Content-Type', 'application/json');
        echo json_encode(array("status" => "success", "code" => 1));
        $db = null;

    } catch(PDOException $e) {
        $app->response()->setStatus(404);
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

});

// Update Event Date
$app->post('/updateEventDate', function() use($app) {

    $allPostVars = $app->request->post();
    $date = $allPostVars['date'];
    $eventId = $allPostVars['eventId'];

    try
    {
        $db = getDB();

        $sth = $db->prepare("UPDATE events
            SET date = :date
            WHERE eventId = :eventId");

        $sth->bindParam(':date', $date, PDO::PARAM_INT);
        $sth->bindParam(':eventId', $eventId, PDO::PARAM_INT);
        $sth->execute();

        $app->response->setStatus(200);
        $app->response()->headers->set('Content-Type', 'application/json');
        echo json_encode(array("status" => "success", "code" => 1));
        $db = null;

    } catch(PDOException $e) {
        $app->response()->setStatus(404);
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }

});



$app->run();
