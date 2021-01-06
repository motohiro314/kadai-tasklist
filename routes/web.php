<?php




Route::get('/', 'TasksController@index');

// index: showの補助ページ
//Route::get('tasks', 'TasksController@index')->name('tasks.index');
// create: 新規作成用のフォームページ
//Route::get('tasks/create', 'TasksController@create')->name('tasks.create');
// edit: 更新用のフォームページ
//Route::get('tasks/{id}/edit', 'TasksController@edit')->name('tasks.edit');
//Route::get('tasks/{id}', 'TasksController@show');
//Route::post('tasks', 'TasksController@store');
//Route::put('tasks/{id}', 'TasksController@update');
//Route::delete('tasks/{id}', 'TasksController@destroy');



// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('tasks', 'TasksController');
});


