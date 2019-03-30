<?php
/**
 * Created by PhpStorm.
 * User: volki
 * Date: 30.03.2019
 * Time: 16:06
 */

namespace App\Service;

use App\Entity\Currency;
use App\Entity\Provider;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use function dump;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Unirest;

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

    public function addFirstProviderCurrencies($endpointUrl, $provider)
    {
        $response = Unirest\Request::get($endpointUrl);
        $result = json_decode($response->raw_body, true);
        foreach ($result as $currencies) {
            foreach ($currencies as $currency) {
                $currencyProvider = new Currency();
                $currencyProvider->setSymbol($currency["symbol"]);
                $currencyProvider->setQuantity($currency["amount"]);
                $currencyProvider->setProviderId($provider);
                $this->em->persist($currencyProvider);
                $this->em->flush();
            }
        }
    }


    public function addSecondProviderCurrencies($endpointUrl, $provider)
    {
        $response = Unirest\Request::get($endpointUrl);
        $result = json_decode($response->raw_body, true);
        foreach ($result as $currencies) {
            $currencyProvider = new Currency();
            $currencyProvider->setSymbol($currencies["kod"]);
            $currencyProvider->setQuantity($currencies["oran"]);
            $currencyProvider->setProviderId($provider);
            $this->em->persist($currencyProvider);
            $this->em->flush();
        }

    }


}