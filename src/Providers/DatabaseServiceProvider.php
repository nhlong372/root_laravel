<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

namespace NINA\Providers;
use NINA\Core\ServiceProvider;
use NINA\Database\Capsule\Manager as Capsule;
class DatabaseServiceProvider extends ServiceProvider
{
    protected $defer = true;
    public function register(): void
    {
        $this->app->singleton('db', function () {
            $defaultConnet = config('database.default');
            $capsule = new Capsule;
            $capsule->addConnection(config('database.connections.'.$defaultConnet));
            $capsule->setAsGlobal();
            $capsule->bootEloquent();
            return \NINA\Database\Capsule\Manager::connection();
        });
    }
    public function provides()
    {
        return ['db'];
    }
}