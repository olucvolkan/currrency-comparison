<?php

namespace App\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\Provider;


class SecondProviderCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'second-provider';

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $endPoint = $this->getContainer()->get('doctrine')->getRepository(Provider::class)->findOneBy(array('id' => 2));
        $this->getContainer()->get('app.service.second_provider_service')->addProvider($endPoint);
        $io->success('Second provider currencies added');
    }
}
