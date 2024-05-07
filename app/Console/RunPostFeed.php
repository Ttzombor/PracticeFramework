<?php

namespace App\Console;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'feed:post',
    description: 'Creates set of posts',
    hidden: false,
    aliases: ['feed']
)]
class RunPostFeed extends Command
{
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Posts Creator',
            '============',
            '',
        ]);

        $output->write('Posts has been created.');

        return Command::SUCCESS;
    }
}
