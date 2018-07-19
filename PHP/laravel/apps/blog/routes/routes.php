<?php

/*
|--------------------------------------------------------------------------
| BLOG  Routes
|--------------------------------------------------------------------------
|
|heRE all blog routes are listed 
|
*/

//Return blog home view
Route::get('/admin/blog', 'blog@home');

//Return blog home for guest user
Route::get("/blog","blog@userHome");

//Save new blog post
Route::post('/blog/save', 'blog@addPost');

//Delete  a blog post
Route::get('/blog/delete/{postId}', 'blog@delPost');

//return update blog form
Route::get('/post/update/form/{postid}', 'blog@updateForm');

//save Updated blog
Route::post('/save/updated/blog', 'blog@updatePost');

//view all blog posts
Route::get('/view/all/posts', 'blog@viewPost');//->name("viewPosts");

//view a single blog post
Route::get('/view/one/post/{postid}', 'blog@viewOne');

//View blog post from welcome page
Route::get('/view/blog/post/{postid}', 'blog@userViewPost');

//view a single post for user guest
Route::get('/view/post/{postid}', 'blog@userViewOne');

//feature a particular post
Route::get("/feature/post/{postid}","blog@featurePost");
//unfeature

Route::get("/unfeature/post/{postid}","blog@unfeature");

//add post header image
Route::post("/header/post","blog@addHeaderImage");

//crop image header
Route::get("/crop/image/{id}","blog@cropImage");

//view an foimage tag
Route::get('/view/image/{id}', 'blog@getImageTag');

//delete a blog form uploaded image
Route::get('/del/upload/pic/{id}', 'blog@delUpload');

//get all stories of a particular tag 
Route::get("/blog/tags/{tags}","blog@getPostFromTags");


//get link for a particular blog
Route::get("/blogs/{link}","blog@viewLink");

//Add link
Route::get("/add/link/{link}/{id}","blog@addLink");

/*
|--------------------------------------------------------------------------
| Comment   Routes
|--------------------------------------------------------------------------
|
|listing of all comment routes
|
*/

//Return comment home view for admin
Route::get("/admin/cmt/home/{postid}","cmt@home");

//Return base view for user
Route::get("/comments/{postid}","cmt@userHome");


//return admin comment form
Route::get("/cmt/form/{postid}","cmt@cmtForm");

//return user comment form
Route::get("/commment/form/{postid}","cmt@userForm");


//Save admin comment
Route::post("/cmt/save","cmt@addCmt");

//save guest comment
Route::post("/comment/add","cmt@userAddCmt");


//view all comments for a post for admin
Route::get("/admin/view/comments/{postid}","cmt@viewCmt");

//guest viewll all comments for a post
Route::get("/view/comments/{postid}","cmt@userViewCmt");


//delete comment
Route::get("/delete/comments/{cmid}","cmt@delCmt");


//return update comment form
Route::get("/cmt/update/form/{cmid}","cmt@updateForm");

//save updated comment
Route::post("/save/updated/comment","cmt@saveUpdate");

/*
|--------------------------------------------------------------------------
| Reply   Routes
|--------------------------------------------------------------------------
|
|listing of all comment reply routes
|
*/
//return reply user  home
Route::get("/reply/{cid}","blog@userREplyHome");

//return admin reply home
Route::get('/admin/reply/{cid}', 'blog@adminReplyHome');

//add user reply
Route::post("/add/reply","blog@saveUSerReply");

//add admin reply
Route::post("/admin/reply","blog@saveDminReply");

//admin view all replies
Route::get("/admin/view/replies/{cid}","blog@adminViewAllreplies");



//view all  user replies
Route::get("/view/replies/{cid}","blog@userViewAllReplies");

//delete a particular reply
Route::get("/delete/reply/{cid}","blog@delREply");

//return update reply form
Route::get("/reply/update/form/{cid}","cmt@saveUpdate");
