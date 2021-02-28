<?php

Auth::routes();
Route::get('guest', 'Auth\LoginController@guestLogin')->name('login.guest');
Route::get('/', 'ArticleController@index')->name('articles.index');
Route::get('articles/{article}', 'ArticleController@show')->name('articles.show')->where('article', '[0-9]+');
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/{name}', 'UserController@show')->name('show');
    Route::get('/{name}/likes', 'UserController@likes')->name('likes');
    Route::get('/{name}/followings', 'UserController@followings')->name('followings');
    Route::get('/{name}/followers', 'UserController@followers')->name('followers');
});

Route::group(['middleware' => 'auth'], function() {
    Route::resource('/articles', 'ArticleController')->except(['index', 'show']);
    Route::prefix('articles')->name('articles.')->group(function () {
        Route::put('/{article}/like', 'ArticleController@like')->name('like');
        Route::delete('/{article}/like', 'ArticleController@unlike')->name('unlike');
    });
    Route::prefix('users/{name}')->name('users.')->group(function () {
        Route::put('/follow', 'UserController@follow')->name('follow');
        Route::delete('/follow', 'UserController@unfollow')->name('unfollow');
        Route::get('/edit', 'UserController@edit')->name('edit');
        Route::patch('/update', 'UserController@update')->name('update');
        Route::get('/edit_password', 'UserController@editPassword')->name('edit_password');
        Route::patch('/update_password', 'UserController@updatePassword')->name('update_password');
        // Route::delete('/', 'UserController@destroy')->name('destroy');
    });
    Route::post('profile-update/{user}', 'UserController@profileUpdate')->where('user', '[0-9]+')->name('profile-update');

    Route::resource('/comments', 'CommentController')->only(['store', 'destroy']);
    Route::resource('/goals', 'Goal\GoalController');
    Route::post('update-progress/{goal}', 'Goal\GoalController@updateProgress')->where('goal', '[0-9]+');
});

Route::get('redirect/{driver}', 'Auth\LoginController@redirectToProvider')
     ->name('login.provider')
     ->where('driver', implode('|', config('auth.socialite.drivers')));
Route::get('/{driver}/callback', 'Auth\LoginController@handleProviderCallback');
