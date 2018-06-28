<?php

Route::group(['middleware' => 'auth', 'namespace' => 'Eportfolio', 'prefix' => '/eportfolio'], function () {
    Route::get('onefile/sectors', 'Onefile\SectorController@index')->name('eportfolios.onefile.sectors.index');
    Route::get('onefile/sectors/{sector}/edit', 'Onefile\SectorController@edit')->name('eportfolios.onefile.sectors.edit');
    Route::patch('onefile/sectors/{sector}', 'Onefile\SectorController@update')->name('eportfolios.onefile.sectors.update');
});
