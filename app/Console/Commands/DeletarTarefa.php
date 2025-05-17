<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tarefa;
use Carbon\Carbon;

class DeletarTarefa extends Command
{
    // Nome do comando usado no terminal
    protected $signature = 'tarefas:limpar-expiradas';

    // Descrição que aparece na lista de comandos
    protected $description = 'Deleta tarefas cuja deadline já passou';

    public function handle()
    {
        // Busca tarefas com deadline menor que agora e deleta
        $deleted = Tarefa::whereNotNull('deadline')
                    ->where('deadline', '<', Carbon::now())
                    ->delete();

        // Exibe mensagem no terminal
        $this->info("{$deleted} tarefas expiradas deletadas.");

        return 0;
    }
}
