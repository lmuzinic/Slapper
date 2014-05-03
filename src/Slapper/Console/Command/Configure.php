<?php

namespace Slapper\Console\Command;

use Slapper\Payload;
use Slapper\Request;
use Slapper\Configuration;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Configure extends Command
{
    protected function configure()
    {
        $this
            ->setName('configure')
            ->setDescription('Store token and team URL information')
            ->addOption(
                'token',
                null,
                InputOption::VALUE_REQUIRED,
                'Token, --token=J3qYaBV732Xp912dsaMqo0bvp'
            )
            ->addOption(
                'team',
                null,
                InputOption::VALUE_REQUIRED,
                'Team URL, --team=name for https://name.slack.com'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $configuration = new Configuration('slapper.conf');
            $configuration->token = $input->getOption('token');
            $configuration->teamUrl = $input->getOption('team');
            if ($configuration->save()) {
                $output->writeln('Configuration saved!');
            };
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
        }
    }
} 