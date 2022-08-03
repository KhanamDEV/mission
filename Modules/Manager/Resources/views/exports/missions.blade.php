<table>
    <thead>
    <tr>
        <th>mission_id</th>
        <th>name</th>
        <th>details</th>
        <th>thumbnail_url</th>
        <th>user_id</th>
        <th>user_name</th>
        <th>target_user_id</th>
        <th>target_user_name</th>
        <th>team_id</th>
        <th>team_name</th>
        <th>program_id</th>
        <th>program_name</th>
        <th>created_at</th>
        <th>feedback_title</th>
        <th>feedback_details</th>
        <th>feedback_show_percent</th>
        <th>feedback_thumbnail_url</th>
        <th>feedback_user_look_at</th>
        <th>mission_user_look_at</th>
        <th>mission_qa</th>
    </tr>
    </thead>
    <tbody>
        @foreach($missions as $mission)
            <tr>
                <td>{{ $mission->id ?? ''}}</td>
                <td>{{ $mission->name ?? ''}}</td>
                <td>{{ $mission->detail ?? '' }}</td>
                <td>{{\App\Helpers\Helpers::getUrlImg($mission->thumbnail_url)}}</td>
                <td>{{ $mission->user_id ?? '' }}</td>
                <td>{{$mission->user->name_sei.$mission->user->name_mei ?? ''}}</td>
                <td>{{$mission->target_user_id ?? ''}}</td>
                <td>{{!is_null($mission->user_target) ? $mission->user_target->name_sei.$mission->user_target->name_mei : ''}}</td>
                <td>{{$mission->team_id ?? ''}}</td>
                <td>{{$mission->team->name ?? ''}}</td>
                <td>{{$mission->program_id ?? ''}}</td>
                <td>{{$mission->program->name ?? ''}}</td>
                <td>{{$mission->created_at ?? ''}}</td>
                <td>{{$mission->feedback->title ?? ''}}</td>
                <td>{{$mission->feedback->detail ?? ''}}</td>
                <td>{{$mission->feedback->percent * 100}}</td>
                <td>{{\App\Helpers\Helpers::getUrlImg($mission->feedback->thumbnail_url)}}</td>
                <td>{{$mission->feedback->user_look_at ?? ''}}</td>
                <td>{{$mission->user_look_at ?? ''}}</td>
                <td>{{$mission->answers ?? ''}}</td>
            </tr>
        @endforeach
    </tbody>
</table>