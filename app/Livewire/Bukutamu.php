<?php

namespace App\Livewire;

use App\Models\BukutamuModel;
use Livewire\Component;
use Livewire\WithPagination;

class Bukutamu extends Component
{
    use WithPagination;
    public $search = '';
    // public $date = '';


    public function render()
    {   
        $search = $this->search;
        // $date = $this->date;
        
        // if(!empty($date)){
        //     dd($date);
        // }

        if(!empty($search)){
           $tamu = BukutamuModel::where('nama_lengkap','like','%'.$this->search.'%')
            ->orWhere('lantai','like','%'.$this->search.'%')
            ->orWhere('institusi','like','%'.$this->search.'%')
            ->latest()->paginate(10000000);

        return view('livewire.bukutamu', compact('tamu'));
        } else {
            $tamu = BukutamuModel::latest()->paginate(10);

        return view('livewire.bukutamu', compact('tamu'));
        }

        
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
