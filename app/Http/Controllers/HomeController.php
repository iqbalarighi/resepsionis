<?php

namespace App\Http\Controllers;

use App\Models\BukutamuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Carbon\carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Jenssegers\Agent\Agent;
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
         $count = BukutamuModel::get();
        return view('admin.index', compact('count'));
    }    

    // public function delete($id)
    // {
    //     $delete = BukutamuModel::findOrFail($id);
    //     $idtamu = $delete->idtamu;

    //     if ($delete->selfie == null){
    //         $delete->delete();
    //         $message = 'Data Tamu Sudah Terhapus';
    //     } else {

    //     $del = File::deleteDirectory(public_path('storage/buku_tamu/'.$idtamu));
       
    //        if ($del == true) {
    //             $delete->delete();
    //             $message = 'Daftar Tamu Sudah Terhapus';
    //        } else {
    //          $message = "Hapus data gagal !!!";
    //        } 

    //     }

    //    return back()
    //    ->with('success', $message);
    // }

    // public function checkout($id)
    // {
    //     $check = BukutamuModel::findOrFail($id);

    //     $check->jam_pulang = Carbon::now();
    //     $check->save();

    // $message = "Berhasil";

    //     return back()
    //     ->with('success', $message);
    // }


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
        $agent = new Agent();

        $self = BukutamuModel::findOrFail($id);
        $idtamu = $self->idtamu;

        if ($agent->isDesktop()) {   
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
                         ->resize(600, 800)
                         ->save($file);
        } 

        if($agent->isMobile()) {
            $files = $request->file('selfie');
            $image_name = uniqid();
            $ext = strtolower($files->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $image_path = public_path('storage/buku_tamu/'.$idtamu.'/');
            $image_url = $image_path.$image_full_name;
            !is_dir($image_url) && File::makeDirectory($image_path, $mode = 0777, true, true);
            ResizeImage::make($files)
                 ->resize(600, 800)
                 ->save($image_path.$image_full_name);
            $fileName = $image_full_name;

        }

        $self->selfie = $fileName;
        $self->save();

        return redirect('home')
        ->with('success', 'Foto Identitas Tersimpan');
    }

    public function fotoid(Request $request, $id)
    {
        $agent = new Agent();

        $iden = BukutamuModel::findOrFail($id);
        $idtamu = $iden->idtamu;

        if ($agent->isDesktop()) {   
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
                     ->resize(800, 600)
                     ->save($file);

        }

        if($agent->isMobile()) {

          $id = $request->file('identitas');
                $image_name = uniqid();
                $ext = strtolower($id->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $image_path = public_path('storage/buku_tamu/'.$idtamu.'/');
                $image_url = $image_path.$image_full_name;
                 !is_dir($image_url) && File::makeDirectory($image_path, $mode = 0777, true, true);
                ResizeImage::make($id)
                     ->resize(800, 600)
                     ->save($image_path.$image_full_name);
                
                $fileName = $image_full_name;
        }

        $iden->identitas = $fileName;
        $iden->save();

        return redirect('home')
        ->with('success', 'Foto Identitas Tersimpan');

    }


    // public function delfoto($id)
    // {
    //     $foto = BukutamuModel::findOrFail($id);
    //     $idtamu = $foto->idtamu;
    //     $items = $foto->selfie;

    //     $dele = File::delete(public_path('storage/buku_tamu/'.$idtamu.'/'.$items));
    //     $foto->selfie = null;
    //     $foto->save();


    //     return back()
    //     ->with('success','Hapus Foto Tamu Berhasil');
    // }

    //     public function delid($id)
    // {
    //     $foto = BukutamuModel::findOrFail($id);
    //     $idtamu = $foto->idtamu;
    //     $items = $foto->identitas;

    //     $dele = File::delete(public_path('storage/buku_tamu/'.$idtamu.'/'.$items));
    //     $foto->identitas = null;
    //     $foto->save();


    //     return back()
    //     ->with('success','Hapus Foto Identitas Tamu Berhasil');
    // }


    public function onePDF($start, $end, $search){

            $tamu = BukutamuModel::where('nama_lengkap','like','%'.$search.'%')
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
        
            if ($tamu->count() != null) {
                $pdf = PDF::loadView('admin.savepdf', compact('tamu'))->setPaper('a4', 'landscape');
                if ($start == $end) {
                   return $pdf->stream('Rekap Buku Tamu '.carbon::parse($start)->isoFormat('D MMM YY').'.pdf');
                } else {
                return $pdf->stream('Rekap Buku Tamu '.carbon::parse($start)->isoFormat('D MMM YY').' - '.carbon::parse($end)->isoFormat('D MMM YY').'.pdf');
                }
            } else {
                return redirect('home')
                ->with('danger', 'Tidak ada data tamu yang di Export');
            }
    }


    public function twoPDF($start, $end){

            $tamu = BukutamuModel::whereDate('created_at', '>=', $start)
            ->whereDate('created_at', '<=', $end)
            ->latest()
            ->paginate(10000000);

            if ($tamu->count() != null) {
                $pdf = PDF::loadView('admin.savepdf', compact('tamu'))->setPaper('a4', 'landscape');
                if ($start == $end) {
                   return $pdf->stream('Rekap Buku Tamu '.carbon::parse($start)->isoFormat('D MMM YY').'.pdf');
                } else {
                return $pdf->stream('Rekap Buku Tamu '.carbon::parse($start)->isoFormat('D MMM YY').' - '.carbon::parse($end)->isoFormat('D MMM YY').'.pdf');
                }
                    
            } else {
                return redirect('home')
                ->with('danger', 'Tidak ada data tamu yang di Export');
            }

    }

    public function triPDF($search){

           $tamu = BukutamuModel::where('nama_lengkap','like','%'.$search.'%')
            ->orWhere('lantai','like','%'.$search.'%')
            ->orWhere('institusi','like','%'.$search.'%')
            ->latest()->paginate(10000000);

            if ($tamu->count() != null) {
               $pdf = PDF::loadView('admin.savepdf', compact('tamu'))->setPaper('a4', 'landscape');
                return $pdf->stream('Rekap Buku Tamu.pdf'); 
            } else {
                return redirect('home')
                ->with('danger', 'Tidak ada data tamu yang di Export');
            }

                
    }


}

                