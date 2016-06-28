<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Register;
use Jiyis\Generator\Common\BaseRepository;

class RegisterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'studentID',
        'name',
        'province',
        'politics',
        'stature',
        'academy',
        'profession'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Register::class;
    }
}
