<?php
namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Le namespace utilisé pour les contrôleurs.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers\Api'; // Assurez-vous que ceci correspond à votre namespace

    /**
     * Définir les routes de l'application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
    }

    /**
     * Définir les routes API pour l'application.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
    /**
 * Définir les routes web pour l'application.
 *
 * @return void
 */
protected function mapWebRoutes()
{
    Route::middleware('web')
         ->namespace($this->namespace)
         ->group(base_path('routes/web.php'));
}
}
