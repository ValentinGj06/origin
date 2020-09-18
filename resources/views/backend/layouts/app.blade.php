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
            <div id="particles-js"></div>

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
    @stack('after-scripts')

<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

    <script>
        $( document ).ready(function() {
            var options = {
                "particles": {
                    "number": {
                        "value": 200,
                        "density": {
                            "enable": true,
                            "value_area":1200
                        }
                    },
                    "color": {
                        "value": ["#aa73ff", "#f8c210", "#83d238", "#33b1f8"]
                    },

                    "shape": {
                        "type": "circle",
                        "stroke": {
                            "width": 0,
                            "color": "#fff"
                        },
                        "polygon": {
                            "nb_sides": 5
                        },
                        "image": {
                            "src": "",
                            "width": 100,
                            "height": 100
                        }
                    },
                    "opacity": {
                        "value": 1,
                        "random": false,
                        "anim": {
                            "enable": false,
                            "speed": 0.5,
                            "opacity_min": 0.1,
                            "sync": false
                        }
                    },
                    "size": {
                        "value": 3,
                        "random": true,
                        "anim": {
                            "enable": false,
                            "speed": 20,
                            "size_min": 0.3,
                            "sync": false
                        }
                    },
                    "line_linked": {
                        "enable": true,
                        "distance": 120,
                        "color": "#919191",
                        "opacity": 0.4,
                        "width": 1
                    },
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": true,
                            "mode": "grab"
                        },
                        "onclick": {
                            "enable": true
                        },
                        "resize": true
                    },
                    "modes": {
                        "grab": {
                            "distance": 140,
                            "line_linked": {
                                "opacity": 1
                            }
                        },
                        "bubble": {
                            "distance": 400,
                            "size": 40,
                            "duration": 2,
                            "opacity": 8,
                            "speed": 1
                        },
                        "repulse": {
                            "distance": 200,
                            "duration": 0.4
                        },
                        "push": {
                            "particles_nb": 4
                        },
                        "remove": {
                            "particles_nb": 2
                        }
                    }
                },
                "retina_detect": true
            };

            particlesJS("particles-js",options);
            /*************************************************/

        });

    </script>
</body>
</html>
