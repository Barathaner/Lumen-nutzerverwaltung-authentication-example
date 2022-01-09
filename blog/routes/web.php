<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


/**
 * 1 Lumen install
 * 2 Time erstellen mit get
 * 3 php artisan make:migration User
 * 4 Schema erstellen kopieren
 * 5 index html getrennt front backend lol
 * 6 post zeigen
 * 6 1/2 paar user erstellen
 * 7 alle user zeigen
 * 8 authentication 1 in app auskommentiert, authserviceprovider token hinzugefügt, in env key eintragen, dann in web post 
 * auth hinzufügen, env wird nicht mirveröffentlicht -> passwort, durch trennung frontend typ kann auf /pfad zgreifen und kann sein react scheiß machen. und zusätzlich kann der typ 
 * bei lumen unabhängig arbeiten und ein anderer kann über app auch daran teilhaben 
 */
$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->get('/time', function () use ($router) {
    return response()->json(["time"=> date("Y-m-d H:i:s")]);
});

$router->post('/test', ['middleware' => 'auth', function (Illuminate\Http\Request $request) {
    $fname = $request->input('fname');
    $sname = $request->input('sname');
    $pdo = DB::connection()->getPdo();

$result = DB::insert(sprintf("INSERT INTO users (fname,sname)
VALUES ('%s','%s')",$fname,$sname));
    return  response()->json(["result" => "ok",
"user"=> [
    "id" => $pdo->lastInsertId(),
    "fname" => $fname,
    "sname" => $sname
]]);
}]);



//get all users
$router->get('/users', function () use ($router) {
    return response()->json(app('db')->select("SELECT * FROM users"));
});
