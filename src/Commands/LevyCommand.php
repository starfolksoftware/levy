<?php

namespace StarfolkSoftware\Levy\Commands;

use Illuminate\Console\Command;

class LevyCommand extends Command
{
    public $signature = 'levy';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
