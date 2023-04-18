<?php
declare(strict_types = 1);

namespace App\Http\Livewire;

use App\Models\Dish;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

final class EditStock extends ModalComponent
{
    use Actions;

    public ?int $dishId = null;

    public bool $inStock = false;

    protected function getRules()
    {
        return [
            'inStock' => 'required|string',
        ];
    }

    public function mount()
    {
        $this->inStock = Dish::query()->find($this->dishId)->in_stock;
    }

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public function cancel()
    {
        $this->closeModal();
    }

    public function confirm()
    {
        Dish::query()->where('id', $this->dishId)
            ->update([
                'in_stock' => $this->inStock,
            ]);

        $this->notification([
            'title'   => 'Dish updated successfully!',
            'icon'    => 'success',
            'timeout' => 2000,
        ]);

        $this->closeModalWithEvents([
            'pg:eventRefresh-default',
        ]);
    }

    public function render()
    {
        return view('livewire.edit-stock');
    }
}
