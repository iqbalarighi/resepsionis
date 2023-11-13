<div>
    <!-- Notifikasi -->
        @if ($message = Session::get('success'))
            <div id="timeout" align="center" class="alert alert-success alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between" style="width: 80%; margin: 0 auto;" role="alert">
                <div class="row">
                    <div class="col">
        <div class="card-text" align="center">
                    {{ $message }}
        </div>
                    </div>
                    <div class="col-md-auto">
        <div style="float: right;">
        <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close" align="right"></button>
        </div>                
                    </div>
                </div>
            </div>
        @endif
    <!-- Notifikasi -->
<div class="card-body overflow" style="overflow-x: auto;" wire:poll.5s>
    <table class="table table-striped table-hover table-sm table-borderless table-responsive" style="">
                        <thead>
                        <tr class="text-center table-info">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Perusahaan / Institusi</th>
                            <th>Lantai Tujuan</th>
                            <th>Keperluan</th>
                            <th>Foto Selfie</th>
                            <th>Foto Identitas</th>
                            <th>Waktu Kedatangan</th>
                            <th>Waktu Kepulangan</th>
                            <th>Pilihan</th>
                        </tr>
                        </thead>
                        <tbody>
    @foreach($tamu as $key => $item)
                        <tr>
                            <td>{{$tamu->firstitem() + $key}}</td>
                            <td>{{$item->nama_lengkap}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->institusi}}</td>
                            <td>{{$item->lantai}}</td>
                            <td style="white-space:normal;">{{$item->kunjungan}}</td>

                            <td class="text-center align-middle" valign="middle">
                        @if($item->selfie == null)
                        {{-- <button class="btn"></button> --}}
                        <span align="center" onclick="window.location='/selfie/{{$item->id}}'" title="Klik Untuk Upload Foto Personil" class="btn btn-primary btn-sm" style=""><i class="bi bi-camera-fill" style="font-size: 14px; "></i> &nbsp; Ambil Foto </span>
                        @else 
                        {{-- <a href="{{ URL::asset('storage/buku_tamu/'.$item->idtamu.'/'.$item->selfie) }}" target="_blank">
                            <img data-toggle="modal"  src="{{ URL::asset('storage/buku_tamu/'.$item->idtamu.'/'.$item->selfie) }}" width="30" height="40">
                        </a>  --}}

<center>
                        <div class="containerx">
                            
                               <img class="image " src="{{asset('storage/buku_tamu/'.$item->idtamu.'/'.$item->selfie)}}" style="width: 100%;">

                        <div class="middle">
                            <div class="text">
                                <a href="/selfie/{{$item->id}}" title="Ubah Foto" onclick="return confirm('Ubah Foto Tamu?')">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <br>
                                <a href="{{ URL::asset('storage/buku_tamu/'.$item->idtamu.'/'.$item->selfie) }}" title="Lihat Foto" target="_blank">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <br>
                                <a href="/hapus_foto_selfie/{{$item->id}}" title="Hapus Foto" onclick="return confirm('Hapus Foto Tamu?')">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                            </div>
                        </div>
                        </div>
</center>
                        @endif
                            </td>

                            <td class="text-center">
                        @if($item->identitas == null)
                        <span align="center" onclick="window.location='/identitas/{{$item->id}}'" title="Klik Untuk Upload Foto Personil" class="btn btn-primary btn-sm" style=""><i class="bi bi-camera-fill" style="font-size: 14px; "></i> &nbsp; Ambil Foto </span>
                        @else
<center>
                        <div class="containerx">
                            
                               <img class="image " src="{{asset('storage/buku_tamu/'.$item->idtamu.'/'.$item->identitas)}}" style="width: 100%;">

                        <div class="middle">
                            <div class="text">
                                <a href="/identitas/{{$item->id}}" title="Ubah Foto" onclick="return confirm('Ubah Foto Tamu?')">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                 &nbsp;
                                <a href="{{ URL::asset('storage/buku_tamu/'.$item->idtamu.'/'.$item->identitas) }}" title="Lihat Foto" target="_blank">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                 &nbsp;
                                <a href="/hapus_foto_id/{{$item->id}}" title="Hapus Foto" onclick="return confirm('Hapus Foto Tamu?')">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                            </div>
                        </div>
                        </div>
</center>                          
                        @endif

                            </td>

                            <td>{{Carbon\carbon::parse($item->created_at)->isoFormat('HH:mm')}} WIB</td>
                            {{-- <td>{{$item->jam_pulang}}</td> --}}
                            <td class="text-center">
                                @if($item->jam_pulang == null)
                                {{-- <button class="btn btn-primary btn-sm">Check Out</button> --}}
                            
                               <center> <a href="/home/jam_pulang/{{$item->id}}"><span class="btn btn-sm btn-primary" onclick="return confirm('Keperluan Tamu Selesai ?')">Check Out</span></a></center>
                            
                                @else 
                                {{Carbon\carbon::parse($item->jam_pulang)->isoFormat('HH:mm')}} WIB
                                @endif
                            </td>
                        <td style="vertical-align: middle;">
                        <div class="d-flex align-content-center" >
                        {{-- <a href="{{url('temuan-edit')}}/{{$item->id}}" hidden>
                            <button id="{{$tamu->firstitem() + $key}}" type="submit" title="Edit Data ">
                            </button>
                        </a>
                        <label style="cursor: pointer;" for="{{$tamu->firstitem() + $key}}" title="klik untuk edit laporan" class="bi bi-pencil-fill bg-warning btn btn-sm align-self-center"></label> --}}
                        @if(Auth::user()->role === "superadmin")
                        {{-- <pre> </pre> --}}
                        <form action="{{url('hapus-tamu')}}/{{$item->id}}" method="post" class="align-self-center m-auto">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        <button id="del{{$tamu->firstitem() + $key}}" onclick="return confirm('Yakin nih Laporan mau di hapus ?')" type="submit" title="Hapus Data" hidden>
                        </button>
                    <label style="cursor: pointer;" for="del{{$tamu->firstitem() + $key}}" title="klik untuk hapus laporan" class="bi bi-trash-fill bg-danger btn btn-sm align-self-center"></label>
                        </form>
                        @endif
                        </div>

                        </td>
                        </tr>
                        @endforeach
                        </tbody> 
                    </table>
</div>
 <div class="p-2 mt-2 float-end">{{$tamu->links()}}</div>
</div>
