<?php

namespace App\Repositories;

use App\Models\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

use function Laravel\Prompts\error;

class UserRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function usersCount(): int{
        return $this->model->count();
    }

    public function passengersCount(): int{
        return $this->model->where('user_type', 'passenger')->count();
    }

    public function verifiedUsersCount(): int{
        return $this->model->where('is_active', true)->count();
    }

    public function getUsers(array $filters){

        $query = $this->model->query();

        $perPage = request()->input('per_page') ?? 10;

        if(!empty($filters['user_type'])){
            $query->where('user_type', $filters['user_type']);
        }

        if(isset($filters['is_active'])){
            $query->where('is_active', $filters['is_active']);
        }

        return $query->paginate($perPage);
    }
}