<?php

Route::group([
        'prefix'        => 'admin/client',
        'middleware'    => ['web', 'admin']
    ], function () {

        Route::get('', 'Shop\Client\Http\Controllers\Admin\ClientController@index')->defaults('_config', [
            'view' => 'client::admin.index',
        ])->name('admin.client.index');

});