@extends('admin.layout.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('/custom/css/bootstrap-datepicker.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/custom/css/bootstrap-material-datetimepicker.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/custom/css/style.css') }}"/>
@endsection()
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="header">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h1 class="header-title">
                                {{ $title }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <form class="mb-4 save-form" action="{{ $action }}" method="post" enctype="multipart/form-data">
                @csrf
                @isset($row)
                    @method('put')
                @endisset

                <x-admin.error/>

                @include('admin.' . $model . '.form')

                <div class="col-4 d-flex justify-content-between">
                    <button onclick="$('.save-form').submit()" class="btn w-50 btn-primary" style="margin-right: 5px" type="submit">
                        Сохранить
                    </button>
                    <a href="{{ route('admin.' . $model . '.index') }}"  class="btn w-50 btn-secondary">
                        Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('/custom/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/custom/ckeditor/config.js') }}"></script>
@endpush
