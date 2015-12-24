<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(array("prefix"=>"api/v1.1"),function()
{
    Route::post("oauth/access_token",function()
    {
        return response()->json(\Authorizer::issueAccessToken());
    });

    Route::get('oauth/authorize', ['as' => 'oauth.authorize.get', 'middleware' => ['check-authorization-params', 'auth'], function() {

        $authParams = Authorizer::getAuthCodeRequestParams();

        $formParams = array_except($authParams,'client');

        $formParams['client_id'] = $authParams['client']->getId();

        $formParams['scope'] = implode(config('oauth2.scope_delimiter'), array_map(function ($scope)
        {

            return $scope->getId();

        }, $authParams['scopes']));

        return View::make('oauth.authorization-form', ['params' => $formParams, 'client' => $authParams['client']]);

    }]);


    Route::post('oauth/authorize', ['as' => 'oauth.authorize.post', 'middleware' => ['csrf', 'check-authorization-params', 'auth'], function() {

        $params = Authorizer::getAuthCodeRequestParams();

        $params['user_id'] = Auth::user()->id;

        $redirectUri = Authorizer::issueAuthCode('user', $params['user_id'], $params);

        return Redirect::to($redirectUri);

    }]);



    Route::post("oauth/refresh_token",function()
    {
        return response()->json(\Authorizer::issueAccessToken());
    });

    Route::post("post/create",['middleware' => 'oauth', 'as' => 'post', 'uses' => 'PostControlller@store']);

    Route::get("user/info",['middleware' => 'oauth', 'as' => 'user.info', 'uses' => 'UserController@GetUserByToken']);

});





Route::group(['prefix' => 'api/v1.1/profile', 'middleware' => 'oauth'], function()
{
    Route::get("save",'ApiController@SaveProfile');
    Route::get('all','ApiController@Profiles');
});



Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'UserController@store');

