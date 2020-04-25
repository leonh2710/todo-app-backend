<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->setBasePath((function () {
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    $uri = (string) parse_url('http://a' . $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
    if (stripos($uri, $_SERVER['SCRIPT_NAME']) === 0) {
        return $_SERVER['SCRIPT_NAME'];
    }
    if ($scriptDir !== '/' && stripos($uri, $scriptDir) === 0) {
        return $scriptDir;
    }
    return '';
})());

// Sonderfall: Anmeldung
// $app->post('/api', );

// 1. GET
// Eine Aufgabe
$app->get('/api/tasks/{taskId}', function (Request $request, Response $response, $args){
    // 1. Token aus Header auslesen
    $user   = $request->getHeader('token');
    // 2. Argument(e) auslesen
    $taskId = $request->getAttribute('taskId');
    // 3. DB-Aufruf
    //$response->getBody()->write(json_encode(FUNKTION(UUID, taskId)))
    return $response;
});

// Alle Aufgaben
$app->get('/api/tasks', function (Request $request, Response $response, $args){
    // 1. Token aus Header auslesen
    $user = $request->getHeader('token');
    // 2. DB-Aufruf
    //$response->getBody()->write(json_encode(FUNKTION(UUID)))
    return $response;
});

// Alle Listen eines Nutzers (ID, Name)
$app->get('/api/lists', function (Request $request, Response $response, $args){
    // Token aus Header auslesen
    $user = $request->getHeader('token');
    // DB-Aufruf
    //$response->getBody()->write(json_encode(ALLE LISTEN VON NUTZER (UUID)))
    return $response;
});

// Eine Liste eines Nutzers (ID, Name)
$app->get('/api/lists/{listId}', function (Request $request, Response $response, $args){
    // 1. Token aus Header auslesen
    $user   = $request->getHeader('token');
    // 2. Argument(e) auslesen
    $listId = $request->getAttribute('listId');
    // 3. DB-Aufruf
    //$response->getBody()->write(json_encode(FUNKTION(UUID, listId)))
    return $response;
});

// Alle Aufgaben einer Liste 
$app->get('/api/lists/{listId}/tasks', function (Request $request, Response $response, $args){
    // 1. Token aus Header auslesen
    $user   = $request->getHeader('token');
    // 2. Argument(e) aus URI auslesen
    $listId = $request->getAttribute('listId');
    // 3. DB-Aufruf
    //$response->getBody()->write(json_encode(FUNKTION(UUID, listId)))
    return $response;
});

// 2. POST
// Erstellen einer Aufgabe
$app->post('/api/tasks', function(Request $request, Response $response, $args){
    // 1. Token aus Header auslesen
    // 2. Körper der Anfrage auslesen 
    $parsedBody = $request->getParsedBody();
    $taskId         = $parsedBody['taskId'];
    $title          = $parsedBody['title'];
    $description    = $parsedBody['description'];
    $priority       = $parsedBody['priority'];
    $dueDate        = $parsedBody['dueDate'];
    $state          = $parsedBody['state'];
    $toDoList       = $parsedBody['toDoList'];
    // 3. Objekt anlegen
    // $task = Create Task (taskId, ...)
    // 4. Objekt zurückgeben
    //$response->getBody()->write(json_encode($task))
    return $response;
});

// Erstellen einer Liste
$app->post('/api/lists', function(Request $request, Response $response, $args){
    // 1. Token aus Header auslesen
    // 2. Körper der Anfrage auslesen 
    $parsedBody = $request->getParsedBody();
    $listId = $parsedBody['listId'];
    $name   = $parsedBody['name'];
    // 3. Objekt anlegen
    // $list = Create List (listid, name)
    // 4. Objekt zurückgeben
    //$response->getBody()->write(json_encode($list))
    return $response;
});

// 3. PUT
// Anpassen einer Aufgabe
$app->put('/api/tasks/{taskId}', function(Request $request, Response $response, $args){
    // 1. Token aus Header auslesen
    // 2. Körper der Anfrage auslesen 
    $parsedBody = json_decode((string)$request->getBody(), true);
    $taskId         = $request->getAttribute('taskId');
    $title          = $parsedBody['title'];
    $description    = $parsedBody['description'];
    $priority       = $parsedBody['priority'];
    $dueDate        = $parsedBody['dueDate'];
    $state          = $parsedBody['state'];
    $toDoList       = $parsedBody['toDoList'];
    // 3. Objekt anpassen
    // $task = Update Task (taskId, ...)
    // 4. Objekt zurückgeben
    //$response->getBody()->write(json_encode($task))
    return $response;
});

// Anpassen einer Liste
$app->put('/api/lists/{listId}', function(Request $request, Response $response, $args){
    // 1. Token aus Header auslesen
    // 2. Körper der Anfrage auslesen 
    $parsedBody = json_decode((string)$request->getBody(), true);
    $listId = $request->getAttribute('listId');
    $name   = $parsedBody['name'];
    // 3. Objekt anpassen
    // $list = Update List (listId, ...)
    // 4. Objekt zurückgeben
    //$response->getBody()->write(json_encode($task))
    return $response;
});

// 4. DELETE
// Löschen aller Listen
$app->delete('/api/lists', function (Request $request, Response $response, $args){
    // Token aus Header auslesen
    $user = $request->getHeader('token');
    // Listen aus DB holen
    // Listen löschen
    // Listen zurückgeben
    //$response->getBody()->write(json_encode(ALLE LISTEN VON NUTZER (UUID)))
    return $response;
});

// Löschen einer Liste
$app->delete('/api/lists/{listId}', function (Request $request, Response $response, $args){
    // Token aus Header auslesen
    $user = $request->getHeader('token');
    // Liste aus DB holen
      // $list = GetListe ($request->getAttribute('listId'))
    // Liste löschen
      // delete($list)
    // Liste zurückgeben
      //$response->getBody()->write(json_encode($list)
    return $response;
});

// Löschen einer Aufgabe
$app->delete('/api/tasks/{taskId}', function (Request $request, Response $response, $args){
    // Token aus Header auslesen
    $user = $request->getHeader('token');
    // Aufgabe aus DB holen
    // Aufgabe löschen
    // Aufgabe zurückgeben
    return $response;
});

// Löschen aller Aufgaben einer Liste
$app->delete('/api//lists/{listId}/tasks/{taskId}', function (Request $request, Response $response, $args){
    // Token aus Header auslesen
    $user = $request->getHeader('token');
    // Aufgaben aus Liste aus DB holen
    // Aufgaben löschen
    // Aufgaben zurückgeben
    return $response;
});

$app->run();
?>
