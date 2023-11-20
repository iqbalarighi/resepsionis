<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', 'Resepsionis') }}</title>
        <style type="text/css">
@page {
    size: a4 landscape;
}
            .break {
               page-break: auto;
               page-break-inside: auto;
               page-break-before: auto;
               page-break-after: auto;
            }
            th {
                padding-left: 0.1rem;
                padding-right: 0.1rem;
            }
    td {vertical-align: middle;}
    table, th, tr, td {
        font-size: 10.5pt;
        border: 1px solid black;
        border-collapse: collapse;
        padding: 0.1rem;
    }
.footer {
    width: 100%;
    position: fixed;
    bottom: -90px;
    left: 0px;
    right: 0px;
    height: 100px;
    color: gray;
    text-align: right;
    font-size: 13px;
    line-height: 7px;
    border-top: 1px solid grey;
}
.pagenum:before {
        content: counter(page);
}
</style>

    </head>
<body>
                <div>
                    <img src="{{public_path('storage/img/logo-ojk.png')}}" style="margin-top: 0px; width: 150px; position: fixed;">
                    <h4>
                        <b><center>Rekap Buku Tamu <br>Otoritas Jasa Keuangan Soemitro</center></b>
                    </h4>
                </div>
<table width="100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                        @if(Auth::user()->role === "superadmin")
                            <th>Email</th>
                        @endif
                            <th>Perusahaan / Institusi</th>
                            <th>Lantai Tujuan</th>
                            <th>Bertemu Dengan</th>
                            <th width="40px">Jumlah Tamu</th>
                            <th>Keperluan</th>
                            <th width="55px">Foto Selfie</th>
                            <th>Foto<br>Identitas</th>
                            <th width="80px">Waktu Kedatangan</th>
                            <th width="80px">Waktu Kepulangan</th>
                        </tr>
                        </thead>
                        <tbody>
                            
    @foreach($tamu as $key => $item)
                        <tr class="break">
                            <td align="center">{{$tamu->firstitem() + $key}}</td>
                            <td>{{Carbon\carbon::parse($item->created_at)->isoFormat('D/M/YY')}}</td>
                            <td>{{$item->nama_lengkap}}</td>
                            @if(Auth::user()->role === "superadmin")
                            <td>{{$item->email}}</td>
                            @endif
                            <td>{{$item->institusi}}</td>
                            <td>{{$item->lantai}}</td>
                            <td>{{$item->bertemu_dengan}}</td>
                            <td align="center">{{$item->jumlah_tamu}}</td>
                            <td style="white-space:normal;">{{$item->kunjungan}}</td>
                            <td>
                                <center>
                        @if($item->selfie == null)
                            <img src="{{public_path('storage/img/no-image.png')}}" style="width: 53px; ">
                        @else 
                        <div>
                               <img src="{{public_path('storage/buku_tamu/'.$item->idtamu.'/'.$item->selfie)}}" style="width: 53px;">
                        </div>
                        @endif
                    </center>
                            </td>

                            <td>
                                <center>
                        @if($item->identitas == null)
                        <img src="{{public_path('storage/img/no-id.svg')}}" style="width: 80px; ">
                        @else

                        <div>
                               <img src="{{public_path('storage/buku_tamu/'.$item->idtamu.'/'.$item->identitas)}}" style="width: 80px;">
                        </div>


                        @endif
                        </center>
                            </td>

                            <td align="center">{{Carbon\carbon::parse($item->created_at)->isoFormat('HH:mm')}} WIB</td>
                            <td align="center">
                                @if($item->jam_pulang == null)
                                    -
                                @else 
                                    {{Carbon\carbon::parse($item->jam_pulang)->isoFormat('HH:mm')}} WIB
                                @endif
                            </td>

                        </tr>

                        @endforeach
                        </tbody> 
                    </table>
        <footer class="footer" >
           <p class="pr-3 m-0 text-end "><i>Tanggal Cetak : {{ date('d-m-Y H:i')}}</i>&nbsp; | &nbsp;<span class="pagenum"></span> </p>
        </footer>
                </body>

                </html>