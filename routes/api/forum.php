<?php
Route::group(['prefix' => 'v1/forum', 'namespace' => 'Api\V1\Forum'], function () {
    // Channel
    Route::post('channels', 'ChannelController@store')->name('api.forum.channels.store');
    Route::patch('channels/{channel}', 'ChannelController@update')->name('api.forum.channels.update');

    // Threads
    Route::post('threads/create', 'ThreadController@store')->name('api.forum.threads.store');

    // Replies
    Route::get('threads/{thread}/replies', 'ReplyController@index')->name('api.forum.threads.replies.index');
    Route::post('threads/{thread}/replies', 'ReplyController@store')->name('api.forum.threads.replies.store');

    // Subscriptions
    Route::post('channels/{channel}/subscriptions', 'ChannelSubscriptionController@store')->name('api.forum.channels.subscriptions.store');
    Route::delete('channels/{channel}/subscriptions', 'ChannelSubscriptionController@destroy')->name('api.forum.channels.subscriptions.destroy');
    Route::post('threads/{thread}/subscriptions', 'ThreadSubscriptionController@store')->name('api.forum.threads.subscriptions.store');
    Route::delete('threads/{thread}/subscriptions', 'ThreadSubscriptionController@destroy')->name('api.forum.threads.subscriptions.destroy');
});