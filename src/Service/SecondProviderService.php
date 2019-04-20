<?php
/**
 * Created by PhpStorm.
 * User: volki
 * Date: 20.04.2019
 * Time: 18:45
 */

namespace App\Service;


use App\Entity\Currency;
use App\Entity\Provider;
use App\Interfaces\ProviderInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Unirest;

class SecondProviderService implements ProviderInterface
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

    function addProvider(Provider $provider): array
    {
        $response = Unirest\Request::get($this->endPointUrl);
        $result = json_decode($response->raw_body, true);
        $symbol = "";
        foreach ($result as $currencies) {
            if ($currencies["kod"] == "DOLAR") {
                $symbol = "USDTRY";
            }
            if ($currencies["kod"] == "AVRO") {
                $symbol = "EURTRY";
            }
            if ($currencies["kod"] == "İNGİLİZ STERLİNİ") {
                $symbol = "GBPTRY";
            }
             $this->em->getRepository(Provider::class)->addProviderValues($symbol,$currencies["oran"],$provider);
        }
        return array();
    }
}