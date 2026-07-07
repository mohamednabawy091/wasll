<?php

namespace App\Repositories;

use App\Models\Seat;
use App\Models\Vehicle;
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

    public function createSeat(Vehicle $vehicle){
        $capacity = $vehicle->capacity;

        for($i=1; $i<=$capacity; $i++){
                $this->model->create([
                    'vehicle_id' => $vehicle->id,
                    'seat_number' => $i,
                    'seat_type' => 'standard',
            ]);
        }
    }

    public function addSeats(Vehicle $vehicle, int $from, int $to){
        for($i = $from +1; $i <= $to; $i++){
            $this->model->create([
                'vehicle_id' => $vehicle->id,
                'seat_number' => $i,
                'seat_type' => 'standard'
            ]);
        }
    }

    public function removeSeat(Vehicle $vehicle, int $upTo){
        $seatsToRemove = $this->model
            ->where('vehicle_id', $vehicle->id)
            ->where('seat_number', '>', $upTo)
            ->get();

        foreach($seatsToRemove as $seat){

            $hasBookings = $seat->bookings()
                ->whereIn('status', ['approved', 'pending'])
                ->exists();

            if(!$hasBookings){
                $seat->delete();
            }

        }
    }
}