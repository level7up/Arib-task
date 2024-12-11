<?php

namespace App\Providers;

use App\Interfaces;
use App\Repositories;
use Livewire\Livewire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->bindRepositories();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
    }

    private function bindRepositories()
    {
        $this->app->bind(Interfaces\DepartmentRepositoryInterface::class, Repositories\DepartmentRepository::class);
        $this->app->bind(Interfaces\EmployeeRepositoryInterface::class, Repositories\EmployeeRepository::class);
        $this->app->bind(Interfaces\TaskRepositoryInterface::class, Repositories\TaskRepository::class);
    }
}
