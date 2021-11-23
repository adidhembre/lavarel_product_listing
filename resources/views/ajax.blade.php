<table>
    <tr>
        <th width='10%'>Sr. No.</th>
        <th width='40%'>Brand</th>
        <th width='25%'>Projects</th>
        <th width='25%'>Instance</th>
    </tr>
    @foreach($result as $brand)
    <tr>
        <td width='10%'>{{($page - 1) * $take + $loop->index +1}}</td>
        <td width='40%'>{{$brand['_id']}}</td>
        <td width='25%'>{{$brand['projects']}}</td>
        <td width='25%'>-</td>
    </tr>
    @endforeach
</table>