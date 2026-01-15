<?php

namespace Domain\Order;

use Illuminate\Support\ServiceProvider;
use Domain\Order\Repositories\OrderRepositoryInterface;
use Infrastructure\Order\Repositories\EloquentOrderRepository;
use Illuminate\Support\Facades\Event;
use Domain\Order\Events\OrderPlaced;
use Infrastructure\Order\Listeners\SendOrderConfirmation;
/**
 * Class OrderServiceProvider
 *
 * This provider handles the dependency injection bindings for the Order domain.
 * It maps the domain interfaces to their concrete infrastructure implementations,
 * allowing the domain logic to remain decoupled from technical details .
 */
class OrderServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        // Bind the Order Repository Interface to its Eloquent Implementation.
        // This ensures that whenever the interface is requested, the Eloquent
        // version is provided by Laravel's container .
        $this->app->bind(
            OrderRepositoryInterface::class,
            EloquentOrderRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {

        // Register the event listener for the OrderPlaced event.
        Event::listen(
            OrderPlaced::class,
            SendOrderConfirmation::class
        );
    }
}
