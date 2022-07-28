<?php

namespace AscentCreative\Store\Commands;

use Illuminate\Console\Command;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;


class ZendImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:zendimport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from Zend';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        \AscentCreative\Store\ZendImporter::import();


        return 0;
    }
}
