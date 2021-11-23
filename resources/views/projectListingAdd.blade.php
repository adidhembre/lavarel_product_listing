<x-header pageTitle="Project Listing"/>
<form method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Projects</label>
        <select class="selectpicker" multiple data-live-search="true">
            @foreach($result as $project)
            <option>{{$project->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control"/>
    </div>
    <div class="form-group">
        <label><strong>Description :</strong></label>
        <textarea class="ckeditor form-control" name="description"></textarea>
    </div>
    <div class="text-center" style="margin-top: 10px;">
        <button type="submit" class="btn btn-success">Save</button>
    </div>
</form>
<x-footer/>