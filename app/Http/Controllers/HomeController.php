<?php

namespace App\Http\Controllers;

use App\Models\BukutamuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Carbon\carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $tamu = BukutamuModel::paginate(5);

        return view('admin.index');
    }    

    public function delete($id)
    {
        $delete = BukutamuModel::findOrFail($id);
        $idtamu = $delete->idtamu;

        if ($delete->selfie == null){
            $delete->delete();
            $message = 'Data Tamu Sudah Terhapus';
        } else {

        $del = File::deleteDirectory(public_path('storage/buku_tamu/'.$idtamu));
       
           if ($del == true) {
                $delete->delete();
                $message = 'Daftar Tamu Sudah Terhapus';
           } else {
             $message = "Hapus data gagal !!!";
           } 

        }

       return back()
       ->with('success', $message);
    }

    public function checkout($id)
    {
        $check = BukutamuModel::findOrFail($id);

        $check->jam_pulang = Carbon::now();
        $check->save();

    $message = "Berhasil";

        return back()
        ->with('success', $message);
    }


    public function selfie()
    {
       return view('admin.selfie');
    }
}
