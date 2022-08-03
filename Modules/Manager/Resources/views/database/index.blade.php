<!DOCTYPE html>
<html>
<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        #customers tr:nth-child(even){background-color: #f2f2f2;}
        #customers tr:hover {background-color: #ddd;}
        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>
<body>

<table id="customers">
    @php
        $first = $data->first();
    @endphp

    @if ($first)
        <tr>
            @foreach ($first as $key => $item)
                <th>{{ $key }}</th>
            @endforeach
        </tr>
    @else
        Table Empty
    @endif

    @foreach ($data as $item)
        <tr>
            @foreach ($item as $key => $val)
                <td> {{ $val }} </td>
            @endforeach
        </tr>
    @endforeach
</table>

{{$data->links('pagination')}}


</body>
</html>