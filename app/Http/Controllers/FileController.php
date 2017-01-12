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
            return back()->with("messages","修改成功");
        }else{
            return back()->withErrors("修改失败")
        }
    }

    public  function  delete(Request $request){
        $dirname=$request->dir;
        if(empty($dirname)){
            return back()->withErrors("目录不能为空");
        }else{
            $status=File::isWritable($dirname);
            if($status){
                File::deleteDirectory($dirname, $preserve = false);
                return back()->with("messages","删除成功");
            }else{
                return back()->withErrors("删除失败");
            }

        }

    }
}
