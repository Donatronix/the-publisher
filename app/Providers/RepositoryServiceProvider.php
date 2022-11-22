<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\SubscriberRepository;
use App\Repositories\SubscriberRepositoryEloquent;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(SubscriberRepository::class, SubscriberRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\TopicRepository::class, \App\Repositories\TopicRepositoryEloquent::class);
        //:end-bindings:
    }
}
