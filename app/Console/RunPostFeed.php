<?php

namespace App\Console;

use App\Feed\PostFeed;
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

        $postFeed = new PostFeed();

        $postFeed->run();

        $output->write('Posts has been created.');

        return Command::SUCCESS;
    }
}
