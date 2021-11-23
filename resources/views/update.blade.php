<x-header pageTitle="Project Listing"/>
<form method="post" >
    @csrf
    <div class="container">
        <div class="form-group col-12">
            <label>Project</label>
            <input type="text" name="projectName" value="{{$project[0]->name}}"/>
        </div>
        <div class="form-group col-12">
            <label>Connected brands</label>
            <textarea name="brands name">@foreach($conneced_Brands as $brand){{$brand->title}}, @endforeach</textarea>
        </div>
        <div class="text-center" style="margin-top: 10px;">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </div>
</form>
@if(!empty($message))
<script>
alert("{{$message}}")
</script>
@endif
<x-footer/>