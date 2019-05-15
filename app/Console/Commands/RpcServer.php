<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Workerman\Worker;
use App\Library\Tw\ThriftWorker;

class RpcServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'server:rpc {action} {--d}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'thrift rpc server';


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
     * @return mixed
     */
    public function handle()
    {
        //
        global $argv;
        $action = $this->argument('action');

        $argv[0] = 'wk';
        $argv[1] = $action;
        $argv[2] = $this->option('d') ? '-d' : '';
        $this->wm();
    }


    public function wm(){
        $worker = new ThriftWorker('tcp://0.0.0.0:13001');
        $worker->count = 16;
        Worker::runAll();
    }
}
