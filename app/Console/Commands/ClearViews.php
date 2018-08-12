<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ClearViews extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'views:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear views folder (storage/framework/views)';

    /**
     * The file system instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     */
    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();
        $this->files = $filesystem;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        //
        foreach ($this->files->files(storage_path().'/framework/views') as $file) {
            $this->files->delete($file);
        }

        $this->info('Views deleted from cache.');
    }
}
