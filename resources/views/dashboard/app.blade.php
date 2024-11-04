<!DOCTYPE html>
<html>

<head>
    @include('dashboard.layouts.link')
</head>

<body>
    <!-- sidebar -->
    @include('dashboard.layouts.sidebar')
    <!-- end sidebar -->

    <div id="mobile-message">
        <p>Please open this page on a desktop device.</p>
    </div>
    
    <div class="content" id="content">
        <!-- navbar -->
        @include('dashboard.layouts.navbar')
        <!-- end navbar -->

        <main>
            <div class="container-fluid mt-5 pt-4">
                {{-- content --}}
                @yield('content')
                {{-- end content --}}
            </div>
        </main>

    </div>

    {{-- scripts --}}
    @include('dashboard.layouts.scripts')
    {{-- end scripts --}}
</body>

</html>
