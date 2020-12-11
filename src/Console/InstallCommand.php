<?php


namespace Ray\Tall\Console;


use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tall:install';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->updateNodePackages();

        // Views...
        (new Filesystem)->ensureDirectoryExists(resource_path('views/layouts'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/views/layouts', resource_path('views/layouts'));
        if (file_exists(resource_path('views/welcome.blade.php'))) (new Filesystem())->delete(resource_path('views/welcome.blade.php'));
        copy(__DIR__ . '/../../stubs/resources/views/welcome.blade.php', resource_path('views/welcome.blade.php'));


        // Components...
        (new Filesystem)->ensureDirectoryExists(app_path('View/Components'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/App/View/Components', app_path('View/Components'));

        // Tailwind / Webpack...
        copy(__DIR__ . '/../../stubs/tailwind.config.js', base_path('tailwind.config.js'));
        copy(__DIR__ . '/../../stubs/webpack.mix.js', base_path('webpack.mix.js'));
        copy(__DIR__ . '/../../stubs/webpack.config.js', base_path('webpack.config.js'));
        copy(__DIR__ . '/../../stubs/resources/css/app.css', resource_path('css/app.css'));
        copy(__DIR__ . '/../../stubs/resources/js/app.js', resource_path('js/app.js'));
        copy(__DIR__ . '/../../stubs/resources/js/bootstrap.js', resource_path('js/bootstrap.js'));

        $this->info('Breeze scaffolding installed successfully.');
        $this->comment('Please execute the "npm install && npm run dev" command to build your assets.');
    }

    /**
     * Create new "packages.json" file.
     */
    protected function updateNodePackages()
    {
        $this->flushNodeModules();

        copy(__DIR__ . '/../../stubs/packages.json', base_path('package.json'));

    }

    /**
     * Delete the "node_modules" directory and remove the associated lock files.
     *
     * @return void
     */
    protected static function flushNodeModules()
    {
        tap(new Filesystem, function ($files) {
            if (file_exists(base_path('package.json'))) $files->delete(base_path('package.json'));
            $files->deleteDirectory(base_path('node_modules'));
            $files->delete(base_path('yarn.lock'));
            $files->delete(base_path('package-lock.json'));
        });
    }
}
