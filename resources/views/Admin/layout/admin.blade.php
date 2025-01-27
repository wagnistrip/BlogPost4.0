<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="https://www.flight.wagnistrip.com/assets/images/logo/favicon.png">

    <!-- App css -->
    <link href="{{ asset('login/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="{{ asset('login/assets/css/app.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('login/assets/css/app-dark.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
    <link href="{{ asset('login/assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
    @yield('head')
</head>

<body class="loading"
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": false}'>

    <div class="wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        @include('admin.dashboard.includes.sidebar')
        <!-- ========== Left Sidebar End ============ -->

        <!-- ========== Content Section Start ======= -->
        <div class="content-page">
            <div class="content">
                @include('admin.dashboard.includes.navbar')
                @yield('content')
            </div>
        </div>
        <!-- ========== Content Section End ========= -->

    </div>
    @include('admin.dashboard.includes.script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.10/dayjs.min.js"
        integrity="sha512-FwNWaxyfy2XlEINoSnZh1JQ5TRRtGow0D6XcmAWmYCRgvqOUTnzCxPc9uF35u5ZEpirk1uhlPVA19tflhvnW1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" defer="defer"></script>
    <script src="{{ asset('login/assets/js/timepicker.js') }}" defer="defer"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Load Day.js plugins
            ['custom'].forEach(function(format) {
                const plugin = 'dayjs_plugin_customFormat';
                if (plugin in window) {
                    dayjs.extend(window[plugin]);
                }
            });

            $('#working_start_hours').timepicker();
            jQuery('input.timepicker-bs4').timepicker();

        });
    </script>
</body>

</html>
