<table>
    <thead>
    <tr>
        <th>user_id</th>
        <th>sei</th>
        <th>mei</th>
        <th>sei_kana</th>
        <th>mei_kana</th>
        <th>details</th>
        <th>mailaddress</th>
        <th>birthday</th>
        <th>gender</th>
        <th>employment_status</th>
        <th>brand_id</th>
        <th>is_active</th>
        <th>brand_name</th>
        <th>department_name</th>
        <th>thumbnail_url</th>
        <th>is_admin</th>
        <th>push_notification_token</th>
        <th>created_at</th>
    </tr>
    </thead>
    <tbody>
    @foreach($members as $key =>  $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name_sei }}</td>
            <td>{{ $user->name_mei }}</td>
            <td>{{ $user->name_sei_kana }}</td>
            <td>{{ $user->name_mei_kana }}</td>
            <td>{{$user->detail}}</td>
            <td>{{$user->email}}</td>
            <td>{{ $user->birthday }}</td>
            <td>{{$user->gender}}</td>
            <td>{{$user->employment_status}}</td>
            <td>{{$user->brand_id}}</td>
            <td>{{$user->is_active ? 'TRUE' : 'FALSE'}}</td>
            <td>{{$user->brand_name ?? '' }}</td>
            <td>{{$user->department}}</td>
            <td>{{$user->thumbnail_url}}</td>
            <td>{{$user->is_admin ? 'TRUE' : 'FALSE'}}</td>
            <td>{{$user->push_notification_token}}</td>
            <td>{{\App\Helpers\Helpers::formatDateTime($user->created_at, 'Y/m/d')}}</td>
        </tr>
    @endforeach
    </tbody>
</table>