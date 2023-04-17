<?php
declare(strict_types = 1);

namespace App\Actions;

use Illuminate\Support\Str;

final class ParseComponentCode
{
    public static function handle(string $code): string
    {
        $removeDocBlock = Str::of($code)
            ->betweenFirst('/**', ' */')
            ->prepend('/**')
            ->append(' */')
            ->toString();

        return Str::of($code)
        ->after('use ')
        ->prepend('<?php' . PHP_EOL . PHP_EOL . 'use ')
        ->replace($removeDocBlock, '')
        ->toString();
    }
}
