@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(count($errors->all()) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

                <div class="card-header">{{ __('مطعم') }}</div>

                <div class="card-body">
                @include('layouts.messages')

                   <div class="row" >

                   <div class="col-lg-6 col-md-6 col-sm-12  text-right" >
                        <form action="/restaurant-add" class="text-right" method="post" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                            <input type="text" name="name" class="my-4 form-control" value="">
                            <input type="file" name="logo" class="form-control" value="">
                            <input type="submit"  value="حفظ" class="pull-right btn-primary btn my-4" value="">

                        </form>
                    </div>

                   <div class="col-lg-6 col-md-6 col-sm-12  text-right" >

                        @if($restaurant)
                       <div class="text-center" >
                       <h4 class="text-center" > {{$restaurant->name}} </h4>
                        <img src="/{{$restaurant->logo}}" class="image-shadow" width="200" height="200" />
                       </div>
                        @else
                          <h2 class="text-center" >no restaurant yet</h2>
                        @endif
                    </div>


                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
