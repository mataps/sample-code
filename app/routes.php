<?php

Route::group(array('prefix' => 'admin'), function() {
	Route::controller('stories', 		'AdminStoryController');
	Route::controller('articles', 	'AdminArticlesController');
	Route::controller('regions', 		'AdminRegionController');
	Route::controller('provinces', 	'AdminProvinceController');
	Route::controller('cities', 		'AdminCityController');
	Route::controller('/', 					'AdminController');
});

Route::group(array('prefix' => 'api'), function() {
	Route::delete('media/{id}', 'ApiMediaController@removeMedia');
	Route::controller('media', 'ApiMediaController');
});

Route::get('flush', function() {
	return Session::flush();
});

Route::get('env', function() {
	return App::environment();
});

Route::controller('/', 'FrontController');