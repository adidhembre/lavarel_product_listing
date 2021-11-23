<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\brand;

class BrandController extends Controller
{
    function analytics(Request $req){
        $skip = 0;
        $take = 50;
        $page = 1;
        if($req->has('limit')){
            $take = (int)$req->get('limit');
        }
        if($req->has('page')){
            $page = $req->get('page');
            if($page>0){
                $skip = ($page - 1)*$take;
            }
        }
        /*$result = brand::raw()->aggregate([
            ['$project' => ['project_count' => ['$size' => '$project.length']]],
            ['$sort' => ['project_count' => -1]],
            ['$skip' => $skip],
            ['$limit' => $take]
        ]);*/
        $result = brand::skip($skip)->take($take)->get(['title', 'project.length']);
        $result = brand::raw()->aggregate(
            [
                [
                    '$project' => ['projectCount' => ['$size' => '$project']]
                ],
                [
                    '$sort' => ['project_count' => 1]
                ],
                ['$skip' => 0],
                ['$limit' => 50],
            ]
        );
        //$result = brand::options(['allowDiskUse' => true])->orderBy('project', 'desc')->skip($skip)->take($take)->get(['title', 'project.length']);
        $count = brand::count();
        $pages = ceil($count / $take);
        /*if($req->has('equal')){
            $pass = tenders::where('username',$username)->first()['password'];
        }*/
        //return View('brand-analytics',compact('result','count','pages','page','take'));
        //return brand::skip(0)->limit(20)->get('title', 'project.length');
        //return brand::all();
        return json_encode(iterator_to_array($result));
    }

    function analyticsOld(Request $req){
        $skip = 0;
        $take = 50;
        $page = 1;
        if($req->has('limit')){
            $take = (int)$req->get('limit');
        }
        if($req->has('page')){
            $page = $req->get('page');
            if($page>0){
                $skip = ($page - 1)*$take;
            }
        }
        $result = brand::skip($skip)->take($take)->get(['title', 'project.length']);
        $count = brand::count();
        $pages = ceil($count / $take);
        return View('brand-analytics',compact('result','count','pages','page','take'));
    }
}
