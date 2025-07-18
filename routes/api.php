<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('like/{id}', function(Request $request, $id){
    $accepted_origin = array("http://localhost:8000", "http://dnvonline.com", "http://destiny.com");

    if(isset($_SERVER['HTTP_ORIGIN'])){
        if(in_array($_SERVER['HTTP_ORIGIN'], $accepted_origin)){
            header('Access-Control-Allow-Origin' . $_SERVER['HTTP_ORIGIN']);
        }else{
            header('HTTP/1.1 403 Origin Denied');
            return;
        }
    }

    $lecture_id = $id;
    $user_id = $request->id;
    
    $user = App\User::find($user_id);
    $article = App\Article::find($lecture_id);
    $find_like = App\Like::where('user_id',$user_id)->where('lecture_id',$lecture_id)->get();
    $all_likes = App\Like::where('lecture_id',$lecture_id)->get();
    $total_number_likes = count($all_likes);

    if(count($find_like)>0){
        $new_total_number_likes = $total_number_likes - 1;
        App\Like::where('user_id',$user_id)->where('lecture_id',$lecture_id)->delete();
        echo json_encode(array('msg'=>'unliked', 'likes'=> $new_total_number_likes));
    }else{
        $like = new App\Like(['like'=>1, 'status'=>'active', 'user_id'=>$user_id]);
        $save_like = $article->likes()->save($like);
        if($save_like){
            $all_likes = App\Like::where('lecture_id',$lecture_id)->get();
            $total_number_likes = count($all_likes);
            $new_total_number_likes = $total_number_likes;
            echo json_encode(array('msg'=>'liked', 'likes'=> $new_total_number_likes));
        }else{
            echo json_encode(array('msg'=>'failure'));
        }
    }
});

Route::post('/upload-tinymce', function(Request $request){
    $accepted_origin = array("http://localhost:8000");
    
    if($request->has('file')){
        $image = $request->file('file');
        $image_name = $image->getClientOriginalName();

        if(isset($_SERVER['HTTP_ORIGIN'])){
            if(in_array($_SERVER['HTTP_ORIGIN'], $accepted_origin)){
                header('Access-Control-Allow-Origin' . $_SERVER['HTTP_ORIGIN']);
            }else{
                header('HTTP/1.1 403 Origin Denied');
                return;
            }
        }

        if(preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $image_name)){
            header("HTTP/1.1 400 Invalid file name.");
            return;
        }

        if(!in_array(strtolower(pathinfo($image_name, PATHINFO_EXTENSION)), array('gif', 'jpg', 'png', 'jpeg'))){
            header("HTTP/1/1 400 Invalid extention");
            return;
        }

        $upload_path = public_path('uploads/');
        $image->move($upload_path, $image_name);
        // $filetowrite = $request->file('file')->storeAs('/public/uploads', $image_name );

        $location = "/uploads/".$image_name;
        echo json_encode(array('location' => $location));
    }else{
        header("HTTP/1.1 500 server Error");
    }

});