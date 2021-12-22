<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Contracts\UserContract;
use App\Repositories\UserRepository;

use App\Contracts\UserDetailContract;
use App\Repositories\UserDetailRepository;

use App\Contracts\LikeContract;
use App\Repositories\LikeRepository;

use App\Contracts\PremiumContract;
use App\Repositories\PremiumRepository;

use App\Contracts\SettingContract;
use App\Repositories\SettingRepository;

use App\Contracts\MessageContract;
use App\Repositories\MessageRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserContract::class, UserRepository::class);
        $this->app->bind(UserDetailContract::class, UserDetailRepository::class);
        $this->app->bind(LikeContract::class, LikeRepository::class);
        $this->app->bind(PremiumContract::class, PremiumRepository::class);
        $this->app->bind(SettingContract::class, SettingRepository::class);
        $this->app->bind(MessageContract::class, MessageRepository::class);
    }
}

?>