<?php
declare(strict_types = 1);

namespace App\Actions;

final class AddToMenu
{
    public static function handle(string $title, string $route): void
    {
        config(['menu' => array_merge(
            config('menu'),
            [[
                'name'  => $title,
                'label' => $title,
                'route' => $route,
            ]]
        )]);
    }
}
