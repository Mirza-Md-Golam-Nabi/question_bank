<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Service Class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $serviceName = ucfirst($name);
        $directory = app_path("Services");
        $path = "{$directory}/{$serviceName}Service.php";

        // Ensure directory exists
        File::ensureDirectoryExists($directory);

        if (File::exists($path)) {
            $this->error('Service Class already exists!');
            return;
        }

        $template = <<<EOT
<?php

namespace App\Services;

class {$serviceName}Service
{
    public function __construct()
    {
        //
    }

    // Add your service methods here
}
EOT;

        File::put($path, $template);
        $this->info("Service created: {$path}");
    }
}
