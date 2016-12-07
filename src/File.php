<?php
namespace Liuchengguos\File;

Class File
{

    /**
     * @param $dir
     * 删除文件
     */
    public static function del_file($dir)
    {
        $projectdir = config("app.projectdir");
        $dir = $projectdir . $dir;
        @unlink($dir);

    }

    /**
     * @param $dir
     * 文件夹列表
     */
    public static function getdir($dir)
    {
        $projectdir = config("app.projectdir");
        $dir = $projectdir . $dir;
        $dirArray[] = NULL;
        if (false != ($handle = opendir($dir))) {
            $i = 0;
            while (false !== ($file = readdir($handle))) {
                //去掉"“.”、“..”以及带“.xxx”后缀的文件
                if ($file != "." && $file != ".." && !strpos($file, ".")) {
                    $dirArray[$i] = $file;
                    $i++;
                }
            }
            //关闭句柄
            closedir($handle);
        }
        return $dirArray;
    }

    /**
     * @param $dir
     * 文件列表
     */
    public static function getfile($dir)
    {
        $projectdir = config("app.projectdir");
        $dir = $projectdir . $dir;
        $fileArray[] = NULL;
        if (false != ($handle = opendir($dir))) {
            $i = 0;
            while (false !== ($file = readdir($handle))) {
                //去掉"“.”、“..”以及带“.xxx”后缀的文件
                if ($file != "." && $file != ".." && strpos($file, ".")) {
                    $fileArray[$i] = $file;
                    if ($i == 100) {
                        break;
                    }
                    $i++;
                }
            }
            //关闭句柄
            closedir($handle);
        }
        return $fileArray;
    }

    /**
     * @param $dir
     * 文件内容
     */
    public static function getcontent($dir)
    {
        echo "<pre>";
        $projectdir = config("app.projectdir");
        $dir = $projectdir . $dir;
        echo file_get_contents($dir);
    }
}
