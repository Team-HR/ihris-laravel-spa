<?php
use Illuminate\Support\Facades\Route;

// Route to handle page reload in Vue except for api routes
Route::get('/{any?}', function (){
    return view('app');
})->where('any', '^(?!api\/)[\/\w\.-]*');