<?php

namespace App\Repositories;

use App\Models\Vehicle;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class VehicleRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Vehicle::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function vehiclesCount(): int{
        return $this->model->count();
    }

    public function getVehicleStats(){
        return $this->model
        ->withCount([
            'seats as booked_seats_count' => function ($query){
            $query->whereHas('bookings', function ($q){
                $q->whereIn('status', ['pending', 'approved'])
                  ->whereHas('trip', function ($tripQuery){
                    $tripQuery->where('scheduled_arrival', '>', now());
                  });
            });
        }])
        ->withCount(['trips as upcoming_schedueld_trips' => function($query){
            $query->where('scheduled_arrival', '>', now())
                ->whereIn('status', ['pending', 'assigned']);
        }])->get();
    }
}