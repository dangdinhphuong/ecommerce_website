<?php

Route::group([
        'prefix'     => 'client',
        'middleware' => ['web', 'theme', 'locale', 'currency']
    ], function () {

        Route::get('/', 'Shop\Client\Http\Controllers\Shop\ClientController@index')->defaults('_config', [
            'view' => 'client::shop.index',
        ])->name('shop.client.index');

});