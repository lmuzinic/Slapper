<?php

namespace Slapper\Console\Command;

use Slapper\Payload;
use Slapper\Request;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Send extends Command
{
    protected function configure()
    {
        $this
            ->setName('send')
            ->setDescription('Send message to Slack')
            ->addArgument(
                'text',
                InputArgument::REQUIRED,
                'What do you want to send?'
            )
            ->addOption(
                'channel',
                'c',
                InputOption::VALUE_OPTIONAL,
                'Name the channel for the message'
            )
            ->addOption(
                'username',
                'u',
                InputOption::VALUE_OPTIONAL,
                'Define username or fallback to default one'
            )
            ->addOption(
                'emoji',
                'e',
                InputOption::VALUE_OPTIONAL,
                'Define Emoji or fallback to default one'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $text = $input->getArgument('text');
        if ($text) {
            $payload = new Payload($text);
        }

        $channel = $input->getOption('channel');
        if ($channel) {
            $payload->channel = $channel;
        }

        $username = $input->getOption('username');
        if ($username) {
            $payload->username = $username;
        }

        $emoji = $input->getOption('emoji');
        if ($emoji) {
            $payload->icon_emoji = $emoji;
        }

        $request = new Request($payload, parse_ini_file('slapper.conf'));
        $request->send();
    }
} 