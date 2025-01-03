<?php

namespace App\Repository;

use App\Entity\Messaging;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Messaging>
 *
 * @method Messaging|null find($id, $lockMode = null, $lockVersion = null)
 * @method Messaging|null findOneBy(array $criteria, array $orderBy = null)
 * @method Messaging[]    findAll()
 * @method Messaging[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessagingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Messaging::class);
    }

//    /**
//     * @return Messaging[] Returns an array of Messaging objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Messaging
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

   public function findByConversationId($conversationid): ?array
     {
     return $this->createQueryBuilder('m')
      ->andWhere('m.conversationId = :val')
      ->setParameter('val', $conversationid)
      ->getQuery()
      ->getResult()
       ;
     }



}
