@extends('layouts.app')


@section('content')
<div class="container">
    <div>
        <label class="btn-lg brand" >الروابط</label>
        <a href="{{route('explore', request()->route('subdomain'))}}" class="mx-4 btn btn-primary" >
            Explore
        </a>
    </div>

    <form action="{{route('add-feature', request()->route('subdomain'))}}" method="POST" enctype="multipart/form-data" >
    {{csrf_field()}}
        <input type="hidden" name="id" value="{{$links == '' ? 0 : $links->id }}" >
        <input type="hidden" name="image_path" value="{{ ($links == '' || $links == null ? '' :  $links->features == null) ? '' : $links->features['bg_image']  }}" >

        <div class="jumbotron  mx-2 my-2 py-2" >
                    <div >
                    <div class="row" >
                        <div class="col-lg-2" >
                            <div class="my-2" >
                                    <label for="">
                                    لون الخلفية
                                    </label>
                                    <div class="form-control d-flex align-items-center">

                                        <input type="radio" value='color' name="selected" {{$links->features['selected'] == $links->features['bg_color'] ? 'checked' : ''  }} >
                                        <input type="color" name="bgColor" id="color" class="input-color" value="{{ ($links == '' ? '' :  $links->features == null) ? '' : $links->features['bg_color']  }}"  placeholder="اللون" required>
                                    </div>
                                    <div class="form-group  my-2  border-radius-10 box-color" style="background-color:{{ $links->features['bg_color']  }}" >

                                    </div>
                            </div>
                        </div>
                        <div class="col-lg-2" >
                                    <div class="my-2"  >
                                    <label for="">
                                        الصورة الخلفية
                                    </label>
                                       <label for="bgImage" class="form-control" >
                                       <input type="radio" value='image' name="selected" {{$links->features['selected'] == $links->features['bg_image'] ? 'checked' : ''  }} >
                                       الصورة

                                                <i class="fa fa-file" ></i>
                                                <input type="file" name="bgImage" id="bgImage" class="col-lg-4 col-sm-12  collapse" placeholder="كتابة الاسم" >

                                       </label>
                                        <div class="form-group  {{ $links->features['bg_image'] == '' ? 'collapse' : ''  }}">

                                            <img src="/{{ (!$links == null ? '' :  $links->features == null) ? '' : $links->features['bg_image']  }}" width="100" height="100" class="border-radius-10" alt="">
                                        </div>
                                    </div>
                        </div>

                        <div class="col-lg-2" style="height: 100px;" >
                            <div class="my-2" >
                                    <label for="">
                                        لون الارتباط
                                    </label>
                                    <div class="form-control d-flex align-items-center">
                                        <input type="color" name="linkColor" id="color" class="input-color" value="{{ ($links == '' ? '' :  $links->features == null) ? '' : ( !isset($links->features['link_color']) ? '' : $links->features['link_color'])  }}"  placeholder="اللون" required>
                                    </div>
                            </div>
                        </div>
                        <div class="col-lg-2" style="height: 100px;" >
                            <div class="my-2" >
                                    <label for="">
                                    لون الاطار
                                    </label>
                                    <div class="form-control d-flex align-items-center">

                                        <input type="checkbox" name="switchFrameColor" id="color" class="input-color" {{ ($links == '' ? '' :  $links->features == null) ? '' : (!isset($links->features['switch_frame_color']) ? '' :  ($links->features['switch_frame_color'] == 'on' ? 'checked' : '' )  )  }}  placeholder="اللون">
                                        <input type="color" name="frameColor" id="color" class="input-color" value="{{ ($links == '' ? '' :  $links->features == null) ? '' : (!isset($links->features['frame_color']) ? '' : $links->features['frame_color'])  }}"  placeholder="اللون" required>
                                    </div>
                            </div>
                        </div>
                    </div>
                    </div>

            <button class="btn btn-primary" >
            إضافة ميزة
            </button>
        </div>
    </form>

    <form action="{{route('add-link', request()->route('subdomain'))}}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="{{$links == '' ? 0 : $links->id }}" >

        <div class="jumbotron mx-2 my-2 py-2" >
        <div class="col-lg-6 col-md-12">
            @include('layouts.messages')
            {{csrf_field()}}
            <div class="form-group">
                <label for="name">اسم </label>
                <input type="text" name="name" id="name" class="form-control" placeholder="كتابة الاسم" required>
            </div>
            <div class="form-group">
                <label for="url">عنوان url </label>
                <input type="text" name="url" id="url" class="form-control" placeholder="عنوان url" required>
            </div>

            <button class="btn btn-primary" >
                Add
             </button>
            </div>
        </div>
    </form>
    @if($links->links)
        <div class="overflow-auto" >
        <table class="table table-bordered" >
            <thead>
                <tr>
                    <td>
                           ID
                    </td>
                    <td>
                          Name
                    </td>
                    <td>
                          Link
                    </td>
                    <td>

                    </td>
                </tr>
            </thead>
            <tbody>
            @if(count((array)json_decode($links->links)) > 0)
                @foreach(json_decode($links->links) as $index=>$link)
                    <tr id="item_{{$index}}" >
                        <td>
                            {{++$index}}
                        </td>
                        <td>
                        {{$link[0]}}
                        </td>
                        <td>
                            <a href="{{$link[1]}}">{{$link[1]}}</a>
                        </td>
                        <td>
                        <button class="btn btn-danger" onclick="deleteItem('{{$index}}','{{$links->id}}')" >
                        حذف
                        </button>
                        </td>

                    </tr>

                @endforeach
            @else
                <tr>
                    <td colspan="3" >
                        no recoreds
                    </td>
                </tr>
            @endif

            </tbody>
        </table>

    </div>
    @endif
</div>
@endsection
<script>
    function deleteItem(id,item_id)
    {
        if (!confirm("Do you want to delete")){
          return ;
        }
        $.ajax({
            url: "/links/delete?id="+id+"&item_id="+item_id,
            type : 'GET',
            success:function(e)
            {
                $("#item_"+id).hide();
                location.reload();
            }
        })

    }
</script>
