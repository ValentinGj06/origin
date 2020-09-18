<!DOCTYPE html>
@langrtl
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @endlangrtl
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', app_name())</title>
        @yield('meta')

        @stack('before-styles')

        {{ style(mix('css/backend.css')) }}
        {{ style(mix('css/clients.css')) }}

        @stack('after-styles')
    </head>

    <body class="app header-fixed sidebar-fixed aside-menu-off-canvas sidebar-lg-show">
    @include('backend.includes.header')

    <div class="app-body">
        @include('backend.includes.sidebar')

        <main class="main">
            @include('includes.partials.read-only')
            @include('includes.partials.logged-in-as')
            {!! Breadcrumbs::render() !!}

            <div class="container-fluid">
                <div class="animated fadeIn">
                    <div class="content-header">
                        @yield('page-header')
                    </div><!--content-header-->

                    @include('includes.partials.messages')
                    @yield('content')
                </div><!--animated-->
            </div><!--container-fluid-->
        </main><!--main-->

        @include('backend.includes.aside')
    </div><!--app-body-->

    @include('backend.includes.footer')

    <!-- Scripts -->
    @stack('before-scripts')
    {!! script(mix('js/manifest.js')) !!}
    {!! script(mix('js/vendor.js')) !!}
    {!! script(mix('js/backend.js')) !!}
    {!! script(mix('js/multiselect.js')) !!}
    {!! script(mix('js/frontend.js')) !!}
    {!! script(mix('js/clients.js')) !!}
    {!! script(mix('js/table-export.js')) !!}
    {!! script(asset('js/pdf-export.js')) !!}
    {!! script(mix('js/pdf-table-auto.js')) !!}
    {!! script(asset('js/xlsx-export.js')) !!}
    {!! script(asset('js/toastr.js')) !!}
    {!! script(asset('js/custom.js')) !!}
    {!! script(asset('js/custom-lite.js')) !!}
    @stack('after-scripts')

    </body>
    </html>
