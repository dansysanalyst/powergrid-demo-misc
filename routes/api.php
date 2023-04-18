<?php
declare(strict_types = 1);

use App\Http\Controllers\Api\Index;
use Illuminate\Support\Facades\Route;

Route::match([
    'GET', 'POST',
], '/category', Index::class)->name('category.index');
