<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" class="default-style">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>{{ isset($title) ? $title.' - ' : '' }}Информационно-образовательная среда</title>

    <!-- Main font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ mix('/vendor/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/fonts/ionicons.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/fonts/linearicons.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/fonts/open-iconic.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/fonts/pe-icon-7-stroke.css') }}">

    <!-- Core stylesheets -->
    <link rel="stylesheet" href="{{ mix('/vendor/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/css/appwork.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/css/theme-corporate.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/css/colors.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/css/uikit.css') }}">

    <!-- Load polyfills -->
    <script src="{{ mix('/vendor/js/polyfills.js') }}"></script>
    <script>document['documentMode']===10&&document.write('<script src="https://polyfill.io/v3/polyfill.min.js?features=Intl.~locale.en"><\/script>')</script>

    <!-- Layout helpers -->
    <script src="{{ mix('/vendor/js/layout-helpers.js') }}"></script>

    <!-- Libs -->

    <!-- `perfect-scrollbar` library required by SideNav plugin -->
    <link rel="stylesheet" href="{{ mix('/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">

    <link rel="stylesheet" href="{{ mix('/vendor/libs/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/flatpickr/flatpickr.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/sweetalert2/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{mix('/vendor/libs/toastr/toastr.css')}}">
    <link rel="stylesheet" href="{{ asset('/vendor/libs/bootstrap-editable/bootstrap-editable.css')}}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/quill/typography.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/quill/editor.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/libs/summernote/summernote.min.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/bootstrap-markdown/bootstrap-markdown.css') }}">

    @yield('styles')

    <!-- Application stylesheets -->
    <link rel="stylesheet" href="{{ mix('/css/application.css') }}">

</head>
<body>

    @yield('layout-content')

    <!-- Core scripts -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <script type="text/javascript" src="{{ asset('assets/plugins/jquery/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ mix('/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ mix('/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ mix('/vendor/js/sidenav.js') }}"></script>

    <!-- Libs -->

    <!-- `perfect-scrollbar` library required by SideNav plugin -->
    <script src="{{ asset('/vendor/libs/bootstrap-editable/bootstrap-editable.min.js')}}"></script>
    <script src="{{ mix('/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ mix('/vendor/libs/datatables/datatables.js') }}"></script>
    <script src="{{ mix('/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ mix('/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{mix('/vendor/libs/toastr/toastr.js')}}"></script>
    <script src="{{ mix('/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('/vendor/libs/summernote/summernote.min.js') }}"> </script>

    @yield('scripts')

    <!-- Application javascripts -->
    <script src="{{ mix('/js/application.js') }}"></script>

</body>
</html>