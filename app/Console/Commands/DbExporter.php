<?php

namespace App\Console\Commands;

use Orangehill\Iseed\Iseed;
use Illuminate\Console\Command;

class DbExporter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exports the data from the database to seed files.';

    /**
     * @var Iseed
     */
    private $iseed;

    /**
     * @var
     */
    protected $tables;

    /**
     * @var string
     */
    protected $connection = null;

    /**
     * @var
     */
    protected $numOfRows = 0;

    /**
     * Create a new command instance.
     *
     * @param Iseed $iseed
     */
    public function __construct(Iseed $iseed)
    {
        parent::__construct();
        $this->iseed = $iseed;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tables = \DB::select('SHOW TABLES');

        // Loop through each table
        foreach ($tables as $table) {
            $this->addTable($table->{"Tables_in_" . env('DB_DATABASE')});
        }

        // Loop through each table
        foreach ($this->tables as $table) {
            $this->iseed->generateSeed($table, $this->connection, $this->numOfRows);
        }

        // Generate the seed file
        return $this->info('All Done');
    }

    /**
     * @param $table
     */
    function addTable($table)
    {
        $this->tables[] = $table;
    }

}
