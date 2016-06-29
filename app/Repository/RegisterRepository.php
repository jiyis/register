<?php

namespace App\Repository;

use App\Models\Register;
use Jiyis\Generator\Common\BaseRepository;

class RegisterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
