<?php

Route::group(['middleware' => 'auth', 'namespace' => 'Forum', 'prefix' => '/forum'], function () {
    Route::get('/{channel?}', 'ThreadController@index')->name('forum.threads.index');
    Route::get('channels/create', 'ChannelController@create')->name('forum.channels.create');
    Route::get('threads/create', 'ThreadController@create')->name('forum.threads.create');
    Route::get('threads/{thread}', 'ThreadController@show')->name('forum.threads.show');
});
