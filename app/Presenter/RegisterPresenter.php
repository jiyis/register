<?php
/**
 * Created by Gary.F.Dong.
 * Date: 2016/7/2
 * Time: 15:25
 * Desc：
 */

namespace App\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;
use App\Transformer\RegisterTransformer;

class RegisterPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RegisterTransformer();
    }
}
