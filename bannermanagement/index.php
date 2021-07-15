<?php
require 'vendor/autoload.php';
require 'db.php';

$app = new \Slim\App;

////GET - endpoints, api for the get requests
$app->get('/', function ($request,  $response, $args) {
    $response->getBody()->write("this is the root directory");

    return $response;
    }
);


$app->get('/user', function ($request,  $response, $args) {
    // $response->getBody()->write("this will return all users");
    // return $response;

    $sql = "SELECT * FROM user";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($user);
    }catch (PDOException $e) {
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
}
);

$app->get('/user/{id}', function ($request,  $response, $args) {
    $id = $args['id'];
    $sql = "SELECT * FROM user WHERE id = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
    
        $stmt = $db->query($sql);
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($user);
    } catch(PDOException $e){
        $data = array(
            "status" => "fail"
        );
        echo json_encode($data);
    }
   
}
);

);

$app->run();