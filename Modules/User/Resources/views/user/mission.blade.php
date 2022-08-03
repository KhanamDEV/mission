@extends('user::layouts.app')
@section('content')
    <section id="wrap-user">
        <div class="bg-white">
            <div class="wrap-list-user text-center detail-select">
                <div class="text-left">
                    <a href="{{route('user.show', ['id' => request()->user_id])}}" title="" class="btn auto-width button-border back-prev">
                        <svg width="21" height="14" viewBox="0 0 21 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.0397 4.05385C15.0124 4.05385 1.41085 4.05385 1.41085 4.05385L4.27651 0.841899C4.46234 0.633597 4.44413 0.31411 4.23582 0.12828C4.0276 -0.0575111 3.70804 -0.0393775 3.52221 0.168963L0.294817 3.7863C-0.0982985 4.22706 -0.0982594 4.89159 0.294856 5.33223L3.52224 8.9496C3.62214 9.06157 3.76052 9.11855 3.89953 9.11855C4.01928 9.11855 4.13945 9.07623 4.23586 8.99029C4.44417 8.80446 4.46234 8.48497 4.27655 8.27667L1.41089 5.06468C1.41089 5.06468 15.0124 5.06468 15.0397 5.06468C17.2227 5.06468 18.9986 6.84068 18.9986 9.02359C18.9986 11.2065 17.2227 12.9825 15.0397 12.9825H12.6331C12.354 12.9825 12.1277 13.2088 12.1277 13.4879C12.1277 13.767 12.354 13.9934 12.6331 13.9934H15.0397C17.7801 13.9934 20.0095 11.7639 20.0095 9.02359C20.0095 6.28326 17.7801 4.05385 15.0397 4.05385Z" fill="#9F9F9E"/>
                        </svg>
                        <span class="ml-2">戻る</span>
                    </a>
                </div>
                <img class="img_detail" src="{{\App\Helpers\Helpers::getUrlImg($data['mission']->thumbnail_url)}}" alt="">
                <h2 class="misson-title">{{$data['mission']->name}}</h2>
                <p>{{$data['mission']->detail}}</p>
            </div>
            <div class="wrap-list-user wrap-list-team user-detail-mission">
                <div class="wrap-list">
                    <h2 class="title-team">ターゲット：@if(is_null($data['mission']->target_user_id)) なし @else あり @endif</h2>
                    <table class="table wrap-table misson-table">
                        <tbody>

                        @foreach($data['question_answers'] as $key => $question)
                            <tr>
                                <td class="box-name">
                                    <div class="name">
                                        <p class="title-question">Q.{{$key + 1}} : {{$question->title}}</p>
                                        @if(is_array($question->answer))
                                            <ul class="list-question">
                                                @foreach($question->answer as $value)
                                                    <li class="">{{$value}}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                        @if($question->type == 4) <img src="{{\App\Helpers\Helpers::getUrlImg($question->answer)}}" alt="" class="img_detail d-block ml-auto mr-auto"> @else
                                            <p class="">{{$question->answer}}</p> @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
