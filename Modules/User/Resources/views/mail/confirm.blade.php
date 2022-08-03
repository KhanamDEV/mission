<h1>Test send to {{$email}} with token : {{$token}}</h1>
<a style="font-size: 22px" href="{{route('user.sign_up_confirm_success', ['token' => $token])}}">Click here to confirm success !</a>