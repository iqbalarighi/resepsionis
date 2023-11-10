<?php

namespace App\Livewire;

use App\Models\BukutamuModel;
use Livewire\Component;
use Livewire\WithPagination;

class Bukutamu extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.bukutamu', [
            'tamu' => BukutamuModel::latest()->paginate(5),
        ]);
    }
}
