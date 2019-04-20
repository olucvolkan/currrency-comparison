<?php
/**
 * Created by PhpStorm.
 * User: volki
 * Date: 20.04.2019
 * Time: 18:21
 */

namespace App\Service;


use App\Entity\Currency;
use App\Entity\Provider;
use App\Interfaces\ProviderInterface;
use App\Repository\CurrencyRepository;
use App\Repository\ProviderRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Unirest;

class FirstProviderService implements ProviderInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;
    /** @var EntityManager */
    private $em;
    private $endPointUrl;

    public function __construct(ContainerInterface $container,string $endPointUrl = null)
    {
        $this->container = $container;
        $this->em = $this->container->get('doctrine')->getManager();
        $this->endPointUrl = $endPointUrl;

    }

    /**
     * @param \App\Entity\Provider $provider
     * @return array
     */
    function addProvider(Provider $provider): array
    {
        $response = Unirest\Request::get($this->endPointUrl);
        $result = json_decode($response->raw_body, true);
        foreach ($result as $currencies) {
            foreach ($currencies as $currency) {
                $this->em->getRepository(Provider::class)->addProviderValues($currency["symbol"],$currency["amount"],$provider);
            }
        }
    return array();
    }
}