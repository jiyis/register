<?php
/**
 * Created by PhpStorm.
 * User: Gary.P.Dong
 * Date: 2016/6/30
 * Time: 14:10
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UploadManager;
use Auth, File;

class UploadController extends BaseController
{
    protected  $manager;

    public function __construct(UploadManager $manager)
    {
        $this->manager = $manager;
    }
    /**
     * 上传文件
     */
    public function uploadFile(Request $request)
    {
        try{
            $file = $request->file('file');
            $extName = $file->getClientOriginalExtension();
            $fileName = time().str_random(3).'.'.$extName;
            $student_id = Auth::guard('web')->user()->student_id;
            $lastpath = public_path() . '/' . str_finish(config('common.studentFile'), '/') . $student_id . '/';
            if(!is_dir($lastpath)){
                File::makeDirectory($lastpath, 0755, true);
            }
            $filepath = $lastpath . $fileName;
            $content =$file->getPathname();
            $result = $this->manager->saveFile($filepath, $content);
            $path = $this->manager->filepath($result->basename,str_finish(config('common.studentFile'), '/') . $student_id . '/');
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