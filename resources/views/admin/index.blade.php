 @extends('layouts.app')

@section('content')
<div class="container">
    <div wire:pool class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Buku Tamu') }}</div>
@if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
@endif


                    <style>
                        .modal {
                        --bs-modal-width: 30% !important;
                    }
                        .table tr td {
                            padding:0.3rem;
                            vertical-align: middle;
                            max-width:100%;
                            white-space:nowrap;
                        }
                        .table th {
                            padding:0.3rem;
                            white-space:normal;
                            vertical-align: middle;
                        }
                    </style>
<style>
.containerx {
  position: relative;
  width: 35%;
}

.image {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}

.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.containerx:hover .image {
  opacity: 0.3;
}

.containerx:hover .middle {
  opacity: 1;
}

.text {
  color: black;
  font-size: 14px;
  padding: auto;
}
</style>
                <div class="card-body">

                </div>
                <livewire:bukutamu></livewire:bukutamu>
                
            </div>

        </div>
    </div>
</div>

@endsection
