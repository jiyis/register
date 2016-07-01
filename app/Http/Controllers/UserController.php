<?php
/**
 * Created by PhpStorm.
 * User: Gary.P.Dong
 * Date: 2016/7/1
 * Time: 11:17
 */

namespace App\Http\Controllers;


use App\Repository\UserRepository;
use App\Http\Requests\Index\UpdateUserRequest;
use Toastr;

class UserController extends BaseController
{

    protected $user;

    public function __construct(UserRepository $user)
    {
        parent::__construct();
        $this->user = $user;
    }

    /**
     * @param $id
     * @return mixed
     * 个人中心
     */
    public function edit()
    {
        $user = $this->user->find($this->user_id);
        return view('index.user.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->user->findWithoutFail($id);

        if(empty($user)){
            Toastr::error('用户不存在');
            return redirect(url('/'));
        }

        $user = $this->user->update($request->all(), $id);

        Toastr::success('个人资料更新成功!');

        return redirect(url('/'));
    }
}