<?php


namespace WalkerDistance\Weather;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Weather::class, function () {
            return new Weather(config('weather.weather_key'));
        });

        $this->app->alias(Weather::class, 'weather');
    }

    public function provides()
    {
        return [Weather::class, 'weather'];
    }

    /**
     * 发布配置文件
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('weather.php')
        ]);
    }
}