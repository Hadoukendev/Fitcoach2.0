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
// Rutas publicas
Route::get('/', function () {
  $sliders = App\Slider::orderBy('order', 'asc')->get();
  return view('inicio', ['sliders'=>$sliders]) ;
});
Route::get('/nosotros', function () {
    return view('nosotros');
});
Route::get('/contacto', function () {
    return view('contacto');
});
Route::get('/clasesdeportivas', function () {
  $clases = App\Clases::where('tipo', 'Deportiva')->get();
    return view('clasesdeportivas', ['clases'=>$clases]);
});
Route::get('/aviso', function () {
    return view('aviso');
});


// Authentication routes...
Route::get('entrar', 'Auth\AuthController@getLogin');
Route::post('userExist', 'UserController@userExist');
Route::post('entrar', 'Auth\AuthController@postLogin');
Route::get('salir', 'Auth\AuthController@getLogout');
// Registration routes...
Route::get('registro', 'Auth\AuthController@getRegister');
Route::post('registro', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}/{email}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');




// Zonas seguras
Route::group(['middleware' => 'administradores'], function(){

});
Route::group(['middleware' => 'usuario'], function(){

});
Route::group(['middleware' => 'instructor'], function(){

});
