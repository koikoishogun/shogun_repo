<?php
/*
|--------------------------------------------------------------------------
| Messages  routes  
|--------------------------------------------------------------------------
|
|listing of all  Messages routes
|
*/

//save a new message
Route::post('/new/message', 'msg@create_msg');

//view msg
Route::get('/view/messages/{msg?}', 'msg@view_msg');

//delete msg
Route::get('/del/message/{id}', 'msg@delete_msg');