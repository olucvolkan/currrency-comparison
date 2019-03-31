<?php
/**
 * Created by PhpStorm.
 * User: volki
 * Date: 31.03.2019
 * Time: 13:36
 */

namespace App\Service;


use App\Entity\Currency;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CurrencyService
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


}