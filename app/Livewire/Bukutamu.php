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

    protected $queryString = ['start' => ['except' => ''],'end'  => ['except' => ''],'search'  => ['except' => '']];

    public function render()
    {   
        $search = $this->search;
        $start = $this->start;
        $end = $this->end;
        
        if(!empty($start) && !empty($end) && !empty($search)){

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
            ->paginate(10000000)
            ->appends(request()->input());

        return view('livewire.bukutamu', compact('tamu'));
        } else if(!empty($start) && !empty($end)){
            // dd($start.' '.$end);
            $tamu = BukutamuModel::whereDate('created_at', '>=', $start)
            ->whereDate('created_at', '<=', $end)
            ->latest()->paginate(10000000)
            ->appends(compact('start', 'end'));

        return view('livewire.bukutamu', compact('tamu'));
        } else if(!empty($search)){

           $tamu = BukutamuModel::where('nama_lengkap','like','%'.$this->search.'%')
            ->orWhere('lantai','like','%'.$this->search.'%')
            ->orWhere('institusi','like','%'.$this->search.'%')
            ->latest()->paginate(10000000)
            ->appends(request()->input());

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

    public function updatedEnd(){
        $this->resetPage();
    }


}
