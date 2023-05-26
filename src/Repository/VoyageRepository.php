<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Voyage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @extends ServiceEntityRepository<Voyage>
 *
 * @method Voyage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voyage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voyage[]    findAll()
 * @method Voyage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoyageRepository extends ServiceEntityRepository
{
    private $paginator;
    
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Voyage::class);
        $this->paginator = $paginator;
    }

    public function add(Voyage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Voyage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function findSearch(SearchData $search):PaginationInterface
    {
        $query = $this
            ->createQueryBuilder('p')//p=voy et c=ville_dep c2=ville_arrive
            ->select('c','p','c2')
            ->join('p.ville_depart', 'c')
            ->join('p.ville_arrive', 'c2');
        
        if (!empty($search->q)){ //permet de filtrer par rapport à la rechercher et filtre les ville 
            $query = $query
                ->andWhere('c.nom_ville LIKE :q')
                ->orWhere('c2.nom_ville LIKE :q')
                ->setParameter('q', "%{$search->q}%");
        }
        if (!empty($search->ville)){ //filtre par rapport au form les villes
            $query = $query
                ->andWhere('c.id IN (:ville)')
                ->orWhere('c2.id IN (:ville)')
                ->setParameter('ville', $search->ville);
        }
        $query = $query->getQuery();
        return $this->paginator->paginate(
            $query,
            $search->page,
            2 //nombre de voyage sur une la page
        );
    }
}
