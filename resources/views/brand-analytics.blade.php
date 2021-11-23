<x-header pageTitle="Brand Analytics"/>
    <p>Total No. of Brands: {{$count}}</p>
    <p>Showing page {{$page}} out of {{$pages}}</p>
    <p>
    @if($page > 1)
    <a href='?limit=50&page={{$page-1}}'>Previous Page</a>
    @endif
    <br/>
    @if($page < $pages)
    <a href='?limit=50&page={{$page+1}}'>Next Page</a>
    @endif
    </p>
    <table>
        <tr>
            <th>Sr. No.</th>
            <th>Brand</th>
            <th>Projects</th>
            <th>No. of Instances</th>
            <th>Project Value</th>
            <th>Construction Area</th>
        </tr>
        @foreach($result as $brand)
        <tr>
            <td>{{ $loop->index + 1 + ($page -1) * $take }}</td>
            <td>{{$brand->title}}</td>
            <td>{{count($brand->project)}}</td>
        </tr>
        @endforeach
    </table>
<x-footer/>