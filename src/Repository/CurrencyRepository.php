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

    // /**
    //  * @return Currency[] Returns an array of Currency objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Currency
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getEuroCurrency(){

        return $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.symbol = :symbol')
            ->setParameter('symbol','EURTR')
            ->orWhere('c.symbol = :trSymbol')
            ->setParameter('trSymbol','AVRO')
            ->setMaxResults(1)
            ->orderBy('c.quantity',"ASC")
            ->getQuery()
            ->getResult();
    }
    public function getDolarCurrency(){

        return $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.symbol = :symbol')
            ->setParameter('symbol','DOLAR')
            ->orWhere('c.symbol = :trSymbol')
            ->setParameter('trSymbol','USDTR')
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
            ->orWhere('c.symbol = :trSymbol')
            ->setParameter('trSymbol','İNGİL')
            ->setMaxResults(1)
            ->orderBy('c.quantity',"ASC")
            ->getQuery()
            ->getResult();
    }
}
