<?php

use Illuminate\Http\Request;
use Dingo\Api\Routing\Router;

$api = app(Router::class);
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

$api->version('v1', function (Router $api) {

  $api->group(['prefix' => 'auth'], function(Router $api) {
      $api->post('signup', 'App\Api\V1\Controllers\SignUpController@signUp');
      $api->post('login', 'App\Api\V1\Controllers\LoginController@login');
      // $api->post('recovery', 'App\\Api\\V1\\Controllers\\ForgotPasswordController@sendResetEmail');
      // $api->post('reset', 'App\\Api\\V1\\Controllers\\ResetPasswordController@resetPassword');
  });

  // $api->group(['middleware' => 'api.auth'], function ($api) {
  // 	$api->post('book/store', 'App\Api\V1\Controllers\BookController@store');
  //
  // });

  $api->group(['middleware' => 'jwt.auth'], function(Router $api) {
      $api->get('book', 'App\Api\V1\Controllers\BookController@index');

      $api->get('protected', function() {
          return response()->json([
              'message' => 'Access to protected resources granted! You are seeing this text as you provided the token correctly.'
          ]);
      });

      $api->get('refresh', [
          'middleware' => 'jwt.refresh',
          function() {
              return response()->json([
                  'message' => 'By accessing this endpoint, you can refresh your access token at each request. Check out this response headers!'
              ]);
          }
      ]);
  });

  $api->get('employee', 'App\Api\V1\Controllers\EmployeeController@index');
  $api->get('employee/{id}', 'App\Api\V1\Controllers\EmployeeController@show');
  $api->get('menu/{id}', 'App\Api\V1\Controllers\MenuController@index');
  $api->get('1041/info/{id}', 'App\Api\V1\Controllers\QI1041Controller@show');
  $api->get('1041/list/{id}', 'App\Api\V1\Controllers\QI1041Controller@listData');
  $api->get('1041/has/{order}/{part}', 'App\Api\V1\Controllers\QI1041Controller@hasPart');

  $api->get('hello', function() {
      return response()->json([
          'message' => 'This is a simple example of item returned by your APIs. Everyone can see it.'
      ]);
  });


});
