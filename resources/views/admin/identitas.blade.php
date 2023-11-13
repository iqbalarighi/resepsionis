@extends('layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Upload Foto Identitas Tamu') }}

                        <a href="{{route('home')}}"><span class="btn btn-primary float-end btn-sm mx-2">Kembali</span></a>
                    
                </div>

                <div class="card-body">
                    <form method="POST" action="{{url('/foto_identitas/'.$id)}}" enctype="multipart/form-data">
                     @csrf
                     @if((new \Jenssegers\Agent\Agent())->isDesktop())
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

                        </div>
                    @endif

                    @if((new \Jenssegers\Agent\Agent())->isMobile())
                    <div style="margin: auto;">
                    <div class="col-md-3 preview">
                        <label for="foto" class="col-md-4 col-form-label text-md-end mt-auto mb-auto"><img id="file-ip-1-preview" class="relative object-cover"></label>
                    </div>
                    <div id="myDIV" >
                        <input type="file" id="foto" class="form-control pb-0 pt-0" name="identitas" accept="image/*" onchange="showPreview(event); " style="display: ;" capture autofocus hidden>
                        <label align="center" for="foto" title="Klik Untuk Upload Foto Personil" class="btn btn-primary" style="margin-top: -30px;"><i class="bi bi-camera-fill" style="font-size: 14px; "></i> &nbsp; Buka Kamera</label>
                    </div>
                    </div>
                    @endif
                            <div class="col-md-12 text-center">
                                <br/>
                                <button id="btn" class="btn btn-success" disabled>Kirim</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if((new \Jenssegers\Agent\Agent())->isDesktop())
<script language="JavaScript">
    Webcam.set({
        width: 335,
        height: 255,
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
@endif

@if((new \Jenssegers\Agent\Agent())->isMobile())
<script type="text/javascript">
  function showPreview(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("file-ip-1-preview");
    var xx = document.getElementById("myDIV");
    preview.src = src;
    preview.style.display = "block";
    preview.style.width = "100px";
    preview.hidden = false;
    xx.style.display = "none";
    document.getElementById('btn').disabled = false;
  }
}
</script> 
@endif
@endsection
