<?php

namespace App\Repository;

use App\Entity\Currency;
use App\Entity\Provider;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Provider|null find($id, $lockMode = null, $lockVersion = null)
 * @method Provider|null findOneBy(array $criteria, array $orderBy = null)
 * @method Provider[]    findAll()
 * @method Provider[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProviderRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Provider::class);
    }

    public function addProviderValues($symbol,$quantity,Provider $provider){
        $currency = new Currency();
        $currency->setSymbol($symbol);
        $currency->setQuantity($quantity);
        $currency->setProviderId($provider);
        $this->_em->persist($currency);
        $this->_em->flush();
        return $currency;
    }
}
