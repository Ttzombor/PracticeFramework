<?php

namespace App\Console;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'mode:set',
    description: 'Set application mode',
    hidden: false,
    aliases: ['mode']
)]
class ApplicationMode extends Command
{
    public array $availableModes = [
        'development' => [
            'dev',
            'development',
            'develop'
        ],
        'production' => [
            'prod',
            'production'
        ]
    ];
    protected function configure(): void
    {
        $this->addArgument('mode', InputArgument::REQUIRED, 'Set application mode');
    }
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $arguments = $input->getArguments();
        $mode = $arguments['mode'];

        if ($mode = $this->getMode($mode)) {
            $appFile = require 'config/app.php';
            $oldValue = $appFile['mode'];
            $configs = file_get_contents('config/app.php', true);
            $configs = str_replace("$oldValue", "$mode", $configs);
            file_put_contents('config/app.php', $configs);

            $output->write('The new mode has been set.');
        } else {
            $output->write('No such mode found. Please use development or production.');
        }

        return Command::SUCCESS;
    }

    private function getMode($mode) {
        foreach ($this->availableModes as $key => $value) {
            if (in_array($mode, $value)) {
                return $key;
            }
        }
    }
}
