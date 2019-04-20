<?php
/**
 * Created by PhpStorm.
 * User: volki
 * Date: 30.03.2019
 * Time: 16:06
 */

namespace App\Service;

use App\Entity\Provider;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ProviderService
{


    /**
     * @var ContainerInterface
     */
    private $container;
    /** @var EntityManager */
    private $em;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->em = $this->container->get('doctrine')->getManager();
    }


    /**
     * @param $name
     * @param $endpointUrl
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createProvider($name, $endpointUrl)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $provider = new Provider();
        $provider->setName($name);
        $provider->setProviderEndpointUrl($endpointUrl);
        $em->persist($provider);
        $em->flush();

    }




}