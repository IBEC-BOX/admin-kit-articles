<?php

namespace AdminKit\Articles\Commands;

use Illuminate\Console\Command;

class ArticlesCommand extends Command
{
    public $signature = 'admin-kit-articles';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
