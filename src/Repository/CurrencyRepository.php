<?php

namespace App\Repository;

use App\Entity\Currency;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Currency|null find($id, $lockMode = null, $lockVersion = null)
 * @method Currency|null findOneBy(array $criteria, array $orderBy = null)
 * @method Currency[]    findAll()
 * @method Currency[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrencyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Currency::class);
    }

    public function getEuroCurrency(){

        return $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.symbol = :symbol')
            ->setParameter('symbol','EURTR')
            ->setMaxResults(1)
            ->orderBy('c.quantity',"ASC")
            ->getQuery()
            ->getResult();
    }
    public function getDollarCurrency(){

        return $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.symbol = :symbol')
            ->setParameter('symbol','USDTR')
            ->setMaxResults(1)
            ->orderBy('c.quantity',"ASC")
            ->getQuery()
            ->getResult();
    }

    public function getGbpCurrency(){

        return $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.symbol = :symbol')
            ->setParameter('symbol','GBPTR')
            ->setMaxResults(1)
            ->orderBy('c.quantity',"ASC")
            ->getQuery()
            ->getResult();
    }
}
