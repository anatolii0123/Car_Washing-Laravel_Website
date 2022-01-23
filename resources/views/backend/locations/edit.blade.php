@extends('layouts.backend.app')

@section('page_vendor_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/plugins/forms/form-quill-editor.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/css/editors/quill/katex.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/css/editors/quill/monokai-sublime.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/css/editors/quill/quill.snow.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/css/editors/quill/quill.bubble.css')}}">
<link rel="preconnect" href="https://fonts.gstatic.com">
@endsection

@section('content')
<div class="content-wrapper location-edit">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Locations</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item active">locations
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section id="basic-tabs-components">
            <input type="hidden" value="{{ $id }}" id="location_id">
            <div class="row match-height">
                <!-- Basic Tabs starts -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" aria-controls="general" role="tab" aria-selected="true">General</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="services-tab" data-toggle="tab" href="#services" aria-controls="services" role="tab" aria-selected="false">Services</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="vehicles-tab" data-toggle="tab" href="#vehicles" aria-controls="services" role="tab" aria-selected="false">Vehicles</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pesubox-tab" data-toggle="tab" href="#pesubox" aria-controls="pesubox" role="tab" aria-selected="false">PesuBox</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="user-tab" data-toggle="tab" href="#user" aria-controls="user" role="tab" aria-selected="false">Users</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="general" aria-labelledby="general-tab" role="tabpanel">
                                    @include('backend.locations.components.general')
                                </div>
                                <div class="tab-pane" id="services" aria-labelledby="services-tab" role="tabpanel">
                                </div>
                                <div class="tab-pane" id="vehicles" aria-labelledby="services-tab" role="tabpanel">
                                </div>
                                <div class="tab-pane" id="pesubox" aria-labelledby="pesubox-tab" role="tabpanel">
                                </div>
                                <div class="tab-pane" id="user" aria-labelledby="user-tab" role="tabpanel">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('page_vendor_js')
<script src="{{asset('assets/backend/app-assets/vendors/js/editors/quill/katex.min.js')}}"></script>
<script src="{{asset('assets/backend/app-assets/vendors/js/editors/quill/highlight.min.js')}}"></script>
<script src="{{asset('assets/backend/app-assets/vendors/js/editors/quill/quill.min.js')}}"></script>
@endsection
