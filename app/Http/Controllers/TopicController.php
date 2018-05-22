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
        $topic = DB::table('topics')->insert($input);
        if ($topic) {
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
        $topic = DB::table('topics')
            ->where('id', $id)
            ->update($input);
        $data = DB::table('topics')->where('id', '=', $id)->get();
      
        if ($topic) {
            $res['success'] = true;
            $res['message'] = 'Data saved';
            $res['data'] = $data;
      
            return response($res);
        }else{
            $res['success'] = false;
            $res['message'] = 'Data cannot be saved!';
        
            return response($res);
        }
    }

    public function deleteTopic(Request $request, $id){
        $topic = DB::table('topics')->where('id', $id)->delete();  
        if ($topic) {
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
