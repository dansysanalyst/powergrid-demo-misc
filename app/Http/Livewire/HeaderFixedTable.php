<?php
declare(strict_types = 1);

namespace App\Http\Livewire;

use App\Helpers\PowerGridThemes\TailwindHeaderFixed;
use PowerComponents\LivewirePowerGrid\{Footer, Header};

/**
 * PowerGrid Example
 *
 * @description Header Fixed
 *
 * @title Header Fixed
 *
 * @route header-fixed
 */
final class HeaderFixedTable extends SimpleTable
{
    public array $perPageValues = [0];

    public function setUp(): array
    {
        return [
            Header::make()
                ->showSearchInput(),

            Footer::make()
                ->showRecordCount(),
        ];
    }

    public function template(): ?string
    {
        return TailwindHeaderFixed::class;
    }
}
