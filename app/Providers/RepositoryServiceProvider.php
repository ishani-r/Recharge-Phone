<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Contracts\UserContract;
use App\Repositories\UserRepository;

use App\Contracts\PostContract;
use App\Repositories\PostRepository;

use App\Contracts\RechargeHistoryContract;
use App\Repositories\RechargeHistoryRepository;

use App\Contracts\PointContract;
use App\Repositories\PointRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserContract::class, UserRepository::class);
        $this->app->bind(PostContract::class, PostRepository::class);
        $this->app->bind(RechargeHistoryContract::class, RechargeHistoryRepository::class);
        $this->app->bind(PointContract::class, PointRepository::class);
    }
}

?>