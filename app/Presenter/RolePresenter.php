<?php
/**
 * Created by PhpStorm.
 * User: Gary.P.Dong
 * Date: 2016/6/12
 * Time: 11:00
 */

namespace App\Presenter;


use App\Repository\RoleRepository;
use Prettus\Repository\Presenter\FractalPresenter;

class RolePresenter extends FractalPresenter
{
    protected $role;

    public function __construct(RoleRepository $role)
    {
        $this->role = $role;
    }

    public function getTransformer()
    {
        return new RoleTransformer();
    }

}