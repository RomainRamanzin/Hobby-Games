<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Game>
 *
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    public function save(Game $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Game $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function paginatorQuery()
    {
        return $this->createQueryBuilder('g')
            ->orderBy('g.id', 'ASC')
            ->getQuery();
    }

    public function filterQuery($search, $type, $platform)
    {
        $query = $this->createQueryBuilder('g')
            ->orderBy('g.id', 'ASC');

        if ($search) {
            $query->andWhere('g.name LIKE :search')
                ->setParameter('search', '%' . $search . '%');
        }

        if ($type) {

            $query->join('g.types', 't')
                ->andWhere('t = :type')
                ->setParameter('type', $type);
        }

        if ($platform) {
            $query->join('g.platforms', 'p')
                ->andWhere('p = :platform')
                ->setParameter('platform', $platform);
        }

        return $query->getQuery()->getResult();
    }


    //recupérer les jeux don la date de sortie est supérieure à la date du jour
    public function findUpcomingGames()
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.release_date > :date')
            ->setParameter('date', new \DateTime())
            ->orderBy('g.release_date', 'ASC')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult();
    }

    //recupérer les jeux dont la date de sortie est inférieure à la date du jour
    public function findLastGames()
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.release_date < :date')
            ->setParameter('date', new \DateTime())
            ->orderBy('g.release_date', 'DESC')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Game[] Returns an array of Game objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Game
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
