<?php

namespace Guo\File\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FileController extends Controller
{
    /**
     * 文件或文件夹列表
     */
    public function lists(Request $request)
    {
        $dir = dirname(storage_path());
        $dirname = $request->dir ? $request->dir : $dir;
        $status = File::isFile($dirname);
        if ($status) {
            $content = File::get($dirname);
            $Write = File::isWritable($dirname);
            return view("file::content", ['data' => $content, 'type' => 'select', 'dir' => $dirname,'Write'=>$Write]);
        } else {
            $filelist = File::files($dirname);
            $dirs = File::directories($dirname);
            return view("file::lists", ['dir' => $dirs, 'file' => $filelist]);
        }

    }

    public function select(Request $request)
    {
        $dir = dirname(storage_path());
        $dirname = $request->dir ? $request->dir : $dir;
        $status = File::isFile($dirname);
        if ($status) {
            $content = File::get($dirname);
            return view("file::content", ['data' => $content, 'type' => 'update', 'dir' => $dirname]);
        }
    }

    public function update(Request $request)
    {
        $content = $request->content;
        $status = File::put($request->file, $content);
//        dd($status);
        if ($status) {
            return back()->with("messages", "修改成功");
        } else {
            return back()->withErrors("修改失败");
        }
    }

    public function delete(Request $request)
    {
        $dirname = $request->dir;
        if (empty($dirname)) {
            return back()->withErrors("目录不能为空");
        } else {

$status = $this->check($dirname);

            // echo $status = File::isWritable($dirname);

            if ($status == false) {
                return back()->withErrors("不可删除");
                die;
            } else {
                $sta = File::isFile($dirname);
                if ($sta) {
                   $result = File::delete($dirname);
                    if ($result) {
                        return back()->with("messages", array("删除成功"));
                    } else {
                        return back()->withErrors("删除失败");
                    }
                } else {
                   $result = File::deleteDirectory($dirname);
                    if ($result) {
                        return back()->with("messages", array("删除成功"));
                    } else {
                        return back()->withErrors("删除失败");
                    }

                }
                die;
            } 

        }

    }

    public function check($dirname){
         $status = File::isWritable($dirname);

            if ($status) {
                return true;
            }else{
               return false;
            }
    }


    public function file($dirname)
    {
        $result = File::delete($dirname);
        if ($result) {
            return redirect('/')->with("mgssages", array("发送成功"));
        } else {
            return back()->withErrors("删除失败");
        }
    }

    public function dir($dirname)
    {
        $result = File::deleteDirectory($dirname);
        if ($result) {
            return redirect('/')->with("mgssages", array("发送成功"));
        } else {
            return back()->withErrors("删除失败");
        }

    }

    public function getlog(Request $request)
    {
        $dir = storage_path("logs");
        $dirname = $request->dir ? $request->dir : $dir;
        $status = File::isFile($dirname);
        if ($status) {
            $content = File::get($dirname);
            return view("file::content", ['data' => $content, 'type' => 'select', 'dir' => $dirname]);
        } else {
            $filelist = File::files($dirname);
            $dirs = File::directories($dirname);
            return view("file::lists", ['dir' => $dirs, 'file' => $filelist]);
        }
    }
}
