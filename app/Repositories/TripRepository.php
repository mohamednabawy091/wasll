<?php

namespace App\Repositories;

use App\Filters\TripsFilter;
use App\Models\Trip;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class TripRepository extends BaseRepository
{
    public function __construct(
        protected TripsFilter $tripsFilter
    ) {
        parent::__construct(app());
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Trip::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function index(array $filters){

        $query = $this->model->query()
            ->with(['route', 'vehicle', 'driver.user']);

        $perPage = $filters['per_page'] ?? 10;

        $queryFilter = $this->tripsFilter->applyFilter($query, $filters);

        return $queryFilter->paginate($perPage);
    }
}