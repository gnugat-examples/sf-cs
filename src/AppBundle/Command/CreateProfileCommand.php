<?php
// File: src/AppBundle/Command/CreateProfileCommand.php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateProfileCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('app:profile:create');
        $this->setDescription('Create a new profile');

        $this->addArgument('name', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $profileGateway = $this->getContainer()->get('app.profile_gateway');

        $profile = $profileGateway->create($input->getArgument('name'));

        $output->writeln(sprintf('Profile #%s "%s" created', $profile['id'], $profile['name']));
    }
}
