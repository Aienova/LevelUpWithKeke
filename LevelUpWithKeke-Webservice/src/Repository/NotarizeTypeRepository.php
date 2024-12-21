<?php

namespace App\Repository;

use App\Entity\NotarizeType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NotarizeType>
 *
 * @method NotarizeType|null find($id, $lockMode = null, $lockVersion = null)
 * @method NotarizeType|null findOneBy(array $criteria, array $orderBy = null)
 * @method NotarizeType[]    findAll()
 * @method NotarizeType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotarizeTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NotarizeType::class);
    }

//    /**
//     * @return NotarizeType[] Returns an array of NotarizeType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NotarizeType
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

   public function findByAuthentication($boolean): array
   {
    return $this->createQueryBuilder('n')
               ->andWhere('n.consularDocument = :bool')
               ->setParameter('bool', $boolean)
                ->orderBy('n.id', 'ASC')
                ->getQuery()
               ->getResult()
            ;
   }


 

            }
