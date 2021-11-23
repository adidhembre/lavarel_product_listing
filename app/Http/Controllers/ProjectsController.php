<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\projects;
use App\Models\brand;
use App\Models\projectListing;
use App\Models\brandnames;
use App\Models\groupNames;
use App\Models\subgroupNames;

class ProjectsController extends Controller
{
    function projectListing(Request $req){
        $projects = projects::all();
        $tender = tenders::all();
        return View('projectListingAdd',compact('projects'));
        //return $result;
    }

    function updatepage($projectId,$message=null){
        $conneced_Brands = brand::where('project.id',(int)$projectId)->get(['title',]);
        $project = projects::where('_id',(int)$projectId)->get(['name',]);
        return View('update',compact('conneced_Brands','project','message'));
        //return $project_title;
    }

    function update($projectId, Request $req){
        $pid = (int)$projectId;
        $conneced_Brands = null;
        $message = null;
        $project = projects::where('_id',(int)$projectId)->get(['name',]);
        if($project[0]->name !== $req->projectName){
            $project = projects::where('_id',(int)$projectId)->update(['name' => $req->projectName]);
            $conneced_Brands = brand::where('project.id',$pid)
                                        ->update(['project.$.name'=>$req->projectName]);
            $message = "Updated Successfully!";
            $project = projects::where('_id',$pid)->get(['name',]);
        }
        $conneced_Brands = brand::where('project.id',(int)$projectId)->get(['title',]);
        return View('update',compact('conneced_Brands','project','message'));
        //return $conneced_Brands;
    }

    //Final controllers to edit product listing

    function projectview($projectId, Request $req){
        $pid = (int)$projectId;
        $project = projectListing::where('_id',$pid)->first();
        return View('projectshow',compact('project','pid'));
        //return $project;
    }

    function deleterecord(Request $req){
        $pid = (int)$req->pid;
        $recordindex = (int)$req->recordindex;
        $project = projectListing::where('_id',$pid)->unset('records.'.$recordindex);
        $project = projectListing::where('_id',$pid)->pull('records',null);
        return redirect('/show/'.$pid);
    }

    function editrecord(Request $req){
        $pid = (int)$req->pid;
        $recordindex = (int)$req->recordindex;
        $project = projectListing::where('_id',$pid)->first();
        $record = $project->records[$recordindex];
        $name = $project->name;
        $brands = brandnames::all();
        //$project = projectListing::where('_id',$pid)->pull('records',null);
        //return redirect('/show/'.$pid);
        return View('editrecord',compact('record','recordindex','pid','name','brands'));
    }

    function addrecord(Request $req){
        $pid = (int)$req->pid;
        $group = (int)$req->group;
        $subgroup = (int)$req->subgroup;
        $equi = (int)$req->equi;
        $bis = (int)$req->bis;
        $brandids = $req->brandid;
        $brands = array();
        foreach($brandids as $b){
            $brandid = (int)$b;
            $brandName = brandnames::where('_id',$brandid)->first()->name;
            array_push($brands,array('id'=>$brandid,'name'=>$brandName));
        }
        $groupName = groupNames::where('_id',$group)->first()->name;
        $subgroupName = subgroupNames::where('_id',$subgroup)->first()->name;
        $record = array('group'=>array('id'=>$group,'name'=>$groupName),'subgroup'=>array('id'=>$subgroup,'name'=>$subgroupName),
        'equivalent'=>$equi,'bis_approved'=>$bis,'brand'=>$brands);
        $project = projectListing::where('_id',$pid)
        ->push('records',$record);
        return redirect('/show/'.$pid);
    }

    function removebrand(Request $req){
        $pid = (int)$req->pid;
        $recordindex = (int)$req->recordindex;
        $brandindex = (int)$req->brandindex;
        $project = projectListing::where('_id',$pid)->unset('records.'.$recordindex.'.brand.'.$brandindex);
        $project = projectListing::where('_id',$pid)->pull('records.'.$recordindex.'.brand',null);
        //$project = projectListing::where('_id',$pid)->pull('records',null);
        //return redirect('/show/'.$pid);
        return redirect('/edit-record?pid='.$pid.'&recordindex='.$recordindex);
    }

    function addbrand(Request $req){
        $pid = (int)$req->pid;
        $recordindex = (int)$req->recordindex;
        $brandids = $req->brandid;
        foreach($brandids as $b){
            $brandid = (int)$b;
            $brandName = brandnames::where('_id',$brandid)->first()->name;
            $project = projectListing::where('_id',$pid)
            ->push('records.'.$recordindex.'.brand',array('id'=>$brandid,'name'=>$brandName));
        }
        return redirect('/edit-record?pid='.$pid.'&recordindex='.$recordindex);
        //return $brandid;
    }

    //Final controllers for data visuallizaion

    function analytics(Request $req){
        $result = array();
        $brand_total = brandnames::count();
        $skip = 0;
        $take = 10;
        $page = 1;
        if($req->has('limit')){
            $take = (int)$req->get('limit');
        }
        if($req->has('page')){
            $page = (int)$req->get('page');
            if($page>0){
                $skip = ($page - 1)*$take;
            }
            else{
                $page = 1;
            }
        }
        $query = [];
        $group = '';
        $start = '';
        $tracked = '';
        $q='';
        if($req->has('group')){
            $group = (int)$req->get('group');
            $q = $q.'&group='.$group;
            $query = array_merge($query,['records.group.id'=>$group]);
        }
        if($req->has('start')){
            $start = (int)$req->get('start');
            $q = $q.'&strat='.$start;
            $query = array_merge($query,['construction_start'=>$start]);
        }
        if($req->has('tracked')){
            $tracked = (int)$req->get('tracked');
            $q = $q.'&tracked='.$tracked;
            $query = array_merge($query,['tracked'=>$tracked]);
        }
        if(count($query) == 0){
            $query = ['_id'=>['$gt'=>0]];
        }
        $pages = ceil($brand_total / $take);
        $brands = brandnames::skip($skip)->take($take)->get();
        foreach($brands as $brand){
            $count = projectListing::whereRaw($query)->where('records.brand.id',$brand->_id)->count();
            if ($count > 0){
                $projects = array('name'=>$brand->name,'projects'=>$count);
                array_push($result,$projects);
            }
        }
        //projectListing::where('records.brand.id',50)->count();
        //return $result;
        return View('temp',compact('result','brand_total', 'take', 'page','pages','group','start','tracked', 'q'));
        /*return projectListing::where('verified',1)
        ->where('tracked',1)->raw()->aggregate(
            [
                [
                    '$group' => ['_id'=>'$records.brand.id']
                ],
            ],
        )->get();*/
    }

    function ajax(Request $req){
        $result = array();
        $brand_total = brandnames::count();
        $skip = 0;
        $take = 10;
        $page = 1;
        if($req->has('limit')){
            $take = (int)$req->get('limit');
        }
        if($req->has('page')){
            $page = (int)$req->get('page');
            if($page>0){
                $skip = ($page - 1)*$take;
            }
            else{
                $page = 1;
            }
        }
        $query = [];
        $group = '';
        $start = '';
        $tracked = '';
        $q='';
        if($req->has('group')){
            $group = (int)$req->get('group');
            $q = $q.'&group='.$group;
            $query = array_merge($query,['records.group.id'=>$group]);
        }
        if($req->has('start')){
            $start = (int)$req->get('start');
            $q = $q.'&strat='.$start;
            $query = array_merge($query,['construction_start'=>$start]);
        }
        if($req->has('tracked')){
            $tracked = (int)$req->get('tracked');
            $q = $q.'&tracked='.$tracked;
            $query = array_merge($query,['tracked'=>$tracked]);
        }
        if(count($query) == 0){
            $query = ['_id'=>['$gt'=>0]];
        }
        $pages = ceil($brand_total / $take);
        $brands = brandnames::skip($skip)->take($take)->get();
        foreach($brands as $brand){
            $count = projectListing::whereRaw($query)->where('records.brand.id',$brand->_id)->count();
            if ($count > 0){
                $projects = array('name'=>$brand->name,'projects'=>$count);
                array_push($result,$projects);
            }
        }
        return View('ajax',compact('result','brand_total', 'take', 'page','pages','group','start','tracked', 'q'));
    }
}