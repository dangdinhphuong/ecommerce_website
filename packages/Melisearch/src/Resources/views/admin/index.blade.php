@extends('admin::layouts.master')

@section('page_title')
    Package Melisearch
@stop

@section('content-wrapper')

    <div class="content full-page dashboard">
        <div class="page-header">
            <div class="page-title">
                <h1>Package Melisearch</h1>
            </div>

            <div class="page-action">
            </div>
        </div>

        <div class="page-content">
        <iframe src="{{env('APP_URL')}}:7700" title="Package Melisearch" style="width:100%; height:770px"></iframe>
        </div>
    </div>

@stop