<?php
/**
 * Created by PhpStorm.
 * User: Gary.P.Dong
 * Date: 2016/5/31
 * Time: 15:53
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LocalServiceProvider extends ServiceProvider
{
    /**
     * @var array 定义开发环境下要加在的provider服务提供器
     */
    protected $providers = [
        'Barryvdh\Debugbar\ServiceProvider',
        'Laracasts\Flash\FlashServiceProvider',
        //'\InfyOm\Generator\InfyOmGeneratorServiceProvider',
        //'\InfyOm\CoreTemplates\CoreTemplatesServiceProvider',
        '\Jiyis\Generator\JiyisGeneratorServiceProvider',
        '\Jiyis\CoreTemplates\CoreTemplatesServiceProvider',
        'Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider',
    ];
    protected $aliases = [
        'Debugbar' => 'Barryvdh\Debugbar\Facade',
        'Flash'    => 'Laracasts\Flash\Flash::class'
    ];
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal() && !empty($this->providers)) {
            foreach ($this->providers as $provider) {
                $this->app->register($provider);
            }
            //register the alias
            if (!empty($this->aliases)) {
                foreach ($this->aliases as $alias => $facade) {
                    $this->app->alias($alias, $facade);
                }
            }
        }
    }
}
