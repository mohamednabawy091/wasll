<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GenerateServiceRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:crud {--model=} {--sub=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a crud service repository for a given model';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $model = Str::studly($this->option('model'));
        $subFolder = $this->option('sub');
        $serviceName = "{$model}";
        $subFolderName = "{$subFolder}";

        // //validation to 

        // if(! $this->option('model') || ! $this->option('sub')){
        //     $this->error('Model and Sub folder are required');
        // }

        //create service directory folder.
        $serviceFolderPath = app_path("Services/{$subFolderName}/{$model}");

        if(! File::exists($serviceFolderPath)){
            File::makeDirectory($serviceFolderPath, 0755, true);
        }

        //create repository folder
        $repositoryFolderPath = app_path("Repositories");
            if(! File::exists($repositoryFolderPath)){
                File::makeDirectory($repositoryFolderPath);
        }

        //create repository file
        $repositoryFilePath = "{$repositoryFolderPath}/{$model}Repository.php";
        if(! File::exists($repositoryFilePath)){
            File::put($repositoryFilePath, $this->getStubContent('repository', $model));
        }

        //create service file.
        $crudMethods = ['Create', 'Read', 'Update', 'Delete'];

        foreach($crudMethods as $method){
            $serviceFilePath = "{$serviceFolderPath}/{$serviceName}{$method}Service.php";
            File::put($serviceFilePath, $this->getStubContent('service', $model, $method, $subFolder));
        }

        $this->info("Repository and CRUD service files created for {$model}.");
    }

    public function getStubContent($type, $model, $method = '', ?string $subFolder = null){

        $stubPath = base_path("stubs/{$type}.stub");
        $content = File::get($stubPath);

        //replace placeholders with the content.
        if($type == 'service'){
            $content = str_replace('{{subFolder}}', $subFolder, $content);
        }
            $content = str_replace(['{{model}}', '{{className}}', '{{method}}', '{{lowerModel}}', '{{lowerMethod}}'], 
                [$model, $model.$method, $method, Str::lower($model), Str::lower($method)],
                $content);

            // $content = str_replace('{{model}}', $model, $content);
            // $content = str_replace('{{className}}', $model.$method, $content);
            // $content = str_replace('{{method}}', $method, $content);
            // $content = str_replace('{{lowerModel}}', Str::lower($model), $content);
            // $content = str_replace('{{lowerMethod}}', Str::lower($method), $content);

        return $content;

    }
     
}

