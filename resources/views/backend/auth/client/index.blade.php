@extends('backend.layouts.client.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.users.management'))
<meta name="csrf-token" content="{{ csrf_token() }}">
{{ style(mix('css/multiselect.css')) }}
{{ style(asset('css/custom.css')) }}

@section('content')

    <div class="card" id="app">
        <div class="card-body">
            <!-- Filter Section -->
            @include('backend.layouts.client.filter-section')

            <div id="response" ref="responseid">
                <table class="table-striped table-info table-borderless"
                    data-query-params="queryParams"
                    data-method="get"
                    data-ajax-options="ajaxOptions"
                    data-pagination-pre-text="Previous"
                    data-pagination-next-text="Next"
                    id="table"
                    data-toolbar="#toolbar"
                    data-search="true"
                    data-show-search-clear-button="true"
                    data-show-refresh="true"
                    data-show-toggle="true"
                    data-show-fullscreen="true"
                    data-show-columns="true"
                    data-show-columns-toggle-all="true"
{{--                    data-detail-view="true"--}}
                    data-show-export="true"
                    data-export-data-type="selected"
                    data-export-types="['json', <!--'xml',--> <!--'png',--> 'csv', 'txt', <!--'sql',--> 'doc', 'excel', 'xlsx','pdf']"
                    data-click-to-select="true"
{{--                    data-detail-formatter="detailFormatter"--}}
                    data-minimum-count-columns="2"
{{--                    data-show-pagination-switch="true"--}}
                    data-pagination="true"
                    data-id-field="id"
                    data-page-list="[10, 25, 50, 100, 1000, all]"
{{--                    data-show-footer="true"--}}
                    data-side-pagination=""
                    data-url="filter-clients"
                    data-response-handler="responseHandler">
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th data-field="state" data-visible="false"></th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
                </table>
            </div>
            <!-- View Modal blade template -->
            @include('backend.layouts.client.modal.view-modal')

        </div><!--card-body-->
    </div><!--card-->
@endsection
