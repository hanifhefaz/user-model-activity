<?php

use Hanifhefaz\UserModelActivity\UserModelActivityController;
use Illuminate\Support\Facades\Route;

Route::get('/user-model-activity', [UserModelActivityController::class, 'index'])->name('user-model-activity');
Route::get('/fetch-log-content', [UserModelActivityController::class, 'fetchLogContent']);
