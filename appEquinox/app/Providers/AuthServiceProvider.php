<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();

        // Obligatorio para definir el alcance
        Passport::tokensCan([
            'Administrador' => 'Descripción permisos administrador',
            'Vendedor' => 'Descripción permisos vendedor',
            'Bodega' => 'Descripción permisos bodega',
        ]);
        Passport::setDefaultScope([
            'Vendedor'
        ]);
    }
}
