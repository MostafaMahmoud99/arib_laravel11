<?php

namespace App\Providers;

use App\Repository\Employee\DBAuthEmployeeRepository;
use App\Repository\Manager\DBAuthManagerRepository;
use App\Repository\Manager\DBDepartmentRepository;
use App\Repository\Manager\DBEmployeeRepository;
use App\Repository\Manager\DBTaskRepository;
use App\RepositoryInterface\Employee\AuthEmployeeRepositoryInterface;
use App\RepositoryInterface\Manager\AuthManagerRepositoryInterface;
use App\RepositoryInterface\Manager\DepartmentRepositoryInterface;
use App\RepositoryInterface\Manager\EmployeeRepositoryInterface;
use App\RepositoryInterface\Manager\TaskRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //Manager
        $this->app->bind(AuthManagerRepositoryInterface::class,DBAuthManagerRepository::class);
        $this->app->bind(DepartmentRepositoryInterface::class,DBDepartmentRepository::class);
        $this->app->bind(EmployeeRepositoryInterface::class,DBEmployeeRepository::class);
        $this->app->bind(TaskRepositoryInterface::class,DBTaskRepository::class);

        //Employee
        $this->app->bind(AuthEmployeeRepositoryInterface::class,DBAuthEmployeeRepository::class);
        $this->app->bind(\App\RepositoryInterface\Employee\TaskRepositoryInterface::class,\App\Repository\Employee\DBTaskRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
