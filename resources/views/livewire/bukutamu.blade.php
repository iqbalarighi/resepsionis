
<div>
 <div class="card-header">{{ __('Buku Tamu') }}
    @if($start != null && $end != null && $search != null)
        <a href="/downloadPDF/{{$start}}/{{$end}}/{{$search}}" target="_blank" class="btn btn-danger btn-sm float-end">Import PDF</a>
    @elseif($start != null && $end != null )
        <a href="/downloadPDF/{{$start}}/{{$end}}" target="_blank" class="btn btn-danger btn-sm float-end">Import PDF</a>
    @elseif($search != null)
        <a href="/downloadPDF/{{$search}}" target="_blank" class="btn btn-danger btn-sm float-end">Import PDF</a>
    @endif
</div>   
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

    <!-- Notifikasi -->
        @if ($message = Session::get('danger'))
            <script type="text/javascript">setTimeout("window.close();", 2500);</script>
            <div id="timeout" align="center" class="alert alert-danger alert-block flex flex-col gap-4 md:flex-row md:items-center md:justify-between" style="width: 80%; margin: 0 auto;" role="alert">
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
     


<div class="row align-items-center mt-2 mx-2" style="float: right;">
    Pilih tanggal : 
    <div class="col col-sm-auto">
            <input type="date" class="form-control" id="start" wire:model.debounce.100ms="start" value="" style="width: 230px;">
    </div>
<div class="col-sm-auto">-</div>
    <div class="col col-sm-auto">
            <input type="date" class="form-control ml-2" id="end" wire:model.debounce.100ms="end" value="" style="width: 230px;">
    </div>
    <div class="col col-sm-auto">
        <input type="text" class="form-control ml-2" id="search" wire:model.debounce.100ms="search" placeholder="Cari..." style="width: 230px;">
        
    </div>
    <div class="col col-sm-auto">
        <span class="btn btn-sm btn-primary ml-2 " wire:click="resetFilters()">Reset</span>
    </div>
  </div>
<br>
<br>
<div class="card-body overflow pt-1" style="overflow-x: auto;" wire:poll.1s>
    <link rel="stylesheet" type="text/css" href="https://w2ui.com/src/w2ui-1.4.2.min.css" />
    <table class="table table-striped table-hover table-sm table-borderless table-responsive" style="">
                        <thead>
                        <tr class="text-center table-info">
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                        @if(Auth::user()->role === "superadmin")
                            <th>Email</th>
                        @endif
                            <th>Perusahaan / Institusi</th>
                            <th>Lantai Tujuan</th>
                            <th>Bertemu Dengan</th>
                            <th>Jumlah Tamu</th>
                            <th>Keperluan</th>
                            <th>Foto Selfie</th>
                            <th>Foto Identitas</th>
                            <th>Waktu Kedatangan</th>
                            <th>Waktu Kepulangan</th>
                        @if(Auth::user()->role === "superadmin")
                            <th>Pilihan</th>
                        @endif
                        </tr>
                        </thead>
                        <tbody>

    @forelse($tamu as $key => $item)
                        <tr>
                            <td>{{$tamu->firstitem() + $key}}</td>
                            <td>{{Carbon\carbon::parse($item->created_at)->isoFormat('D/M/YY')}}</td>
                            <td>{{$item->nama_lengkap}}</td>
                            @if(Auth::user()->role === "superadmin")
                            <td>{{$item->email}}</td>
                            @endif
                            <td style="white-space:normal;">{{$item->institusi}}</td>
                            <td>{{$item->lantai}}</td>
                            <td>{{$item->bertemu_dengan}}</td>
                            <td align="center">{{$item->jumlah_tamu}}</td>
                            <td style="white-space:normal;">{{$item->kunjungan}}</td>

                            <td class="text-center align-middle" valign="middle">
                        @if($item->selfie == null)
                            @if(Auth::user()->role === "superadmin")
                                    <span align="center" onclick="window.location='/selfie/{{$item->id}}'" title="Klik Untuk Upload Foto Personil" class="btn btn-primary btn-sm" style=""><i class="bi bi-camera-fill" style="font-size: 14px; "></i> &nbsp; Ambil Foto </span>
                            @else
                                @if(Carbon\Carbon::now()->isoFormat('D/M/YY') == Carbon\carbon::parse($item->created_at)->isoFormat('D/M/YY'))
                                    <span align="center" onclick="window.location='/selfie/{{$item->id}}'" title="Klik Untuk Upload Foto Personil" class="btn btn-primary btn-sm" style=""><i class="bi bi-camera-fill" style="font-size: 14px; "></i> &nbsp; Ambil Foto </span>
                                @else
                                    <span align="center" title="Klik Untuk Upload Foto Personil" class="btn btn-secondary btn-sm" style="cursor: not-allowed;"><i class="bi bi-camera-fill" style="font-size: 14px; "></i> &nbsp; Ambil Foto </span>
                                @endif
                            @endif
                        @else 
<center>
                        <div class="containerx">
                               <img class="image " id="img{{$item->id}}" src="{{asset('storage/buku_tamu/'.$item->idtamu.'/'.$item->selfie)}}" style="width: 100%;">

                        <div class="middle">
                            <div class="text">
                                <a href="/selfie/{{$item->id}}" title="Ubah Foto" onclick="return confirm('Ubah Foto Tamu?')">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <br>
                                <a href="#" onclick="popup{{$item->id}}()" title="Lihat Foto">
                                    <i class="bi bi-eye-fill" style></i>
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
                            @if(Auth::user()->role === "superadmin")
                            <span align="center" onclick="window.location='/identitas/{{$item->id}}'" title="Klik Untuk Upload Foto Personil" class="btn btn-primary btn-sm" style=""><i class="bi bi-camera-fill" style="font-size: 14px; "></i> &nbsp; Ambil Foto </span>
                            @else
                                @if(Carbon\Carbon::now()->isoFormat('D/M/YY') == Carbon\carbon::parse($item->created_at)->isoFormat('D/M/YY'))
                                    <span align="center" onclick="window.location='/identitas/{{$item->id}}'" title="Klik Untuk Upload Foto Personil" class="btn btn-primary btn-sm" style=""><i class="bi bi-camera-fill" style="font-size: 14px; "></i> &nbsp; Ambil Foto </span>
                                @else
                                    <span align="center"title="Klik Untuk Upload Foto Personil" class="btn btn-secondary btn-sm" style="cursor: not-allowed;"><i class="bi bi-camera-fill" style="font-size: 14px; "></i> &nbsp; Ambil Foto </span>
                                @endif
                            @endif
                            

                        @else
<center>
                        <div class="containery">
                            
                               <img class="image" id="imgs{{$item->id}}" src="{{asset('storage/buku_tamu/'.$item->idtamu.'/'.$item->identitas)}}" style="width: 100%;">

                        <div class="middle">
                            <div class="text">
                                <a href="/identitas/{{$item->id}}" title="Ubah Foto" onclick="return confirm('Ubah Foto Tamu?')">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                 &nbsp;
                                <a href="#" onclick="popupx{{$item->id}}()" title="Lihat Foto">
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
                                    @if(Auth::user()->role === "superadmin")
                                       <center> 
                                            <a href="/home/jam_pulang/{{$item->id}}">
                                                <span class="btn btn-sm btn-primary" onclick="return confirm('Keperluan Tamu Selesai ?')">
                                                    Check Out
                                                </span>
                                            </a>
                                        </center>
                                    @else
                                        @if(Carbon\Carbon::now()->isoFormat('D/M/YY') == Carbon\carbon::parse($item->created_at)->isoFormat('D/M/YY'))
                                            <center> 
                                                <a href="/home/jam_pulang/{{$item->id}}">
                                                    <span class="btn btn-sm btn-primary" onclick="return confirm('Keperluan Tamu Selesai ?')">
                                                        Check Out
                                                    </span>
                                                </a>
                                            </center>
                                        @else
                                            <center> 
                                                    <span class="btn btn-sm btn-secondary " style="cursor: not-allowed;">
                                                        Check Out
                                                    </span>
                                            </center>
                                        @endif
                                        
                                    @endif
                                @else 
                                    {{Carbon\carbon::parse($item->jam_pulang)->isoFormat('HH:mm')}} WIB
                                @endif
                            </td>
                        @if(Auth::user()->role === "superadmin")
                        <td style="vertical-align: middle;">
                        <div class="d-flex align-content-center" >
                        {{-- <a href="{{url('temuan-edit')}}/{{$item->id}}" hidden>
                            <button id="{{$tamu->firstitem() + $key}}" type="submit" title="Edit Data ">
                            </button>
                        </a>
                        <label style="cursor: pointer;" for="{{$tamu->firstitem() + $key}}" title="klik untuk edit laporan" class="bi bi-pencil-fill bg-warning btn btn-sm align-self-center"></label> --}}
                        
                        {{-- <pre> </pre> --}}
                        <form action="{{url('hapus-tamu')}}/{{$item->id}}" method="post" class="align-self-center m-auto">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        <button id="del{{$tamu->firstitem() + $key}}" onclick="return confirm('Yakin data tamu ingin di hapus ?')" type="submit" title="Hapus Data" hidden>
                        </button>
                    <label style="cursor: pointer;" for="del{{$tamu->firstitem() + $key}}" title="klik untuk hapus laporan" class="bi bi-trash-fill bg-danger btn btn-sm align-self-center"></label>
                        </form>
                        
                        </div>

                        </td>
                        @endif
                        </tr>


                        @empty
                        <tr>
                            <td colspan="12" align="center" valign="middle">Oops, yang dicari tidak ditemukan</td>
                        </tr>

                        @endforelse
                        </tbody> 
                    </table>
<script type="text/javascript" src="https://w2ui.com/src/w2ui-1.4.2.min.js"></script>
</div>
 <div class="p-2 mt-2 float-end ">{{$tamu->links()}}</div>
</div>

