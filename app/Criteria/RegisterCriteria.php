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
use Carbon\Carbon;
use DB;

class RegisterCriteria implements CriteriaInterface
{

    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('created_at','>',Carbon::now()->startOfYear())->where('created_at','<',Carbon::now()->endOfYear())->orderBy('created_at')->orderBy('state','asc');
        //$model = $model->where(DB::raw('YEAR(created_at)'),Carbon::now()->format('Y'))->orderBy('created_at')->orderBy('state','asc');
        return $model;
    }
}
