@extends('layouts.app')
@section('content')
<button class="btn btn-primary w-25" id="print-qr">طباعة</button>
            <button class="btn btn-primary w-25" onclick="doCapture()" id="download">تحميل</button>

    <div class="container py-2"  id="containerQrCode" >


        <div class="text-center" >
            <img id="linkLogo" class="image-shadow link-logo logo-qr" src="/{{$rastuarant->logo}}" alt="logo" width="150px" height="150px">
        </div>

        <div class="d-grid justify-content-center align-items-center " id="qr-code">

        <h1 class="text-center my-2" ><b>المنيو الالكتروني</b></h1>
                <div class="box-qr" >
                {!! $QRCode !!}
                </div>
        </div>
    </div>
@endsection
    <script src="{{asset('/js/html2canvas.js')}}"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script>
        function printContent(el) {
            let restorePage = $('body').html();
            let printDiv = $('#' + el).clone();
            $('body').empty().html(printDiv);
            window.print();
            $('body').html(restorePage);
        }

        $(document).ready(function(){
            $("#print-qr").on('click',function(){
                printContent('qr-code');
            })
        })

        function doCapture() {
            window.scrollTo(0, 0);

            html2canvas(document.getElementById("containerQrCode")).then(function (canvas) {

                image = canvas.toDataURL("image/jpeg", 0.9)
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                // Create an AJAX object
                $.ajax({
                    type:'POST',
                    url : '/save-qr',
                    data : {image : image,_token: CSRF_TOKEN,},
                    success:function(res){

                            window.location.href = window.location.origin+"/"+res;
                    }
                })
            });
        }

    </script>
