<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    public function register()
    {
        require_once app_path('Helpers/Utils.php');
        require_once app_path('Helpers/UtilsData.php');
        require_once app_path('Helpers/UtilsMath.php');
        require_once app_path('Helpers/UtilsGraph.php');
    }

    public function boot()
    {
        //
    }
}
