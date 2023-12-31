<?php

namespace App\Livewire;

use Illuminate\Support\Facades\File;
use App\Models\BukutamuModel;
use Livewire\Component;
use Carbon\carbon;
use Livewire\WithPagination;

class Bukutamu extends Component
{
    use WithPagination;
    public $search = '';
    public $start = '';
    public $end = '';

    protected $queryString = [
                            'start' => ['except' => ''],
                            'end'  => ['except' => ''],
                            'search'  => ['except' => '']
                        ];
    public $check_id;
    public $delete_id;
    public $identitas_id;
    public $hasto_id;
    // public $identitas_id;

    protected $listeners = [
        'checkConfirmed'=>'checkOut',
        'deleted'=>'hapus',
        'ubah'=>'ubahFo',
        'hapusFoto'=>'hasTo',
        'ubahId'=>'ubahIds',
        'hapusId'=>'hapusIds'
    ];
    
    public function checkConfirm($id)
    {
        $this->check_id = $id;
        $this->dispatch('check-out');
    }

    public function checkOut()
    { 
        $check = BukutamuModel::findOrFail($this->check_id);

        $check->jam_pulang = Carbon::now();
        $check->save();

        $this->dispatch('checked'); 
    }

    public function deleteId($id)
    {
        $this->delete_id = $id;
        $this->dispatch('delete-tamu');
    }

    public function ubahFoto($id)
    {
        $this->identitas_id = $id;
        $this->dispatch('edit-foto');
    }

    public function ubahFo()
    { 
       return redirect('selfie/'.$this->identitas_id);
    }

    public function hapus()
    {
        $delete = BukutamuModel::findOrFail($this->delete_id);
        $idtamu = $delete->idtamu;

        if ($delete->selfie == null){
            $delete->delete();
            $this->dispatch('terhapus');
        } else {

        $del = File::deleteDirectory(public_path('storage/buku_tamu/'.$idtamu));
       
           if ($del == true) {
                $delete->delete();
                $this->dispatch('terhapus');
           } else {
             $message = "Hapus data gagal !!!";
           } 

        }
        
    }

// href="/hapus_foto_selfie/{{$item->id}}" 

    public function hapusTo($id)
    {
        $this->hasto_id = $id;
        $this->dispatch('hapus-foto');
    }

     public function hasTo()
     {  
        $id = $this->hasto_id;
         
            $foto = BukutamuModel::findOrFail($id);
            $idtamu = $foto->idtamu;
            $items = $foto->selfie;

            $dele = File::delete(public_path('storage/buku_tamu/'.$idtamu.'/'.$items));
            $foto->selfie = null;
            $foto->save();

            $this->dispatch('donedel');
     }

     public function ubahIdentitas($id)
     {
        $this->identitas_id = $id;
        $this->dispatch('edit-id');
     }

     public function ubahIds()
     {
         return redirect('identitas/'.$this->identitas_id);
     }

    public function hapusIdentitas($id)
    {
        $this->identitas_id = $id;
        $this->dispatch('hapus-id');
    }

    public function hapusIds()
    {
        $id = $this->identitas_id;
        $foto = BukutamuModel::findOrFail($id);
        $idtamu = $foto->idtamu;
        $items = $foto->identitas;

        $dele = File::delete(public_path('storage/buku_tamu/'.$idtamu.'/'.$items));
        $foto->identitas = null;
        $foto->save();

        $this->dispatch('doneid');
    }

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
