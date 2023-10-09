<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include CSS and other common assets here -->
</head>
<body>
@include('components.navbar')

    @yield('content')

    <!-- Include footer here -->

<script src="{{ asset('js/global.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
