<!DOCTYPE html>
<html lang="ja">
<head>
    @include('manager::elements.meta')
    @include('manager::elements.style')
</head>

<body>
    @yield('content')
    @include('manager::elements.script')
    @yield('validate')
</body>
</html>