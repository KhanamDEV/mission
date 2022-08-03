<!DOCTYPE html>
<html lang="ja">
<head>
    @include('user::elements.meta')
    @include('user::elements.style')
</head>

<body>
@include('user::elements.header')
<main id="main">
    <div class="container">
        <div class="row">
            <div id="nav-sitebar" class="col-lg-3 col-md-3">
                @include('user::elements.sidebar')
            </div>
            <div id="wrap-main" class="col-lg-9 col-md-9">
                @yield('content')
            </div>
        </div>
    </div>
</main>
@yield('modal')
@include('user::elements.script')
@yield('validate')
@yield('script')
</body>
</html>