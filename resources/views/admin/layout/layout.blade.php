<!DOCTYPE html>
<html lang="en">

@include('admin.layout.app')

<body>
<div class="ajax-loader"></div>

@include('admin.layout.sidebar')

<div class="main-content">
    @yield('content')
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>

<!-- Vendor JS -->
<script src="{{ asset('admin/js/vendor.bundle.js') }}"></script>

<!-- Theme JS -->
<script src="{{ asset('admin/js/theme.bundle.js') }}"></script>

<script src="{{ asset('/custom/js/jquery.gritter.js') }}"></script>

<script src="{{ asset('/custom/js/admin.js?v=1') }}"></script>

<div id="modal_list"></div>

@stack('script')

</body>
</html>
