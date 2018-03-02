<?php

use Coderatio\Laranotify\Facades\Notify;
use Illuminate\Support\Facades\Route;

Route::get('notify', function ()
{
    Notify::info('Please provide your password to continue.')
        ->title('Last step required')->allowDismiss(false)->align('middle')->asModal();

    return view('frontend/wrapper', ['body' => 'notify::demo']);
});