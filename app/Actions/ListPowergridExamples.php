<?php
declare(strict_types = 1);

namespace App\Actions;

use App\ValueObjects\PowergridExample;
use Illuminate\Support\Facades\File;
use Illuminate\Support\{Collection, Str};

final class ListPowergridExamples
{
    public static function handle(): Collection
    {
        return collect(File::files(app_path('Http' . DIRECTORY_SEPARATOR . 'Livewire')))
                ->reject(fn ($file) => Str::endsWith($file->getFilename(), 'Table.php') === false)
                ->map(function ($file) {
                    try {
                        return PowergridExample::fromFile($file);
                    } catch (\Exception $e) {
                        return;
                    }
                })
                ->reject(null);
    }
}
