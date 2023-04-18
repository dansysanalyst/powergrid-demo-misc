<?php
declare(strict_types = 1);

namespace App\Http\Livewire;

use App\Models\Dish;
use Illuminate\Support\Carbon;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};
use WireUi\Traits\Actions;

/**
 * PowerGrid Example
 *
 * @description
 *
 * @title Wire Elements Modal
 *
 * @route wire-elements-modal
 */
final class WireElementsModalTable extends PowerGridComponent
{
    use ActionButton;
    use Actions;

    public function setUp(): array
    {
        return [
            Header::make()
                ->showSearchInput(),

            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource()
    {
        return Dish::with('category');
    }

    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('chef_name')
            ->addColumn('price')
            ->addColumn('in_stock')
            ->addColumn('in_stock_label', function ($entry) {
                return $entry->in_stock ? 'sim' : 'não';
            })
            ->addColumn('created_at_formatted', function ($entry) {
                return Carbon::parse($entry->created_at)->format('d/m/Y');
            });
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable(),

            Column::make('Name', 'name')
                ->searchable()
                ->sortable(),

            Column::make('Chef', 'chef_name')
                ->searchable()
                ->sortable(),

            Column::make('Price', 'price')
                ->sortable(),

            Column::make('In Stock', 'in_stock_label')
                ->toggleable()
                ->field('in_stock'),

            Column::make('Created At', 'created_at_formatted'),
        ];
    }

    public function onUpdatedToggleable(string $id, string $field, string $value): void
    {
        $this->notification([
            'title'       => 'onUpdatedToggleable',
            'description' => "Id: {$id}, Field: {$field}, Value: {$value}",
            'icon'        => 'success',
            'timeout'     => 4000,
        ]);

        Dish::query()->where('id', $id)->update([
            $field => $value,
        ]);
    }

    public function actions(): array
    {
        return [
            Button::add('edit-stock')
                ->bladeComponent('button.circle', function (Dish $dish) {
                    return [
                        'primary'    => true,
                        'icon'       => 'pencil',
                        'wire:click' => '$emit(\'openModal\', \'edit-stock\', {{ json_encode([\'dishId\' => ' . $dish->id . ']) }})',
                    ];
                }),

            Button::add('delete-stock')
                ->bladeComponent('button.circle', function (Dish $dish) {
                    return [
                        'negative'   => true,
                        'icon'       => 'trash',
                        'wire:click' => '$emit(\'openModal\', \'delete-dish\', {{ json_encode([\'dishId\' => ' . $dish->id . ']) }})',
                    ];
                }),
        ];
    }
}
