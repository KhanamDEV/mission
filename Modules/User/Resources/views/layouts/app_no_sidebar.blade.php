<!DOCTYPE html>
<html lang="ja">
<head>
    @include('user::elements.meta')
    @include('user::elements.style')
</head>

<body>
@include('user::elements.header')
@include('user::elements.ajax-loading')
<main id="main">
    @yield('content')
</main>
@include('user::elements.script')
@yield('validate')
@yield('script')
</body>
</html>