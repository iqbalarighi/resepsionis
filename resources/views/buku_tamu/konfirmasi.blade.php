@extends('layouts.app')

@section('content')
<div class="container" style="background-color: rgb(232 179 179);">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-3">
            <div class="card mb-3">
                <img src="{{asset('storage/img/logo-ojk.png')}}" class="card-img mx-auto p-2" width="300" alt="...">
                <div class="card-title" style="background-color: white;" align="center" > <font size="4"><b>Buku Tamu dan <i>Safety Induction</i> Otoritas Jasa Keuangan (OJK) - Gedung Soemitro Djojohadikusumo</b></font> </div>
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}
                <hr class="m-0"></hr>

                <div class="card-body">

                    Jawaban Bpk/Ibu <b>{{$nama}}</b> telah dicatat. Terima kasih dan selamat datang di Otoritas Jasa Keuangan Gedung Soemitro Djojohadikusumo.
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection