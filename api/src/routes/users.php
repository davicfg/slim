<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\User;

$app->get('/api/v1/users', function(Request $request, Response $response, array $args){
  $users = User::get();
  return $response->withJson($users);
});

$app->post('/api/v1/users', function(Request $request, Response $response, array $args){
  $data = $request->getParsedBody();
  $user = User::create($data);
  return $response->withJson($user);
});

$app->get('/api/v1/users/{id}', function(Request $request, Response $response, array $args){
  try
  {
    $user = User::findOrFail($args['id']);
    return $response->withJson($user);
  }
  catch(ModelNotFoundException $e)
  {
    return $response->withStatus(404);
  }
});

$app->put('/api/v1/users/{id}', function(Request $request, Response $response, array $args){
  try
  {
    $user = User::findOrFail($args['id']);
    $user->update($request->getParsedBody());
    return $response->withJson($user);
  }
  catch(ModelNotFoundException $e)
  {
    return $response->withStatus(404);
  }

});

$app->delete('/api/v1/users/{id}', function(Request $request, Response $response, array $args){
  try
  {
    $user = User::findOrFail($args['id']);
    $user->delete();
    return $response->withJson($user);
  }
  catch(ModelNotFoundException $e)
  {
    return $response->withStatus(404);
  }

});