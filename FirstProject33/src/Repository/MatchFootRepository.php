<?php

namespace App\Repository;

use App\Entity\MatchFoot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MatchFoot|null find($id, $lockMode = null, $lockVersion = null)
 * @method MatchFoot|null findOneBy(array $criteria, array $orderBy = null)
 * @method MatchFoot[]    findAll()
 * @method MatchFoot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatchFootRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MatchFoot::class);
    }
    public function OrderByNbrSpectateurQB(){
        return $this->createQueryBuilder('m')//select
        ->orderBy('m.nbr_spectateur','ASC')
            ->getQuery()->getResult()
            ;

    }

    // /**
    //  * @return MatchFoot[] Returns an array of MatchFoot objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MatchFoot
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
