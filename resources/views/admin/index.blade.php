 @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                     <input type="file" jsname="G1bupd" jsaction="JIbuQc:qie3J(PX1Pzd); change:NwEMS(l00Vee)" accept="image/bmp,image/gif,image/heic,image/heif,image/jpeg,image/png,image/tiff,image/vnd.microsoft.icon,image/webp,image/x-ms-bmp,application/vnd.google-apps.folder" style="display: ;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
