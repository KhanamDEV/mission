<!DOCTYPE html>
<html lang="ja">
<head>
    @include('admin::elements.meta')
    @include('admin::elements.style')
</head>

<body>
    @yield('content')
    @include('admin::elements.script')
    @yield('validate')
</body>
</html>