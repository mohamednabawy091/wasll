<?php

namespace App\Repositories;

use App\Models\Driver;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class DriverRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Driver::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function findId(int $id){
        return $this->model
            ->with('user')
            ->findOrFail($id);
    }

    public function driversCount(): int{
        return $this->model->count();
    }
}