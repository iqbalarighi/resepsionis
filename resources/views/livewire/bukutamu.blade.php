
<div>
 <div class="card-header fs-5 fw-bold">{{ __('Buku Tamu') }}
    @if($start != null && $end != null && $search != null)
        @if($tamu->count() != null)
            <a href="/downloadPDF/{{$start}}/{{$end}}/{{$search}}" target="_blank" class="btn btn-danger btn-sm float-end">Import PDF</a>
        @endif
    @elseif($start != null && $end != null )
        @if($tamu->count() != null)
            <a href="/downloadPDF/{{$start}}/{{$end}}" target="_blank" class="btn btn-danger btn-sm float-end">Import PDF</a>
        @endif
    @elseif($search != null)
        @if($tamu->count() != null)
            <a href="/downloadPDF/{{$search}}" target="_blank" class="btn btn-danger btn-sm float-end">Import PDF</a>
        @endif
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
     


<div class="row row-cols-1 align-items-center my-1 mx-2" style="float: right;">
    <div class="col col-sm-auto px-0 mt-2">Pilih tanggal : &nbsp;</div> <br>
    <div class="col col-sm-auto px-0 mt-2">
            <input type="date" class="form-control" id="start" wire:model.debounce.100ms="start" value="" style="width: 230px;">
    </div>
    <div class="col col-sm-auto p-0 m-0">-</div>
    <div class="col col-sm-auto px-0 mt-2">
            <input type="date" class="form-control ml-2" id="end" wire:model.debounce.100ms="end" value="" style="width: 230px;">
    </div>
    <div class="col col-sm-auto mt-2">
        <input type="text" class="form-control ml-2" id="search" wire:model.debounce.100ms="search" placeholder="Cari..." style="width: 230px;">
        
    </div>
    <div class="col col-sm-auto m-0 py-0">
        <span class="btn btn-sm btn-primary px-0 " wire:click="resetFilters()">Reset</span>
    </div>
  </div>
<br>
<br>
<div class="card-body overflow pt-1" style="overflow-x: auto;" wire:poll.2s>
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
                            <th width="60px">Foto Selfie</th>
                            <th width="110px">Foto Identitas</th>
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
                            <td style="white-space:normal;">{{$item->bertemu_dengan}}</td>
                            <td align="center">{{$item->jumlah_tamu}}</td>
                            <td style="white-space:normal;">{{$item->kunjungan}}</td>

                            <td class="text-center align-middle p-1" valign="middle">
                        @if($item->selfie == null)
                            @if(Auth::user()->role === "superadmin")
                                    <span align="center" onclick="window.location='/selfie/{{$item->id}}'" title="Klik untuk upload foto tamu" class="btn btn-primary btn-sm" style=""><i class="bi bi-camera-fill" style="font-size: 14px; "></i> </span>
                            @else
                                @if(Carbon\Carbon::now()->isoFormat('D/M/YY') == Carbon\carbon::parse($item->created_at)->isoFormat('D/M/YY'))
                                    <span align="center" onclick="window.location='/selfie/{{$item->id}}'" title="Klik untuk upload foto tamu" class="btn btn-primary btn-sm" style=""><i class="bi bi-camera-fill" style="font-size: 14px; "></i> </span>
                                @else
                                    <span align="center" title="Klik untuk upload foto tamu" class="btn btn-secondary btn-sm" style="cursor: not-allowed;"><i class="bi bi-camera-fill" style="font-size: 14px; "></i>  </span>
                                @endif
                            @endif
                        @else 
<center>
                        <div class="containerx">
                               <img class="image " id="img{{$item->id}}" src="{{asset('storage/buku_tamu/'.$item->idtamu.'/'.$item->selfie)}}" style="width: 100%;">

                        <div class="middle">
                            <div class="text">
                                <a href="javascript:void(0)" wire:click.prevent='ubahFoto({{$item->id}})' title="Ubah Foto">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <br>
                                <a href="javascript:void(0)" onclick="popup{{$item->id}}()" title="Lihat Foto">
                                    <i class="bi bi-eye-fill" style></i>
                                </a>
                                <br>
                                <a href="javascript:void(0)" wire:click.prevent='hapusTo({{$item->id}})' title="Hapus Foto" >
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                            </div>
                        </div>
                        </div>
</center>

                        @endif
<script>
        window.addEventListener('edit-foto', event =>{
        Swal.fire({
                  title: "Ubah Foto Tamu ?",
                  text: "Ubah / Ganti foto tamu ?",
                  icon: "question",
                  showCancelButton: true,
                  confirmButtonColor: "#3085d6",
                  cancelButtonColor: "#d33",
                  cancelButtonText: "Batal",
                  confirmButtonText: "Okay"
                }).then((result) => {
                  if (result.isConfirmed) {
                    Livewire.dispatch('ubah')
                  }
                });
    });

        window.addEventListener('hapus-foto', event =>{
        Swal.fire({
                  title: "Hapus Foto Tamu ?",
                  text: "Yakin foto tamu ingin di hapus ?",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#3085d6",
                  cancelButtonColor: "#d33",
                  cancelButtonText: "Batal",
                  confirmButtonText: "Okay"
                }).then((result) => {
                  if (result.isConfirmed) {
                    Livewire.dispatch('hapusFoto')
                  }
                });
    });

        window.addEventListener('donedel', event =>{
        Swal.fire({
          title: "Berhasil",
          text:  "Foto tamu telah terapus !",
          icon: "success",
          showConfirmButton: false,
          timer: 1500
        });
    });
</script>
                            </td>

                            <td class="text-center align-middle p-1">
                        @if($item->identitas == null)
                            @if(Auth::user()->role === "superadmin")
                            <span align="center" onclick="window.location='/identitas/{{$item->id}}'" title="Klik untuk upload identitas tamu" class="btn btn-primary btn-sm" style=""><i class="bi bi-camera-fill" style="font-size: 14px; "></i> </span>
                            @else
                                @if(Carbon\Carbon::now()->isoFormat('D/M/YY') == Carbon\carbon::parse($item->created_at)->isoFormat('D/M/YY'))
                                    <span align="center" onclick="window.location='/identitas/{{$item->id}}'" title="Klik untuk upload identitas tamu" class="btn btn-primary btn-sm" style=""><i class="bi bi-camera-fill" style="font-size: 14px; "></i>  </span>
                                @else
                                    <span align="center"title="Klik untuk upload identitas tamu" class="btn btn-secondary btn-sm" style="cursor: not-allowed;"><i class="bi bi-camera-fill" style="font-size: 14px; "></i> </span>
                                @endif
                            @endif
                            

                        @else
<center>
                        <div class="containery">
                            
                               <img class="image" id="imgs{{$item->id}}" src="{{asset('storage/buku_tamu/'.$item->idtamu.'/'.$item->identitas)}}" style="width: 100%;">

                        <div class="middle">
                            <div class="text">
                                <a href="javascript:void(0)" wire:click.prevent='ubahIdentitas({{$item->id}})' title="Ubah Foto">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                {{-- href="/identitas/{{$item->id}}"  --}}
                                 &nbsp;
                                <a href="javascript:void(0)" onclick="popupx{{$item->id}}()" title="Lihat Foto">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                 &nbsp;
                                <a href="javascript:void(0)" wire:click.prevent='hapusIdentitas({{$item->id}})' title="Hapus Foto" >
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                            </div>
                        </div>
                        </div>
</center>

                        @endif
<script>
        window.addEventListener('edit-id', event =>{
        Swal.fire({
                  title: "Ubah Identitas Tamu ?",
                  text: "Ubah / Ganti identitas tamu ?",
                  icon: "question",
                  showCancelButton: true,
                  confirmButtonColor: "#3085d6",
                  cancelButtonColor: "#d33",
                  cancelButtonText: "Batal",
                  confirmButtonText: "Okay"
                }).then((result) => {
                  if (result.isConfirmed) {
                    Livewire.dispatch('ubahId')
                  }
                });
    });

        window.addEventListener('hapus-id', event =>{
        Swal.fire({
                  title: "Hapus Foto Identitas Tamu ?",
                  text: "Yakin foto identitas tamu ingin di hapus ?",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#3085d6",
                  cancelButtonColor: "#d33",
                  cancelButtonText: "Batal",
                  confirmButtonText: "Okay"
                }).then((result) => {
                  if (result.isConfirmed) {
                    Livewire.dispatch('hapusId')
                  }
                });
    });

        window.addEventListener('doneid', event =>{
        Swal.fire({
          title: "Berhasil",
          text:  "Foto tamu telah terapus !",
          icon: "success",
          showConfirmButton: false,
          timer: 1500
        });
    });
</script>
                            </td>

                            <td>{{Carbon\carbon::parse($item->created_at)->isoFormat('HH:mm')}} WIB</td>
                            {{-- <td>{{$item->jam_pulang}}</td> --}}

                            <td class="text-center">
                                @if($item->jam_pulang == null)
                                    @if(Auth::user()->role === "superadmin")
                                       <center> 
                                            <a href="javascript:void(0)" wire:click.prevent='checkConfirm({{$item->id}})' class="btn btn-sm btn-primary">
                                                {{-- <span c onclick="return confirm('Keperluan Tamu Selesai ?')">
                                                    
                                                </span> --}}
                                                Check Out
                                            </a>
                                        </center>
                                    @else
                                        @if(Carbon\Carbon::now()->isoFormat('D/M/YY') == Carbon\carbon::parse($item->created_at)->isoFormat('D/M/YY'))
                                            <center> 
                                                <a href="/home/jam_pulang/{{$item->id}}" wire:click.prevent='checkConfirm({{$item->id}})' class="btn btn-sm btn-primary">
                                                    {{-- <span  onclick="return confirm('Keperluan Tamu Selesai ?')">
                                                    </span> --}}
                                                    Check Out
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
                        <td style="vertical-align: middle;" align="center">
                        
                        {{-- <a href="{{url('temuan-edit')}}/{{$item->id}}" hidden>
                            <button id="{{$tamu->firstitem() + $key}}" type="submit" title="Edit Data ">
                            </button>
                        </a>
                        <label style="cursor: pointer;" for="{{$tamu->firstitem() + $key}}" title="klik untuk edit laporan" class="bi bi-pencil-fill bg-warning btn btn-sm align-self-center"></label> --}}
                        
                        {{-- <pre> </pre> --}}
                        {{-- <form action="{{url('hapus-tamu')}}/{{$item->id}}" method="post" class="align-self-center m-auto">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        <button id="del{{$tamu->firstitem() + $key}}" onclick="return confirm('Yakin data tamu ingin di hapus ?')" type="submit" title="Hapus Data" hidden>
                        </button>
                    <label style="cursor: pointer;" for="del{{$tamu->firstitem() + $key}}" title="klik untuk hapus laporan" class="bi bi-trash-fill bg-danger btn btn-sm align-self-center"></label>
                        </form> --}}
                        <a href="javascript:void(0)" wire:click.prevent='deleteId({{$item->id}})' class="bi bi-trash-fill bg-danger btn btn-sm align-self-center" style="color: white;"></a>
                        

                        </td>
                        @endif
                        </tr>


                        @empty
                        <tr>
                            <td colspan=" {{ Auth::user()->role === "superadmin" ? '14' : '12' }}" align="center" valign="middle">Oops, yang dicari tidak ditemukan</td>
                        </tr>

                        @endforelse
                        </tbody> 
                    </table>
<script type="text/javascript" src="https://w2ui.com/src/w2ui-1.4.2.min.js"></script>
</div>
 <div class="p-2 mt-2 float-end">{{$tamu->onEachSide(1)->links()}}</div>
</div>

