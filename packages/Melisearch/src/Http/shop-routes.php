<?php

Route::group([
        'prefix'     => 'melisearch',
        'middleware' => ['web', 'theme', 'locale', 'currency']
    ], function () {

        Route::get('/', 'Melisearch\Http\Controllers\Shop\MelisearchController@index')->defaults('_config', [
            'view' => 'melisearch::shop.index',
        ])->name('shop.melisearch.index');

});