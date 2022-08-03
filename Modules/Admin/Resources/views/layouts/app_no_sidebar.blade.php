<!DOCTYPE html>
<html lang="ja">
<head>
    @include('admin::elements.meta')
    @include('admin::elements.style')
</head>

<body>
@include('admin::elements.header_no_sidebar')
@include('admin::elements.ajax_loading')
<main id="main">
    @yield('content')
</main>
@include('admin::elements.script')
@yield('validation')
@yield('scripts')
</body>
</html>