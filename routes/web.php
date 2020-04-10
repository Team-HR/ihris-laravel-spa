<?php

// Route to handle page reload in Vue except for api routes
Route::get('/{any?}', function (){
    return view('welcome');
})->where('any', '^(?!api\/)[\/\w\.-]*');