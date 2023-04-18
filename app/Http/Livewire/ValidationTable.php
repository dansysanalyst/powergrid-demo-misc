<?php
declare(strict_types = 1);

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Cache, Column, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};
use WireUi\Traits\Actions;

/**
 * PowerGrid Example
 *
 * @description Validation
 *
 * @title Validation
 *
 * @route validation
 */
final class ValidationTable extends PowerGridComponent
{
    use ActionButton;
    use Actions;

    public array $name;

    public bool $showErrorBag = true;

    public string $tableName = 'validationTable';

    protected array $rules = [
        'name.*' => ['required', 'min:6'],
    ];

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        return [
            Cache::make()
                ->forever(),

            Header::make()
                ->showSearchInput(),

            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function onUpdatedEditable(string $id, string $field, string $value): void
    {
        $this->validate();

        User::query()->find($id)->update([
            $field => $value,
        ]);

        $this->notification([
            'title'       => 'Profile saved!',
            'description' => 'Your profile was successfully saved',
            'icon'        => 'success',
            'timeout'     => 3000,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     */
    public function datasource(): ?Builder
    {
        return User::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('email');
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),

            Column::make('NAME', 'name')
                ->sortable()
                ->editOnClick(true)
                ->searchable(),

            Column::make('EMAIL', 'email')
                ->sortable()
                ->searchable(),
        ];
    }
}
