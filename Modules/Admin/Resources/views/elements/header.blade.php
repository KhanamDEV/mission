<header id="header" class="bg-white">
    <div class="container">
        <a href="{{route('admin.user_index')}}" title=""><img src="{{asset('static/admin/images/logo_menu.png')}}" alt=""></a>
    </div>
    <img src="{{asset('static/admin/images/icon-close.png')}}" alt="" id="img_bar">
    @include('admin::elements.ajax_loading')
</header>