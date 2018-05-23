<?php

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {      
        $topic = explode(",","1,2");
        // print_r($topic);exit;
        $news =  DB::table('news')->insert([
            'title' => "pemilu 2019",
            'content' => "Lorem ipsum dolor sit amet",
            'status' => "draft"
        ]);
        $id = DB::getPdo()->lastInsertId();
        foreach($topic as $t){
            DB::table('posts')->insert([
                'news_id' => $id, 
                'topic_id' => $t
            ]);
        }
    }
}
