<?php

Route::group([
        'prefix'        => 'admin/systemcrm',
        'middleware'    => ['web', 'admin']
    ], function () {

        Route::get('', 'SystemCrm\Http\Controllers\Admin\SystemCrmController@index')->defaults('_config', [
            'view' => 'systemcrm::admin.index',
        ])->name('admin.systemcrm.index');

});