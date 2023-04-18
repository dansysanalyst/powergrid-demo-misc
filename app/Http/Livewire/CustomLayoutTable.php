<?php
declare(strict_types = 1);

namespace App\Http\Livewire;

use App\Helpers\PowerGridThemes\TailwindStriped;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Column, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

/**
 * PowerGrid Example
 *
 * @description Custom Layout
 *
 * @title Custom Layout
 *
 * @route custom-layout
 */
final class CustomLayoutTable extends PowerGridComponent
{
    use ActionButton;

    public function setUp(): array
    {
        return [
            Header::make()
                ->showToggleColumns()
                ->showSearchInput()
                ->includeViewOnTop('components.header.view-on-top')
                ->includeViewOnBottom('components.header.view-on-bottom'),

            Footer::make()
                ->showPerPage()
                ->showRecordCount()
                ->includeViewOnTop('components.bottom.view-on-top')
                ->includeViewOnBottom('components.bottom.view-on-bottom'),
        ];
    }

    public function datasource(): ?Builder
    {
        return User::query();
    }

    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('email')
            ->addColumn('created_at_formatted', function (User $model) {
                return Carbon::parse($model->created_at)->format('d/m/Y H:i:s');
            })
            ->addColumn('updated_at_formatted', function (User $model) {
                return Carbon::parse($model->updated_at)->format('d/m/Y H:i:s');
            });
    }

    public function columns(): array
    {
        return [
            Column::add()
                ->title('ID')
                ->field('id'),

            Column::add()
                ->title('NAME')
                ->field('name')
                ->sortable()
                ->searchable(),

            Column::add()
                ->title('EMAIL')
                ->field('email')
                ->sortable()
                ->searchable(),

            Column::add()
                ->title('CREATED AT')
                ->field('created_at_formatted', 'created_at')
                ->searchable()
                ->sortable(),

        ];
    }

    public function template(): ?string
    {
        return TailwindStriped::class;
    }
}
