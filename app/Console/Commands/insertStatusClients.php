<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Aluno;
use DB;

class insertStatusClients extends Command
{
    protected $signature = 'insert:situacao';
    
    protected $description = 'Command description';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        $data = DB::table('situacao_aluno')->insert([
            ['id' => 1, 'situacao' => 'Ativo', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['id' => 2, 'situacao' => 'Inativo', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ]);

        return true;
    }
}
