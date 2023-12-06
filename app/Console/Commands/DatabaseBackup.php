<?php

namespace App\Console\Commands;

use App\Models\Backup;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create copy of mysql dump for existing database.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $filename = "backup-" . Carbon::now()->format('Y-m-d') . ".sql";
        // Create backup folder and set permission if not exist.
        $storageAt = storage_path() . "/app/backup/";
        if(!File::exists($storageAt)) {
            File::makeDirectory($storageAt, 0755, true, true);
        }
        $command = "".env('DB_DUMP_PATH', 'mysqldump')." --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  | gzip > " . $storageAt . $filename;

        $returnVar = NULL;
        $output = NULL;
        exec($command, $output, $returnVar);
        $url = Storage::putFile('backup', $storageAt . $filename);
        $backup = new Backup();
        $backup->file_name = $filename;
        $backup->file_url = $url;
        $backup->save();
    }
}
