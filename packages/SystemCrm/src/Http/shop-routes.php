<?php

Route::group([
        'prefix'     => 'systemcrm',
        'middleware' => ['web', 'theme', 'locale', 'currency']
    ], function () {

        Route::get('/', 'SystemCrm\Http\Controllers\Shop\SystemCrmController@index')->defaults('_config', [
            'view' => 'systemcrm::shop.index',
        ])->name('shop.systemcrm.index');

});