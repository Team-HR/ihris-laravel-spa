<?php

Route::Auth();


Route::get('/',function(){
    return redirect('/home');
});
Route::get('/{any}', 'AppController@index')->where('any','.*');