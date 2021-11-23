<x-header pageTitle="Project Listing Show"/>
    <script>
        function add(){
            group = document.getElementById("group").value;
            subgroup = document.getElementById("subgroup").value;
            equi = 0;
            if(document.getElementById("equivalent").checked){
                equi = 1;
            };
            bis = 0;
            if(document.getElementById("bis").checked){
                bis = 1;
            };
            brand = document.getElementById("brand").value;
            brandids = brand.split(',');
            try{
                text = '&group='+parseInt(group)+'&subgroup='+parseInt(subgroup)+'&equi='+parseInt(equi)+'&bis='+parseInt(bis)
                for (var i = 0; i < brandids.length; i++){
                    brandids[i] = parseInt(brandids[i]);
                    text += '&brandid[]=';
                    text +=  brandids[i];
                }
                window.location.href = "{{url ('add-record')}}?pid={{$pid}}" + text;
                //alert("{{url ('add-record')}}?pid={{$pid}}" + text);
            }
            catch{
                alert('Error in Brand Adding!');
            }
        }
    </script>
    <div class="container">
        <table>
            <tr>
                <th colspan="3" style="color:red;">{{$project->name}}</th>
            </tr>
            <tr>
                <th colspan="3" style="color:blue;">Associated Tenders</th>
            </tr>
            @foreach($project->associated_tenders as $tender)
            <tr>
                <td width="10%">{{$loop->index + 1}}</td>
                <td width="70%">{{$tender['name']}}</td>
                <td width="20%">Edit/Remove</td>
            </tr>
            @endforeach
            <tr>
                <th colspan="3" style="color:blue;">Associated Contracts</th>
            </tr>
            @foreach($project->associated_awards as $contract)
            <tr>
                <td width="10%">{{$loop->index + 1}}</td>
                <td width="70%">{{$contract['name']}}</td>
                <td width="20%">Edit/Remove</td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="container">
        <table>
            <tr>
                <th colspan="7" style="color:blue;">Records</th>
            </tr>
            <tr>
                <th width="10%">Sr. No.</th>
                <th width="20%">Group</th>
                <th width="20%">Sub Group</th>
                <th width="30%">Brands</th>
                <th width="5%">Equivalent</th>
                <th width="5%">BIS Approved</th>
                <th width="10%">Option</th>
            </tr>
            <tr>
                <td width="10%">New</td>
                <td width="20%"><input id='group' type='text' /></td>
                <td width="20%"><input id='subgroup' type='text' /></td>
                <td width="30%"><input id='brand' type='text' /></td>
                <td width="5%"><input type="checkbox" id="equivalent"></td>
                <td width="5%"><input type="checkbox" id="bis"></td>
                <td width="10%"><button class='btn btn-primary' onclick="add()">Add</button></td>
            </tr>
            @foreach($project->records as $record)
            <tr>
                <td width="5%">{{$loop->index + 1}}</td>
                <td width="20%">{{$record['group']['name']}}</td>
                <td width="20%">{{$record['subgroup']['name']}}</td>
                <td width="30%">@foreach($record['brand'] as $brand){{$brand['name']}}, @endforeach</td>
                <td width="5%">{{$record['equivalent']}}</td>
                <td width="5%">{{$record['bis_approved']}}</td>
                <td width="20%">
                    <a target="_blank" href="{{url('edit-record?pid='.$project->id.'&recordindex='.$loop->index)}}">
                        Edit
                    </a>
                    /
                    <a href="{{url('delete-record?pid='.$project->id.'&recordindex='.$loop->index)}}">Remove</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
<x-footer/>