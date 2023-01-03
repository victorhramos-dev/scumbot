<?php

namespace App\Providers;

use App\Criteria\LoggedAuth\DirectCriteria;
use App\Criteria\LoggedAuth\MorphedCriteria;
use App\Criteria\LoggedAuth\RelatedCriteria;

use App\Repositories\Contracts\AdministratorRepository as AdministratorRepositoryInterface;
use App\Repositories\Contracts\DroneRepository as DroneRepositoryInterface;
use App\Repositories\Contracts\PlayerRepository as PlayerRepositoryInterface;

use App\Repositories\Business\EloquentDroneRepository;
use App\Repositories\Business\EloquentPlayerRepository;

use App\Repositories\System\EloquentAdministratorRepository;

use Illuminate\Support\ServiceProvider;

class AppRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Nothing here
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerGlobalBindings();

        $this->registerWebLoggedPlayerBindings();
    }

    /**
     * Register Global Bindings.
     *
     * @return void
     */
    private function registerGlobalBindings()
    {
        $this->app->bind(DroneRepositoryInterface::class, EloquentDroneRepository::class);
        $this->app->bind(PlayerRepositoryInterface::class, EloquentPlayerRepository::class);

        $this->app->bind(AdministratorRepositoryInterface::class, EloquentAdministratorRepository::class);
    }

    /**
     * Register Web Logged Player Contextual Bindings.
     *
     * @return void
     */
    private function registerWebLoggedPlayerBindings()
    {
        // Nothing here. Just for a while :)
    }

    /**
     * Register bindings with criteria
     *
     * @param   array     $bindings
     * @param   Criteria  $criteria
     *
     * @return  Repository
     */
    private function registerBindingsWithCriteria($bindings, $criteria)
    {
        foreach ($bindings as $interface => $binding) {
            $this->app
                ->when($binding['when'])
                ->needs($interface)
                ->give(function() use($binding, $criteria) {
                    return $this->make($binding['give'], $criteria);
                });
        }
    }

    /**
     * Resolve repository with criteria applied
     *
     * @param   string    $classname
     * @param   Criteria  $criteria
     *
     * @return  Repository
     */
    private function make($classname, $criteria)
    {
        return $this->app->make($classname)->pushCriteria($criteria);
    }
}
