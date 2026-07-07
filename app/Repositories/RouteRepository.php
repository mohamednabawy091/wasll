<?php

namespace App\Repositories;

use App\Models\Route;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class RouteRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Route::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function activeRoutesCount(): int{
        return $this->model->where('is_active', true)->count();
    }

    public function indexRoutes(?bool $activeOnly = null){
        $query = $this->model->withCount('trips');
        if($activeOnly){
            $query->where('is_active', true);
        }
        return $query->get();
    }
}