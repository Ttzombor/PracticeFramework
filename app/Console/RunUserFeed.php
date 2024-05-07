<?php

namespace App\Console;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'feed:user',
    description: 'Creates set of users',
    hidden: false,
    aliases: ['user']
)]
class RunUserFeed extends Command
{
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'User Creator',
            '============',
            '',
        ]);

        $output->write('User has been created.');

        return Command::SUCCESS;
    }
}
