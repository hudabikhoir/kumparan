<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class TopicController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index(){
        $topic = DB::table('topics')
                ->get();
        return $topic;
    }

    public function storeTopic(Request $request){
        $input = $request->all();
        $input['created_at'] = Carbon::now();
        $input['updated_at'] = Carbon::now();
        $cate = DB::table('topics')->insert($input);
        if ($cate) {
            $res['success'] = true;
            $res['message'] = 'Data saved';
      
            return response($res);
        }else{
            $res['success'] = false;
            $res['message'] = 'Data cannot be saved!';
        
            return response($res);
        }
    }

    public function updateTopic(Request $request, $id){
        $input = $request->all();
        $input['created_at'] = Carbon::now();
        $input['updated_at'] = Carbon::now();
        $update = DB::table('topics')
            ->where('id', $id)
            ->update($input);
        $res = DB::table('topics')->where('id', '=', $id)->get();
      
        return response($res);
    }

    public function deleteTopic(Request $request, $id){
        $users = DB::table('topics')->where('id', $id)->delete();  
        if ($users) {
            $res['success'] = true;
            $res['message'] = 'ID '.$id.' deleted';
      
            return response($res);
        }else{
            $res['success'] = false;
            $res['message'] = 'failed!';
        
            return response($res);
        }
    }
}
