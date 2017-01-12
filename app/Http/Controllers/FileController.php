<?php

namespace Guo\File\Http\Controllers;

use Illuminate\Routing\Controller as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FileController extends Controller
{
    /**
     * 文件或文件夹列表
     */
    public  function lists(Request $request){
        $dir = dirname(storage_path());
        $dirname=$request->dir?$request->dir:$dir;
        $status=File::isFile($dirname);
        if($status){
          $content=File::get($dirname);
          return view("file::content",['data'=>$content,'type'=>'select','dir'=>$dirname]);
        }else{
            $filelist = File::files($dirname);
            $dirs = File::directories($dirname);
            return view("file::lists",['dir'=>$dirs,'file'=>$filelist]);
        }

    }

    public  function  select(Request $request){
        $dir = dirname(storage_path());
        $dirname=$request->dir?$request->dir:$dir;
        $status=File::isFile($dirname);
        if($status){
            $content=File::get($dirname);
            return view("file::content",['data'=>$content,'type'=>'update','dir'=>$dirname]);
        }
    }

    public function update(Request $request){
        $content=$request->content;
        $status=File::put($request->file, $content);
//        dd($status);
        if($status){
            return back();
        }
    }

    public  function  delete(Request $request){
        $dirname=$request->dir;
        if(empty($dirname)){
            return back();
        }else{
            $status=File::isWritable($dirname);
            if($status){
                File::deleteDirectory($dirname, $preserve = false);
                return back();
            }else{
                return back();
            }

        }

    }
}
