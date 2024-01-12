<?php

namespace App\Providers;

use App\Models\Pincode;
use Illuminate\Support\ServiceProvider;
use App\Repositories\IBuilderRepository;
use App\Repositories\BuilderRepository;
use App\Repositories\ConstructionPartnerRepository;
use App\Repositories\IConstructionPartnerRepository;
use App\Repositories\IPincodeRepository;
use App\Repositories\PincodeRepository;
use App\Repositories\ICityRepository;
use App\Repositories\CityRepository;
use App\Repositories\IAreaRepository;
use App\Repositories\AreaRepository;
use App\Repositories\IPincodeCityGroupingRepository;
use App\Repositories\PincodeCityGroupingRepository;
use App\Services\BuilderService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IBuilderRepository::class, BuilderRepository::class);
        $this->app->bind(BuilderService::class, BuilderService::class);

        $this->app->bind(IPincodeRepository::class, PincodeRepository::class);
        $this->app->bind(PincodeService::class, PincodeService::class);

        $this->app->bind(IConstructionPartnerRepository::class, ConstructionPartnerRepository::class);
        $this->app->bind(ConstructionPartnerService::class, ConstructionPartnerService::class);

        $this->app->bind(ICityRepository::class, CityRepository::class);
        $this->app->bind(CityService::class, CityService::class);

        $this->app->bind(IAreaRepository::class, AreaRepository::class);
        $this->app->bind(AreaService::class, AreaService::class);

        $this->app->bind(IPincodeCityGroupingRepository::class, PincodeCityGroupingRepository::class);
        $this->app->bind(pincodeCityGroupingRepositoryService::class, pincodeCityGroupingRepositoryService::class);


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.env') === 'local') {
            \URL::forceScheme('https');
        }
    }
}
