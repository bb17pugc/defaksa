@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                غير كلمة السر
                </div>

                <div class="card-body">
                @include('layouts.messages')

<br>
<br>
@foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                         @endforeach

                    <form method="POST" action="{{ route('store-details') }}">
                        @csrf


                         <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">
                            اسم
                        </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{Auth::user()->name}}" autocomplete="email">
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">
                            البريد الإلكتروني
                        </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" value="{{Auth::user()->email}}" name="email" autocomplete="email">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                تحديث                                </button>
                            </div>
                        </div>

                        </form>
                        <br>
                        <form method="POST" action="{{ route('change.password') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">
                            كلمة المرور الحالية
                        </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">كلمة السر الجديدة</label>

                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">
                            تأكيد كلمة المرور الجديدة

                            </label>

                            <div class="col-md-6">
                                <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                تحديث
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
