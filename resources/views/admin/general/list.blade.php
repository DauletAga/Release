@extends('admin.layout.layout')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="header">
                <div class="header-body">
                    <x-admin.header :ajax="$ajax_btn??null" :title="$title" :action="route('admin.' . $model . '.create', ['parent_id' => request('parent_id')])" />
                    <x-admin.tab-list :model="$model" />
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="companiesListPane" role="tabpanel" aria-labelledby="companiesListTab">
                    <div class="card" data-list>
                        <x-admin.search-input/>
                        @include('admin.' . $model .'.table')
                        <div class="card-footer d-flex justify-content-between">
                            {{ $row->withQueryString()->links() }}
                            <x-admin.select-action/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
