<!DOCTYPE html>
<html lang="ja">
<head>
    @include('user::elements.meta')
    @include('user::elements.style')
</head>

<body>
    @yield('content')
    @include('user::elements.script')
    @yield('validate')
</body>
</html>