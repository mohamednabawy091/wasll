<?php

namespace App\Services;

use App\Repositories\DriverRepository;
use App\Repositories\RouteRepository;
use App\Repositories\UserRepository;
use App\Repositories\VehicleRepository;
use Illuminate\Support\Facades\Cache;

class DashboardStatsService 
{

    public function __construct(
        private UserRepository $userRepository,
        private VehicleRepository $vehicleRepository,
        private RouteRepository $routeRepository,
        private DriverRepository $driverRepository,
        )
    {}
        public function totalUsersCount(){
            
            return $this->userRepository->usersCount();
        }

        public function totalverifiedUsersCount(){
            return $this->userRepository->verifiedUsersCount();
        }

        public function totalPassengersCount(){
            return $this->userRepository->passengersCount();
        }

        public function totalDriversCount(){
            return $this->driverRepository->driversCount();
        }

        public function totalVehiclesCount(){
            return $this->vehicleRepository->vehiclesCount();
        }

        public function totalActiveRoutes(){
            return $this->routeRepository->activeRoutesCount();
        }

        public function dashboardStats(){
            return Cache::remember(
                'dashboard:stats',
                300,
                fn() => [
                        'total_users' => $this->totalUsersCount(),
                        'verified_users' => $this->totalverifiedUsersCount(),
                        'total_passengers' => $this->totalPassengersCount(),
                        'total_drivers' => $this->totalDriversCount(),
                        'total_vehicles' => $this->totalVehiclesCount(),
                        'active_routes' => $this->totalActiveRoutes(),
                    ]
            );
        }
}