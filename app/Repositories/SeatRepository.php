<?php

namespace App\Repositories;

use App\Models\Seat;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class SeatRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Seat::class;
    }
    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function createSeat(array $data){
        $seat = $this->model->create([
            'vehicle_id' => $data['vehicle_id'],
            'seat_number' => $data['seat_number'],
            'seat_type' => $data['seat_type'],
        ]);

        return $seat;
    }
}