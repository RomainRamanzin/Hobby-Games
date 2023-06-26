<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function save(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllSorted(): array
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.publication_date', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findLastArticles(int $limit = 3): array
    {
        return $this->createQueryBuilder('a')
            ->where('a.is_valided = true')
            ->orderBy('a.publication_date', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function filterQuery($title)
    {
        $query = $this->createQueryBuilder('a')
            ->where('a.is_valided = true')
            ->orderBy('a.publication_date', 'DESC');

        //Si le titre n'est pas vide
        if ($title) {
            $query->andWhere('a.title LIKE :title')
                ->setParameter('title', '%' . $title . '%');
        }

        return $query->getQuery()->getResult();
    }

    //    public function findOneBySomeField($value): ?Article
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
