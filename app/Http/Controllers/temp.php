<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\temp as project;

class temp extends Controller
{
    function ajax(Request $req){
        $result = array();
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
        /*$projects = project::raw()->aggregate(
            [
                [
                    '$project' => ['projectCount' => ['$size' => '$project']]
                ],
                [
                    '$group' =>[
                        ''
                    ]
                ]
                ['$skip' => $skip],
                ['$limit' => $take],
            ]
        );*/
        $projects = project::whereRaw($query)->raw()->aggregate(
            [
                ['$unwind' => ["path" => '$records']],
                ['$unwind' => ["path" => '$records.brand']],
                [
                    '$group'=> [
                        "_id"=> '$records.brand.name',
                        "projects"=> [ '$sum'=> 1 ]
                    ]
                ],
                [
                    '$sort' => ['projects' => -1]
                ],
                [
                    '$skip' => $skip
                ],
                [
                    '$limit' => $take
                ]
            ]);
        //$projects = project::get(['name']);
        //return json_encode(iterator_to_array($projects));
        $result = iterator_to_array($projects);
        $brand_total = 1;
        $pages = 1;
        //return $projects;
        return View('ajax',compact('result','brand_total', 'take', 'page','pages','group','start','tracked', 'q'));   
    }
}