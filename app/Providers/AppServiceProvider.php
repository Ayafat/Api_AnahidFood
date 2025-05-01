<?php

namespace App\Providers;

use App\Models\ProductBasket;
use App\Models\Wallet;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer('*', function ($view) {
            if (Auth::check()) {
                $basketcount = ProductBasket::where('user_id', Auth::id())
                    ->whereHas('basket', function ($query) {
                        $query->where('is_paid', 0);
                    })
                    ->sum('count');

                $baskets = ProductBasket::where('user_id', Auth::id())
                    ->whereHas('basket', function ($query) {
                        $query->where('is_paid', 0);
                    })
                    ->get();

                $wallet = Wallet::where('user_id', Auth::id())->first();
                $walletbalance = $wallet ? $wallet->price : 0;
            } else {
                $basketcount = 0;
                $baskets = null;
                $walletbalance = 0;
            }

            $view->with([
                'basketcount' => $basketcount,
                'baskets' => $baskets,
                'walletbalance' => $walletbalance,
            ]);
        });
    }
}
