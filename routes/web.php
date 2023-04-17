<?php

declare(strict_types = 1);

use App\Actions\{AddToMenu, ListPowergridExamples};
use Illuminate\Support\Facades\Route;

ListPowergridExamples::handle()->each(function ($component) {
    Route::get('/' . $component->getRoute(), fn () => view($component->getRoute(), [
        'code'        => $component->getCode(),
        'title'       => $component->getTitle(),
        'description' => $component->getDescription(),
    ]))->name($component->getRoute());

    AddToMenu::handle($component->getTitle(), $component->getRoute());
});

Route::view('/', 'simple')->name('simple');

Route::view('/powergrid', 'powergrid-demo')->name('powergrid-demo');
