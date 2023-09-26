{{-- layouts/profile.blade.phpを読み込む --}}
@extends('layouts.profile')


{{-- profile.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'プロフィール')

{{-- profile.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>myprofile新規作成</h2>
                <form action="{{route('admin.profile.create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">氏名</label>
                        <div class="col-md-10">
                             <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-md-2">性別</label>
                        <div class="col-md-10">
                             <input type="text" class="form-control" name="gender" value="{{ old('gender') }}">
                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-md-2">趣味</label>
                        <div class="col-md-10">
                             <input type="text" class="form-control" name="hobby" value="{{ old('hobby') }}">
                        </div>
                    </div>
                     <div class="form-group row">
                        <label class="col-md-2">自己紹介欄</label>
                        <div class="col-md-10">
                             <input type="text" class="form-control" name="introduction" rows="10" value="{{ old('introduction') }}">
                        </div>
                    </div>
                    @csrf
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
@endsection