@extends('layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{url('/foto_identitas/'.$id)}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div id="my_camera"></div>
                <br/>
                <input type=button value="Take Snapshot" onClick="take_snapshot()">
                <input type="hidden" name="identitas" class="image-tag">
            </div>
            <div class="col-md-6">
                <div id="results"></div>
            </div>
            <div class="col-md-12 text-center">
                <br/>
                <button id="btn" class="btn btn-success" disabled>Submit</button>
            </div>
        </div>
    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script language="JavaScript">
    Webcam.set({
        width: 260,
        height: 350,
        image_format: 'jpeg',
        jpeg_quality: 100
    });
    
    Webcam.attach( '#my_camera' );
    
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
            document.getElementById('btn').disabled = false;
        } );
    }
</script>
@endsection
