<?php

namespace Modules\Faq;

use Illuminate\Support\ServiceProvider;
use Modules\Faq\Facades\FaqFacade;
use Modules\Faq\Facades\FaqQuestionFacade;
use Modules\Faq\Repositories\FaqQuestionRepository;
use Modules\Faq\Repositories\FaqRepository;

class FaqServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        FaqFacade::shouldProxyTo(FaqRepository::class);
        FaqQuestionFacade::shouldProxyTo(FaqQuestionRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
     public function boot()
     {
         $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
         $this->loadViewsFrom(__DIR__ . '/views','dizatechFaq');
         $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

         $this->publishes([
            __DIR__ . '/dist/js/dizatech-faq.js' => public_path('modules/js/dizatech-faq.js'),
            __DIR__ . '/dist/css/dizatech-faq.css' => public_path('modules/css/dizatech-faq.css'),
         ], 'dizatech_faq');
     }
}
