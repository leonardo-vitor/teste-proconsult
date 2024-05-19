<?php

namespace App\Providers;

use App\Models\Ticket;
use App\Models\TicketResponse;
use App\Policies\TicketPolicy;
use App\Policies\TicketResponsePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Ticket::class => TicketPolicy::class,
        TicketResponse::class => TicketResponsePolicy::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
