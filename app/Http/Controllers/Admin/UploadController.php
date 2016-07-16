<?php
/**
 * Created by PhpStorm.
 * User: Gary.P.Dong
 * Date: 2016/6/24
 * Time: 17:02
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\UploadManager;
use File;

class UploadController extends BaseController
{
    protected  $manager;

    public function __construct(UploadManager $manager)
    {
        parent::__construct();
        $this->manager = $manager;
    }
    /**
     * 上传图片
     */
    public function uploadImage(Request $request)
    {
        try{
            $student_id = $request->get('student_id');
            $name = $request->get('name');
            $file = $request->file('file');
            $extName = $file->getClientOriginalExtension();
            $fileName = empty($name) ? time().str_random(3).'.'.$extName : $name . '-' . $student_id . '.' . $extName;
            $lastpath = public_path() . '/' . str_finish(config('common.studentFile'), '/') . $student_id . '/';
            if(!is_dir($lastpath)){
                File::makeDirectory($lastpath, 0755, true);
            }
            $filepath = $lastpath . $fileName;
            $content =$file->getPathname();
            if($name == 'userpic'){
                $result = $this->manager->saveImage($filepath, $content,125,165,true);
            }else{
                $result = $this->manager->saveImage($filepath, $content);
            }
            $path = $this->manager->filepath($result->basename,str_finish(config('common.studentFile'), '/') . $student_id . '/');
            return response()->json(['msg'=>'success','code'=>'1','path'=>$path]);
        }catch(\Exception $e){
            return response()->json(['msg'=>$e->getMessage(),'code'=>'0']);
        }

    }
    /**
     * 上传附件或者视频
     */
    public function uploadFile(Request $request)
    {
        try{
            $student_id = $this->student_id;
            $name = $request->get('name');
            $file = $request->file('file');
            $extName = $file->getClientOriginalExtension();
            $fileName = empty($name) ? time().str_random(3).'.'.$extName : $name . '-' . $student_id . '.' . $extName;
            $lastpath = str_finish(config('common.studentFile'), '/') . $student_id . '/';
            if(!is_dir($lastpath)){
                File::makeDirectory($lastpath, 0755, true);
            }
            //$content =$file->getPathname();
            $result = $file->move($lastpath,$fileName);
            $path = $result->getPathname();
            $path = str_replace('\\','/',$path);
            return response()->json(['msg'=>'success','code'=>'1','path'=>$path]);
        }catch(\Exception $e){
            return response()->json(['msg'=>$e->getMessage(),'code'=>'0']);
        }

    }
    /**
     * @param Request $request
     * 删除上传的文件
     */
    public function deleteFile(Request $request)
    {
        try {
            $file = $request->get('name');
            $result = $this->manager->deleteFiles($file);
            return response()->json(['msg' => 'success', 'code' => '1']);
        }catch(\Exception $e){
            return response()->json(['msg'=>$e->getMessage(),'code'=>'0']);
        }
    }

}