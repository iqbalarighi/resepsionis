<?php

namespace App\Http\Controllers;

use File;
use Carbon\carbon;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use App\Models\BukutamuModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as ResizeImage;

class Bukutamu extends Controller
{
    public function bukutamu()
    {
       return view('buku_tamu.index');
    }

    public function store(Request $request)
    {
        sleep(3);
      $year = Carbon::now()->format('Y');
      $month = Carbon::now()->format('m');
      $th = Str::substr($year, -2);
      $string = 'TM'.$month.$th.'';
      $idtamu = Helper::IDGenerator(new BukutamuModel, 'idtamu', 4, $string); /** Generate id */

      $store = new BukutamuModel;


          $files = $request->file('selfie');
        if ($files != null) {
                $image_name = md5(rand(10, 100));
                $ext = strtolower($files->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $image_path = public_path('storage/buku_tamu/'.$idtamu.'/');
                $image_url = $image_path.$image_full_name;
                !is_dir($image_url) && File::makeDirectory($image_path, $mode = 0777, true, true);
                ResizeImage::make($files)
                     ->orientate()
                     ->resize(200, 300)
                     ->save($image_path.$image_full_name);
                // $files->move($image_path, $image_full_name);
                $selfie = $image_full_name;

                $store->selfie = $selfie;
        }

        //   $id = $request->file('identitas');
        // if ($id != null) {
        //         $image_name = md5(rand(10, 100));
        //         $ext = strtolower($id->getClientOriginalExtension());
        //         $image_full_name = $image_name.'.'.$ext;
        //         $image_path = public_path('storage/buku_tamu/'.$idtamu.'/');
        //         $image_url = $image_path.$image_full_name;
        //         // !is_dir($image_url) && File::makeDirectory($image_path, $mode = 0777, true, true);
        //         ResizeImage::make($id)
        //              ->resize(300, 200)
        //              ->save($image_path.$image_full_name);
        //         // $files->move($image_path, $image_full_name);
        //         $identitas = $image_full_name;
        // }

      $store->idtamu = $idtamu;
      $store->email = $request->email;
      $store->nama_lengkap = $request->nama;
      $store->institusi = $request->institusi;
      $store->lantai = $request->lantai;
      $store->bertemu_dengan = $request->bertemu_dengan;
      $store->jumlah_tamu = $request->jumlah_tamu;
      $store->kunjungan = $request->kunjungan;
      // $store->identitas = $identitas;
      $store->konfirmasi = $request->confirm8;
      $store->save();

      return redirect('/konfirmasi/'.$request->nama);
    }
    
    public function konfirm($nama)
    {   
        $check = BukutamuModel::where('nama_lengkap', '=', $nama)
                    ->orWhere('created_at', '=', carbon::now())
                    ->exists();
    if ($check) {
        return view('buku_tamu.konfirmasi', compact('nama'));
    } else {
        abort(404);
    }

    }

}

// $path = public_path('images/');
//         !is_dir($path) &&
//             mkdir($path, 0777, true);

//         $name = time() . '.' . $request->image->extension();
//         ResizeImage::make($request->file('image'))
//             ->resize(100, 100)
//             ->save($path . $name);

//         $image = new Image();
//         $image->name = $name;
//         $image->save();