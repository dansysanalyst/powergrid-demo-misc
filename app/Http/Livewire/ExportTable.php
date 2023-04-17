<?php
declare(strict_types = 1);

namespace App\Http\Livewire;

use App\Models\Dish;
use Illuminate\Support\Carbon;
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

/**
 * PowerGrid Example
 *
 * @description Export
 *
 * @title Export
 *
 * @route export
 */
final class ExportTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->columnWidth([
                    2 => 30,
                ])
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),

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
            ->addColumn('html_name', function ($dish) {
                return '<b>' . $dish->name . '</b>';
            })
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
                ->hidden()
                ->visibleInExport(true)
                ->sortable(),

            Column::make('Name', 'html_name')
                ->searchable()
                ->visibleInExport(false)
                ->sortable(),

            Column::make('Chef', 'chef_name')
                ->searchable()
                ->sortable(),

            Column::make('Price', 'price')
                ->sortable(),

            Column::make('In Stock', 'in_stock_label')
                ->field('in_stock'),

            Column::make('Created At', 'created_at_formatted'),
        ];
    }

    public function actions(): array
    {
        return [
            Button::add('edit-stock')
                ->caption('<div id="edit">Edit</div>')
                ->class('text-center')
                ->openModal('edit-stock', ['dishId' => 'id']),
        ];
    }
}
