<!DOCTYPE html>
<html lang="ja">
<head>
    @include('admin::elements.meta')
    @include('admin::elements.style')
</head>

<body>
@include('admin::elements.header')
<main id="main">
    <div class="container">
        <div class="row">
            <div id="nav-sitebar" class="col-lg-3 col-md-3">
                @include('admin::elements.sidebar')
            </div>
            <div id="wrap-main" class="col-lg-9 col-md-9">
                @yield('content')
            </div>
        </div>
    </div>
</main>
@yield('modal')
@include('admin::elements.script')
@yield('validate')
@yield('script')
</body>
</html>