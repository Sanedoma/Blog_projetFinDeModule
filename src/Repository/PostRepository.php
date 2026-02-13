<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    /**
     * Find posts with optional filters
     * @return Post[] Returns an array of Post objects
     */
    public function findWithFilters(?int $categoryId = null, ?int $authorId = null, ?string $dateFrom = null, ?string $dateTo = null): array
    {
        $qb = $this->createQueryBuilder('p')
            ->orderBy('p.publishAt', 'DESC');

        if ($categoryId) {
            $qb->andWhere('p.category = :category')
               ->setParameter('category', $categoryId);
        }

        if ($authorId) {
            $qb->andWhere('p.user = :user')
               ->setParameter('user', $authorId);
        }

        if ($dateFrom) {
            $qb->andWhere('p.publishAt >= :dateFrom')
               ->setParameter('dateFrom', new \DateTime($dateFrom));
        }

        if ($dateTo) {
            // Add one day to include the entire day
            $endDate = new \DateTime($dateTo);
            $endDate->modify('+1 day');
            $qb->andWhere('p.publishAt < :dateTo')
               ->setParameter('dateTo', $endDate);
        }

        return $qb->getQuery()->getResult();
    }

    //    /**
    //     * @return Post[] Returns an array of Post objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Post
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
