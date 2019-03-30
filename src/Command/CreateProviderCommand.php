<?php

namespace App\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateProviderCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'app:create-provider';

    protected function configure()
    {
        $this
            ->setDescription('Add a provider')
            ->addArgument('name', InputArgument::REQUIRED, 'Argument description')
            ->addArgument('endpointUrl', InputArgument::REQUIRED, 'Provider Endpoint Url')
        ;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return int|null|void
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $name = $input->getArgument('name');
        $endPointUrl = $input->getArgument('endpointUrl');
        $this->getContainer()->get('app.service.provider_service')->createProvider($name,$endPointUrl);

        $io->success('Created Provider!');
    }
}
