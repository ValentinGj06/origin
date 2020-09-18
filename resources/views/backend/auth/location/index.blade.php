@extends('backend.layouts.location.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.users.management'))
<meta name="csrf-token" content="{{ csrf_token() }}">
{{ style(mix('css/multiselect.css')) }}
{{ style(asset('css/custom.css')) }}
<style type="text/css">

/*.datefilter {
    position: relative;
    z-index: 2;
    padding: 0 0 0 5px;
    text-align: left !important;
    border-radius: 0 10px 10px 0 !important;
    border: 0;
    background: #fff;
    font-size: 14px;
    min-height: 44px;
    width: 80%;
    box-shadow: 0 4px 16px 0 rgba(22, 42, 90, 0.12);
    transition: box-shadow 0.3s ease;
}
.datefilter::placeholder {
    color: #99A3BA;
}
.datefilter-prepend {
    border-radius: 10px 0 0 10px !important;
}*/

.table-responsive {
    max-height: 75vh;
    white-space: nowrap;
}

.table-responsive th:last-of-type, .table-responsive td:last-of-type {
    padding-right: 22px !important;
}

.table-responsive thead th {
    vertical-align: middle !important;
}

.table-responsive tr:nth-of-type(1) th:first-of-type {
    left: 0;
    position: sticky;
    z-index: 3;
}

.table-responsive tr:nth-child(even) {
  background: rgb(60, 108, 147);
}


.table-responsive th {
    background: rgba(30, 75, 112);
    position: sticky;
    top: 0;
    outline: solid 2px;
    outline-offset: -1px;
}

.table-responsive tr:nth-of-type(1) th{
    position: sticky;
    top: 0;
    z-index: 2;
}

.table-responsive tr:nth-of-type(2) th{
    position: sticky;
    top: 45px;
    z-index: 2;
    background: rgba(47, 53, 58);
}

.table-responsive tr:nth-of-type(3) th{
    position: sticky;
    top: 90px;
    z-index: 2;
}

.table-responsive tr:nth-of-type(3) th:first-of-type {
    left: 0;
    position: sticky;
    z-index: 3;
    background: rgba(47, 53, 58);
}

.table-responsive tr:nth-of-type(3) th:nth-of-type(2) {
    left: 89px;
    position: sticky;
    z-index: 3;
}

.table-responsive tr:nth-of-type(3) th:nth-of-type(3) {
    left: 289px;
    position: sticky;
    z-index: 3;
    background: rgba(47, 53, 58);
}

.table-responsive tr:nth-of-type(3) th:nth-of-type(4) {
    left: 368px;
    position: sticky;
    z-index: 3;
}

.table-responsive td:first-of-type {
    left: 0;
    position: sticky;
    outline: solid 2px;
    outline-offset: -1px;
}

.table-responsive td:nth-of-type(2) {
    left: 89px;
    position: sticky;
    outline: solid 2px;
    outline-offset: -1px;
}

.table-responsive td:nth-of-type(3) {
    left: 289px;
    position: sticky;
    outline: solid 2px;
    outline-offset: -1px;
}

.table-responsive td:nth-of-type(4) {
    left: 368px;
    position: sticky;
    outline: solid 2px;
    outline-offset: -1px;
}


.table-responsive tr:nth-child(even) td:first-of-type, .table-responsive tr:nth-child(even) td:nth-of-type(2), .table-responsive tr:nth-child(even) td:nth-of-type(3), .table-responsive tr:nth-child(even) td:nth-of-type(4) {
    background: rgba(30, 75, 112);
    z-index: 1;
}

.table-responsive tr:nth-child(odd) td:first-of-type, .table-responsive tr:nth-child(odd) td:nth-of-type(2), .table-responsive tr:nth-child(odd) td:nth-of-type(3), .table-responsive tr:nth-child(odd) td:nth-of-type(4) {
    background: rgba(47, 53, 58);
    z-index: 1;
}

.region {
}

.region td{
    position: sticky;
    bottom: 0;
}

.table-responsive .region td:first-of-type {
    position: sticky;
    left: 0;
    z-index: 2;
}

.table-responsive .region td:nth-of-type(2), .table-responsive .region td:nth-of-type(3), .table-responsive .region td:nth-of-type(4) {
    outline: 0;
    left: unset;
    z-index: 0 !important;
}

.total {
    background: rgba(58, 63, 68);
}

.total td{
    position: sticky;
    bottom: 0;
    background: #90903a !important;
    outline: solid 2px;
    outline-offset: -1px;
}

.table-responsive .total td:first-of-type {
    position: sticky;
    left: 0;
    z-index: 2;
    background: #585838 !important;
}

.table-responsive .total td:nth-of-type(2), .table-responsive .total td:nth-of-type(3), .table-responsive .total td:nth-of-type(4) {
    left: unset;
    z-index: 0 !important;
}

</style>
@section('content')

    <div class="card" id="app">
        <div class="card-body">
            <!-- Filter Section -->
            @include('backend.layouts.location.filter-section')

            @include('backend.layouts.location.index-table')

            @include('backend.layouts.location.regions-table')

        </div><!--card-body-->
    </div><!--card-->
@endsection
