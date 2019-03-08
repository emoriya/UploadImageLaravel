<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        $this->app->bind(\App\Repositories\ProdutosRepository::class, \App\Repositories\ProdutosRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProdutoImagemRepository::class, \App\Repositories\ProdutoImagemRepositoryEloquent::class);
        //:end-bindings:
    }
}
