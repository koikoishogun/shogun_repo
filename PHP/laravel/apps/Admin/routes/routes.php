<?php
/*
|--------------------------------------------------------------------------
| Admin  routes  
|--------------------------------------------------------------------------
|
|listing of all  admin routes
|
*/

//Return admin login page
Route::get("/login","adminController@adminLoginForm")->name('login');
//Auth new admin
Route::post("/admin/login","adminController@loginAdmin");
//return home for admin
Route::get("/admin","adminController@home")->middleware('auth');

//logout admin
Route::get("/admin/logout","adminController@logout");

//Add new user instance
Route::get("/add/user/{name}/{email}/{password}","adminController@add_admin");

//delete a user instance
Route::post("/delete/user","adminController@del_admin");

//return user create  home with form
Route::get("/user/home","adminController@addUserHome");