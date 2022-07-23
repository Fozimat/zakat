<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Enlink - Admin Dashboard Template</title>

    @include('template.style')

</head>

<body>
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            @include('template.header')
            <!-- Header END -->

            <!-- Side Nav START -->
            @include('template.sidenav');
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="page-container">

                <!-- Content Wrapper START -->
                @yield('content')
                <!-- Content Wrapper END -->

                <!-- Footer START -->
                @include('template.footer')
                <!-- Footer END -->

            </div>
            <!-- Page Container END -->

        </div>
    </div>

    @include('template.script')

</body>

</html>