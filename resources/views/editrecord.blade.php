<x-header pageTitle="Project Listing Show"/>
    <script>
        function add(){
            brandid = document.getElementById("brandid").value;
            brandids = brandid.split(',');
            try{
                text = ''
                for (var i = 0; i < brandids.length; i++){
                    brandids[i] = parseInt(brandids[i]);
                    text += '&brandid[]=';
                    text +=  brandids[i];
                }
                window.location.href = "{{url ('add-brand')}}?pid={{$pid}}&recordindex={{$recordindex}}" + text;
            }
            catch{
                alert('Error in Brand Adding!');
            }
        }
    </script>
    <div class="container">
        <table>
            <tr>
                <th colspan="3" style="color:red;">{{$name}}</th>
            </tr>
            <tr>
                <td>Group</td>
                <td>{{$record['group']['name']}}
            </tr>
            <tr>
                <td>Sub Group</td>
                <td>{{$record['subgroup']['name']}}
            </tr>
            <tr>
                <th colspan="2">Brands</th>
            </tr>
            <tr>
                <td>Brnad Id <input id="brandid" type="text" name="brandid" /></td>
                <td><button onclick="add()">Add</button></td>
            </tr>
            @foreach($record['brand'] as $brand)
            <tr>
                <td width="80%">{{$brand['name']}}</td>
                <td width="20%">
                    <a href="{{url('remove-brand?pid='.$pid.'&recordindex='.$recordindex.'&brandindex='.$loop->index)}}">
                        Remove
                    </a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
<x-footer/>