<table>
    <thead>
    <tr>
        <th>user_id</th>
        <th>user_sei</th>
        <th>user_mei</th>
        <th>mobile_app_start_at</th>
    </tr>
    </thead>
    <tbody>
    @foreach($histories as $item)
        <tr>
            <td>{{ $item->id ?? ''}}</td>
            <td>{{ $item->name_sei ?? '' }}</td>
            <td>{{ $item->name_mei ?? '' }}</td>
            <td>{{ \App\Helpers\Helpers::formatDateTime($item->logined_at, 'Y/m/d H:i') ?? ''}}</td>
        </tr>
    @endforeach
    </tbody>
</table>