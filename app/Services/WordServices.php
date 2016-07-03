<?php
/**
 * Created by Gary.F.Dong.
 * Date: 2016/7/3
 * Time: 16:38
 * Desc：利用网页格式生成word保证最大兼容性
 */

namespace App\Services;


class WordServices
{
    private function start($csspath)
    {
        ob_start();
        $header = '<html xmlns:o="urn:schemas-microsoft-com:office:office"
		xmlns:w="urn:schemas-microsoft-com:office:word"
		xmlns="http://www.w3.org/TR/REC-html40"><head><meta http-equiv="Content-Type" /><xml><w:WordDocument><w:View>Print</w:View></xml>';
        $header.='</head><body>';
        echo $header;
    }
    private function save($path)
    {
        echo "</body></html>";
        $data = ob_get_contents();
        ob_end_clean();
        $this->wirtefile($path,$data);
    }
    public function render($content,$path){
        if(empty($content) || empty($path)){
            return false;
        }
        $this->start();
        echo $content;
        $this->save($path);
        return $path;
    }
    private function wirtefile ($fn,$data)
    {
        $fp=fopen($fn,"wb");
        fwrite($fp,$data);
        fclose($fp);
    }
    public function download($basename,$file){
        if(empty($file) || empty($basename)){
            return false;
        }
        header("Content-type: application/octet-stream");
        //处理中文文件名
        $ua = $_SERVER["HTTP_USER_AGENT"];
        $encoded_filename = rawurlencode($basename);
        if (preg_match("/MSIE/", $ua)) {
            header('Content-Disposition: attachment; filename="' . $encoded_filename . '"');
        } else if (preg_match("/Firefox/", $ua)) {
            header('Content-Disposition: attachment; filename="' . $encoded_filename . '"');
        } else {
            header('Content-Disposition: attachment; filename="' . $basename . '"');
        }
        header('Content-Disposition: attachment; filename="' . $basename . '"');
        header("Content-Length: ". filesize($file));
        $fp=fopen($file,"r");
        $buffer=1024;  //设置一次读取的字节数，每读取一次，就输出数据（即返回给浏览器）
        $file_count=0; //读取的总字节数
        //向浏览器返回数据
        while(!feof($fp) && $file_count<filesize($file)){
            $file_con=fread($fp,$buffer);
            $file_count+=$buffer;
            echo $file_con;
        }
        fclose($fp);
        //下载完成后删除压缩包，临时文件夹
        if($file_count >= filesize($file))
        {
            unlink($file);
            exec("rm -rf ".$file);
        }
        //readfile($file);
        exit;
    }

}