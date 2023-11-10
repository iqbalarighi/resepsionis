<?php

namespace App\Http\Controllers;

use App\Models\BukutamuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Carbon\carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Intervention\Image\Facades\Image as ResizeImage;

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


    public function selfie($id)
    {
       return view('admin.selfie', compact('id'));
    }    

    public function identitas($id)
    {
       return view('admin.identitas', compact('id'));
    }

    public function fotoself(Request $request, $id)
    {
        $iden = BukutamuModel::findOrFail($id);
        $idtamu = $iden->idtamu;

        $img = $request->selfie;
        $folderPath = public_path('storage/buku_tamu/'.$idtamu.'/');
        
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';
        
        $file = $folderPath . $fileName;
        !is_dir($file) && File::makeDirectory($folderPath, $mode = 0777, true, true);
        // Storage::put($file, $image_base64);
        ResizeImage::make($img)
                     ->resize(200, 300)
                     ->save($file);

        $iden->selfie = $fileName;
        $iden->save();

        return redirect('home')
        ->with('success', 'Foto Identitas Tersimpan');
    }

    public function fotoid(Request $request, $id)
    {
        $iden = BukutamuModel::findOrFail($id);
        $idtamu = $iden->idtamu;

        $img = $request->identitas;
        $folderPath = public_path('storage/buku_tamu/'.$idtamu.'/');
        
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';
        
        $file = $folderPath . $fileName;
        !is_dir($file) && File::makeDirectory($folderPath, $mode = 0777, true, true);
        // Storage::put($file, $image_base64);
        ResizeImage::make($img)
                     ->resize(300, 200)
                     ->save($file);

        $iden->identitas = $fileName;
        $iden->save();

        return redirect('home')
        ->with('success', 'Foto Identitas Tersimpan');

    }
}

