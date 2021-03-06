<?php

namespace backend\helpers;

use Yii;

class Upgrader {

    public $error;
    public $install_path;
    public function get_remote_package($package) {
        $path = API_PACKAGES . $package;
        $this->dowload($path, $package);
    }

    public function unzip_package($package) {
        
        $zip = new \ZipArchive;
        $package_path = APP_DIR.'web\tmp\\' .$package;
        $errorCode=$zip->open($package_path);
        if ($errorCode === TRUE) {
            $module_folder = substr($package, 0,strpos($package, '.'));
            $dest_folder = APP_DIR.'modules';
            if(!file_exists($dest_folder)){
                mkdir($dest_folder);
            }
            $zip->extractTo($dest_folder);
            $zip->close();
        } else {
            echo $this->getUnzipErrorMsg($errorCode);
        }
    }
    
    public function check_package($package){
        $module_name = substr($package, 0, strpos($package, '.'));
        $this->install_path = APP_DIR.'modules/'.$module_name;
        $mainFile = $this->install_path.'/'. ucwords($module_name).'.php';
        if(!file_exists($mainFile)){
            $this->error =  "安装包主文件不存在";
            return FALSE;
        }
        $module_info = get_file_data($mainFile);
        if(!$module_info['Name'] || !$module_info['Version'] || !$module_info['Description'] || !$module_info['Author']){
            $this->error =  "模块信息不完整";
            return FALSE;
        }
        return true;
    }
    
    private  function getUnzipErrorMsg($errorCode)
    {
        switch ($errorCode)
        {
            case \ZipArchive::ER_EXISTS:
                $msg = "File already exists.";
                break;
            case \ZipArchive::ER_INCONS:
                $msg = "Zip archive inconsistent.";
                break;
            case \ZipArchive::ER_INVAL:
                $msg = "Invalid argument.";
                break;
            case \ZipArchive::ER_MEMORY:
                $msg = "Malloc failure.";
                break;
            case \ZipArchive::ER_NOENT:
                $msg = "No such file.";
                break;
            case \ZipArchive::ER_NOZIP:
                $msg = "Not a zip archive.";
                break;
            case \ZipArchive::ER_OPEN:
                $msg = "Can't open file.";
                break;
            case \ZipArchive::ER_READ:
                $msg = "Read error.";
                break;
            case \ZipArchive::ER_SEEK:
                $msg = "Seek error.";
                break;
        }
        return $msg;
    }

    private function dowload($path, $package) {
        $res = Yii::$app->curl->get($path);
        $r = file_put_contents('tmp\\'.$package, $res);
        return $r;
    }

}
