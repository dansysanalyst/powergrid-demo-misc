<?php
declare(strict_types = 1);

namespace App\Http\Livewire;

use App\Helpers\PowerGridThemes\TailwindStriped;

/**
 * PowerGrid Example
 *
 * @description Striped
 *
 * @title Striped
 *
 * @route striped
 */
final class StripedTable extends SimpleTable
{
    public function template(): ?string
    {
        return TailwindStriped::class;
    }
}
