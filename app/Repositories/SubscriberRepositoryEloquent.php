<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\SubscriberRepository;
use App\Models\Subscriber;
use App\Validators\SubscriberValidator;

/**
 * Class SubscriberRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SubscriberRepositoryEloquent extends BaseRepository implements SubscriberRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Subscriber::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SubscriberValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
