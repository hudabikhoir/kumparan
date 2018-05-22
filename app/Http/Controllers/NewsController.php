<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class NewsController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index(){
        $news = DB::table('news')
                ->get();
        return $news;
    }

    public function storeNews(Request $request){
        $input = $request->except('topic');
        $input['created_at'] = Carbon::now();
        $input['updated_at'] = Carbon::now();
        
        $topic = explode(",",$request->get('topic'));
        // print_r($topic);exit;
        $news = DB::table('news')->insert($input);
        $id = DB::getPdo()->lastInsertId();
        foreach($topic as $t){
            DB::table('posts')->insert([
                'news_id' => $id, 
                'topic_id' => $t
            ]);
        }
        if ($news) {
            $res['success'] = true;
            $res['message'] = 'Data saved';
      
            return response($res);
        }else{
            $res['success'] = false;
            $res['message'] = 'Data cannot be saved!';
        
            return response($res);
        }
    }

    public function updateNews(Request $request, $id){
        $input = $request->except('topic');
        $input['created_at'] = Carbon::now();
        $input['updated_at'] = Carbon::now();

        $news = DB::table('news')
            ->where('id', $id)
            ->update($input);
        $data = DB::table('news')->where('id', '=', $id)->get();  

        if ($news) {
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

    public function deleteNews(Request $request, $id){
        $news = DB::table('news')
                ->where('id', $id)
                ->update([
                    'status' => "deleted",
                    'deleted_at' => Carbon::now()
                ]);  
        if ($news) {
            $res['success'] = true;
            $res['message'] = 'ID '.$id.' deleted';
      
            return response($res);
        }else{
            $res['success'] = false;
            $res['message'] = 'failed!';
        
            return response($res);
        }
    }

    public function getByStatus($status){
        $news = DB::table('news')->where('status', '=', $status)->get();

        return $news;
    }

    public function getByTopic($topic){
        $news = DB::table('posts')
            ->join('topics', 'topics.id', '=', 'posts.topic_id')
            ->join('news', 'news.id', '=', 'posts.news_id')
            ->select('news.*')
            ->where('topics.name', '=', $topic)->get();

        return $news;
    }
}
