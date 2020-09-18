@extends('backend.layouts.client.app-advanced')

@section('title', app_name() . ' | ' . __('labels.backend.access.users.management'))
<meta name="csrf-token" content="{{ csrf_token() }}">
{{ style(mix('css/multiselect.css')) }}
{{ style(asset('css/custom.css')) }}

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.categories-tags.management') }} <small
                            class="text-muted">{{ __('labels.backend.access.categories-tags.update') }}</small>
                    </h4>
                </div>
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->

    <!-- Categories Section -->
    <div class="row" id="app">
        <div class="col-sm-6">
            <div class="card-transparent">
                <div class="card-header">
                    <h2>Categories</h2>
                </div>
                <div class="card-body-light">
                    <vue-categories-management></vue-categories-management>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card-transparent">
                <div class="card-header">
                    <h2>Tags</h2>
                </div>
                <div class="card-body-light">
                    <vue-tags-management></vue-tags-management>
                </div>
            </div>
        </div>
    </div>

    <!-- Tags Section -->
    <div id="particles-js"></div>

@endsection
