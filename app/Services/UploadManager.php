<?php
/**
 * Created by PhpStorm.
 * User: Gary.P.Dong
 * Date: 2016/6/24
 * Time: 16:04
 * Desc: 上传图片处理类
 */

namespace App\Services;

use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Storage;

class UploadManager extends ImageManager
{
    protected $disk;

    public function __construct()
    {
        parent::__construct();
        $this->disk = Storage::disk(config('common.upload.storage'));
    }

    /**
     * @param $path
     * @return bool|string
     * 删除文件
     */
    public function deleteFiles($path)
    {
        $path = $this->cleanFolder($path);

        if(!$this->disk->exists($path)){
            return "文件不存在！";
        }

        return $this->disk->delete($path);
    }

    /**
     * @param $path
     * @param $content
     * @param int $thumbW
     * @param int $thumbH
     * @param bool $resize
     * @return \Intervention\Image\Image|string
     */
    public function saveFile($path, $content, $thumbW=100, $thumbH=100,$resize=false)
    {
        $path = $this->cleanFolder($path);

        if($this->disk->exists($path)){
            return '文件已存在！';
        }
        if($resize) return parent::make($content)->fit($thumbW, $thumbH)->save($path);

        return parent::make($content)->save($path);
    }

    /**
     * Return files and directories within a folder
     *
     * @param string $folder
     * @return array of [
     *     'folder' => 'path to current folder',
     *     'folderName' => 'name of just current folder',
     *     'breadCrumbs' => breadcrumb array of [ $path => $foldername ]
     *     'folders' => array of [ $path => $foldername] of each subfolder
     *     'files' => array of file details on each file in folder
     * ]
     */
    public function folderInfo($folder)
    {
        $folder = $this->cleanFolder($folder);

        $breadcrumbs = $this->breadcrumbs($folder);
        $slice = array_slice($breadcrumbs,-1);
        $folderName = current($slice);
        $breadcrumbs = array_slice($breadcrumbs,0,-1);

        $subfolders = [];
        foreach (array_unique($this->disk->directories($folder)) as $subfolder) {
            $subfolders["/$subfolder"] = basename($subfolder);
        }
        $files = [];
        foreach ($this->disk->files($folder) as $path) {
            $files[] = $this->fileDetails($path);
        }

        return compact(
            'folder',
            'folderName',
            'breadcrumbs',
            'subfolders',
            'files'
        );
    }

    /**
     * @param $folder
     * @return string
     */
    public function cleanFolder($folder)
    {
        return '/' . trim(str_replace('..','', $folder),'/');
    }

    /**
     * @param $folder
     * @return array
     * 返回当前目录路径
     */
    protected function breadcrumbs($folder)
    {
        $folder = trim($folder, '/');
        $crumbs = ['/'=> 'root'];

        if(empty($folder)){
            return $crumbs;
        }

        $folders = explode('/',$folder);
        $build = '';
        foreach ($folders as $folder) {
            $build .= '/'.$folder;
            $crumbs[$build] = $folder;
        }

        return $crumbs;
    }
    /**
     * 返回文件详细信息数组
     */
    protected function fileDetails($path)
    {
        $path = '/' . ltrim($path, '/');

        return [
            'name' => basename($path),
            'fullPath' => $path,
            'webPath' => $this->fileWebpath($path),
            'mimeType' => $this->fileMimeType($path),
            'size' => $this->fileSize($path),
            'modified' => $this->fileModified($path),
        ];
    }

    /**
     * 返回文件完整的web路径
     */
    public function fileWebpath($path)
    {
        $path = rtrim(config('upload.uploads.webpath'), '/') . '/' .ltrim($path, '/');
        return url($path);
    }
    /**
     * 返回文件的基本路径
     */
    public function filepath($path)
    {
        $path = rtrim(config('upload.userpic'), '/') . '/' .ltrim($path, '/');
        return $path;
    }

    /**
     * 返回文件MIME类型
     */
    public function fileMimeType($path)
    {
        return $this->mimeDetect->findType(
            pathinfo($path, PATHINFO_EXTENSION)
        );
    }

    /**
     * 返回文件大小
     */
    public function fileSize($path)
    {
        return $this->disk->size($path);
    }

    /**
     * 返回最后修改时间
     */
    public function fileModified($path)
    {
        return Carbon::createFromTimestamp(
            $this->disk->lastModified($path)
        );
    }
}