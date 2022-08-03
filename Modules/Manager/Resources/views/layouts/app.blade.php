<!DOCTYPE html>
<html lang="ja">
<head>
    @include('manager::elements.meta')
    @include('manager::elements.style')
    @yield('css')
</head>

<body>
@include('manager::elements.header')
<main id="main">
    <div class="container">
        <div class="row">
            <div id="nav-sitebar" class="col-lg-3 col-md-3">
                @include('manager::elements.sidebar')
            </div>
            <div id="wrap-main" class="col-lg-9 col-md-9">
                @yield('content')
            </div>
        </div>
    </div>
</main>
@yield('modal')
@include('manager::elements.script')
@yield('validate')
@yield('script')
</body>
</html>