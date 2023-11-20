<?php

namespace App\Livewire;

use App\Models\BukutamuModel;
use Livewire\Component;
use Livewire\WithPagination;

class Bukutamu extends Component
{
    use WithPagination;
    public $search = '';
    public $start = '';
    public $end = '';

    public function render()
    {   
        $search = $this->search;
        $start = $this->start;
        $end = $this->end;
        
        if(!empty($start) && !empty($end) && !empty($search)){
            // dd('1');
            $tamu = BukutamuModel::where('nama_lengkap','like','%'.$this->search.'%')
            ->whereDate('created_at', '>=', $start)
            ->whereDate('created_at', '<=', $end)
            ->orwhere(function ($query) use ($search,$start,$end) {
                        $query->where('lantai','LIKE', '%'.$search.'%')
                            ->whereDate('created_at', '>=', $start)
                            ->whereDate('created_at', '<=', $end);
                    })
                    ->orwhere(function ($querys) use ($search,$start,$end) {
                        $querys->where('institusi','LIKE', '%'.$search.'%')
                            ->whereDate('created_at', '>=', $start)
                            ->whereDate('created_at', '<=', $end);
                    })
            ->latest()
            ->paginate(10000000);
        return view('livewire.bukutamu', compact('tamu'));
        } else if(!empty($start) && !empty($end)){
            // dd('2');
            $tamu = BukutamuModel::whereDate('created_at', '>=', $start)
            ->whereDate('created_at', '<=', $end)
            ->latest()
            ->paginate(10000000);
        return view('livewire.bukutamu', compact('tamu'));
        } else if(!empty($search)){
            // dd('3');
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

    public function updatingSearch(){
        $this->resetPage();
    }

    public function resetFilters(){
        $this->reset(['search', 'start','end']);
    }
}
