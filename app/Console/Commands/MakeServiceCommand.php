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
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Service';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');

        // Split the name into parts if it contains slashes
        $parts = array_map('ucfirst', explode('/', $name));
        $className = array_pop($parts);

        // Remove "Service" suffix if already present
        $className = preg_replace('/Service$/i', '', $className);

        $subDirectory = implode('/', $parts);

        $baseDirectory = app_path("Services");
        $fullDirectory = $subDirectory ? "{$baseDirectory}/{$subDirectory}" : $baseDirectory;
        $path = "{$fullDirectory}/{$className}Service.php";

        // Ensure directory exists
        File::ensureDirectoryExists($fullDirectory);

        if (File::exists($path)) {
            $this->error($this->type . ' already exists!');
            return;
        }

        $namespace = 'App\Services';
        if (!empty($subDirectory)) {
            $namespace .= '\\' . str_replace('/', '\\', $subDirectory);
        }

        // Get the stub file contents
        $stub = File::get($this->getStub());

        // Replace placeholders
        $stub = str_replace('{{ namespace }}', $namespace, $stub);
        $stub = str_replace('{{ class }}', $className, $stub);

        File::put($path, $stub);
        $this->info($this->type . ' created successfully: ' . $path);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return file_exists($customPath = base_path('stubs/service.stub'))
            ? $customPath
            : __DIR__ . '/stubs/service.stub';
    }
}
