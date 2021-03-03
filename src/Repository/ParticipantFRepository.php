<?php

namespace App\Repository;

use App\Entity\ParticipantF;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ParticipantF|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParticipantF|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParticipantF[]    findAll()
 * @method ParticipantF[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipantFRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParticipantF::class);
    }

    // /**
    //  * @return ParticipantF[] Returns an array of ParticipantF objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ParticipantF
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
