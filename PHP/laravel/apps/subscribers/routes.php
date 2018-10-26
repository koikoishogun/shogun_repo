<?php 
/*
|--------------------------------------------------------------------------
| Subscriber  routes  
|--------------------------------------------------------------------------
|
|listing of all Subscriber routes
|
*/

//Save new subscriber
Route::post('/add/subscriber', 'subscribers@add_subscriber');


//View all subscribers
Route::get('/view/subscriber/{msg?}', 'subscribers@view_subscriber');


//delete a particular subscriber
Route::get('/del/subscriber/{id}', 'subscribers@delete_subscribers');