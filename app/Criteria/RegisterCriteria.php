<?php
/**
 * Created by PhpStorm.
 * User: Gary.P.Dong
 * Date: 2016/7/4
 * Time: 15:18
 */

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class RegisterCriteria implements CriteriaInterface
{

    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->orderBy('created_at')->orderBy('state','asc');
        return $model;
    }
}
