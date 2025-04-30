<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') | {{ config('app.name', 'Laravel')}}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.scss', 'resources/js/app.js'])
        @stack('styles')
    </head>
    <body class="d-flex flex-column min-vh-100">
        <x-header-component></x-header-component>

        @if(session('error') || session('success') || session('info'))
            <div class="alert alert-{{ session('error') ? 'danger' : (session('success') ? 'success' : 'info') }} alert-dismissible fade show flash-alert" role="alert">
                {{ session('error') ?? session('success') ?? session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- Page Content -->
        @yield('content')
        @yield('modals')

        <footer class="container-fluid d-flex pt-4 pb-3 mt-auto align-items-center justify-content-center flex-column">
            <section class="top-content d-flex gap-3 flex-column">
                <p>Contact:</p>
                <ul class="list-unstyled d-flex gap-2 gap-lg-5 flex-column flex-lg-row ps-4">
                    <li>Mail: <a href="mailto:help@readme.com">help@readme.com</a></li>
                    <li>Instagram: <a href="https://www.instagram.com/readme">www.instagram.com/readme</a></li>
                </ul>
            </section>
            <section class="bottom-content container d-flex flex-column flex-lg-row gap-lg-6 justify-content-center align-items-center flex-wrap">
                <span class="logo">Read<span>Me</span></span>
                <p class="m-0 mx-lg-3">The place where stories live...</p>
            </section>
        </footer>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+q8iDf4z4z9p1E6p1F9j"
            crossorigin="anonymous"
        ></script>
        @stack('scripts')
    </body>
</html>
