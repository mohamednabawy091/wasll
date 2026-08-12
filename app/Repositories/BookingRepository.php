<?php

namespace App\Repositories;

use App\Filters\BookingsFilter;
use App\Models\Booking;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

class BookingRepository extends BaseRepository
{
    public function __construct(private BookingsFilter $bookingsFilter){
        parent::__construct(app());
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Booking::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function paginated(array $filter){
        $per_page = request()->input('per_page') ?? 10;

        $query = $this->model->query()
            ->with([
                'user:id,name,email',
                'trip:id,route_id,scheduled_departure',
                'trip.route',
                'seat:id,seat_number',
            ]);

        $queryFilter = $this->bookingsFilter->applyFilter($query, $filter)->latest('booking_date')->paginate($per_page);

        return $queryFilter;
    }
}