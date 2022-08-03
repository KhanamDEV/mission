@extends('manager::layouts.app')
@section('content')
    <section id="wrap-user">
        <div class="wrap-list-user bg-white">
            <div class="wrap-button text-center padding-table">
                <a href="{{route('manager.brand_create')}}" class="btn bg-blue btn-subcribe" title="">@lang('manager::layer.brand.btn_new') </a>
            </div>
            <div class="wrap-list">
                <table class="table wrap-table">
                    <thead>
                    </thead>
                    <tbody>
                    @foreach($data['brands'] as $brand)
                        <tr>
                            <td class="box-name">
                                <a href="{{route('manager.brand_menu', ['id' => $brand->id])}}" title=""><img src="{{ empty($brand->thumbnail_url) ? asset('static/manager/images/detail-selected.png') : \App\Helpers\Helpers::getUrlImg($brand->thumbnail_url)}}" alt="" class="image-team"></a>
                                <div class="name d-flex align-items-center">
                                    <a href="{{route('manager.brand_menu', ['id' => $brand->id])}}" title="">{{$brand->name}}</a>
                                </div>
                            </td>
                            <td>
                                <a href="{{route('manager.brand_menu', ['id' => $brand->id])}}" class="control-arrow"><img src="{{asset('static/manager/images/icon-arrow.png')}}" alt=""></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{$data['brands']->links('pagination')}}
    </section>
    @endsection