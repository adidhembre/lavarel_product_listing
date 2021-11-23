<x-header pageTitle="Project Listing Show"/>
    <script>
        function search(){
            try{
                text = ''
                group = document.getElementsByName("group")[0].value;
                if(group != ''){
                    text += '&group=';
                    text += parseInt(group);
                }
                start = document.getElementsByName("start")[0].value;
                if(start != ''){
                    text += '&start=';
                    text += parseInt(start);
                }
                tracked = document.getElementsByName("tracked")[0].value;
                if(tracked != ''){
                    text += '&tracked=';
                    text += tracked;
                }
                window.location.href = "{{url ('temp')}}?" + text;
                //alert("{{url ('temp')}}" + text);
            }
            catch{
                alert('Error in Filters Adding!');
            }
        }
    </script>
    <div class='container-fluid'>
        <div class='empty'></div>
        <div class="row filters bg-light">
            <div class="col-3">
                <div class='row'>
                    <lable for="group">Group ID</lable>
                    <input type='text' name='group' value='{{$group}}' />
                </div>
            </div>
            <div class="col-3">
                <div class='row'>
                    <lable for="start">Start Year</lable>
                    <input type='text' name='start' value='{{$start}}' />
                </div>
            </div>
            <div class="col-3">
                <div class='row'>
                    <lable for="tracked">Tracked</lable>
                    <input type='text' name='tracked' value='{{$tracked}}' />
                </div>
            </div>
            <div class="col-3">
                <button class='btn btn-primary' onclick="search()">Search</button>
            </div>
            </div>
        </div>
        <div class='empty'></div>
        <div class="app">
            <p>Total No. of Brands: {{$brand_total}}</p>
            <p>Showing page {{$page}} out of {{$pages}}</p>
            <p>
            @if($page > 1)
            <a href="{{url ('temp')}}?limit={{$take}}&page={{$page-1}}{{$q}}">Previous Page</a>
            @endif
            <br/>
            @if($page < $pages)
            <a href="{{url ('temp')}}?limit={{$take}}&page={{$page+1}}{{$q}}">Next Page</a>
            @endif
            </p>
            <div class='empty'></div>
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
                    <td width='40%'>{{$brand['name']}}</td>
                    <td width='25%'>{{$brand['projects']}}</td>
                    <td width='25%'>-</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
<x-footer/>