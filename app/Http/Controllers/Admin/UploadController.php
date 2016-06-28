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

        $file = $request->file('file');
        $extName = $file->getClientOriginalExtension();
        $fileName = time().str_random(3).'.'.$extName;
        $path = str_finish(config('upload.userpic'), '/') . $fileName;
        $content =$file->getPathname();
        $result = $this->manager->saveFile($path, $content);
        $path = $this->manager->filepath($result->basename);
        return response()->json(['msg'=>'success','code'=>'1','path'=>$path]);
    }
    /**
     * 删除文件
     */
    public function deleteFile(Request $request)
    {
        $del_file = $request->get('del_file');
        $path = $request->get(config('upload.userpic')).'/'.$del_file;

        $result = $this->manager->deleteFile($path);

        if ($result === true) {
            return redirect()
                ->back()
                ->withSuccess("File '$del_file' deleted.");
        }

        $error = $result ? : "An error occurred deleting file.";
        return redirect()
            ->back()
            ->withErrors([$error]);
    }

}