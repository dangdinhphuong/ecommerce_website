<?php

Route::group([
        'prefix'        => 'admin/melisearch',
        'middleware'    => ['web', 'admin']
    ], function () {

        Route::get('', 'Melisearch\Http\Controllers\Admin\MelisearchController@index')->defaults('_config', [
            'view' => 'melisearch::admin.index',
        ])->name('admin.melisearch.index');

});