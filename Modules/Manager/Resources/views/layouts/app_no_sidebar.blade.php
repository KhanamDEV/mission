<!DOCTYPE html>
<html lang="ja">
<head>
    @include('manager::elements.meta')
    @include('manager::elements.style')
</head>

<body>
@include('manager::elements.header_no_sidebar')
@include('manager::elements.ajax-loading')
<main id="main">
    @yield('content')
</main>
@yield('modal')
@include('manager::elements.script')
@yield('validate')
@yield('script')
</body>
</html>