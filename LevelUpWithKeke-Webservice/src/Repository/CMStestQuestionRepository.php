<?php

namespace App\Repository;

use App\Entity\CMStestQuestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMStestQuestion>
 *
 * @method CMStestQuestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMStestQuestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMStestQuestion[]    findAll()
 * @method CMStestQuestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMStestQuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMStestQuestion::class);
    }

//    /**
//     * @return CMStestQuestion[] Returns an array of CMStestQuestion objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CMStestQuestion
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
