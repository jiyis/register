<?php
/**
 * Created by Gary.F.Dong.
 * Date: 2016/7/24
 * Time: 22:34
 * Desc：
 */

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use DB;


class RegisterCheckCriteria implements CriteriaInterface
{

    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('review_state',2);
        //$model = $model->where(DB::raw('YEAR(created_at)'),Carbon::now()->format('Y'))->orderBy('created_at')->orderBy('state','asc');
        return $model;
    }
}
