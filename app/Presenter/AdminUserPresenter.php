<?php

/**
 * Created by PhpStorm.
 * User: Gary.P.Dong
 * Date: 2016/6/12
 * Time: 9:39
 */
namespace App\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;
use App\Transformer\AdminUserTransformer;

class AdminUserPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AdminUserTransformer();
    }

}