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
            ->createQueryBuilder('voy')//voy=voyage et city_str=ville_dep city_end=ville_arrive q= recherche
            ->select('city_str','voy','city_end')
            ->join('voy.ville_depart', 'city_str')
            ->join('voy.ville_arrive', 'city_end');
        
        if (!empty($search->q)){ //permet de filtrer par rapport à la rechercher et filtre les ville 
            $query = $query
                ->andWhere('city_str.nom_ville LIKE :q')
                ->orWhere('city_end.nom_ville LIKE :q')
                ->orWhere('voy.prix LIKE :q')
                ->setParameter('q', "%{$search->q}%");
        }
        if (!empty($search->ville_depart)){ //filtre par rapport au form les villes
            $query = $query
                ->andWhere('city_str.id IN (:ville_depart)')
                ->setParameter('ville_depart', $search->ville_depart);
        }
        if (!empty($search->ville_arrive)){ //filtre par rapport au form les villes
            $query = $query
                ->andWhere('city_end.id IN (:ville_arrive)')
                ->setParameter('ville_arrive', $search->ville_arrive);
        }
        $query = $query->getQuery();
        return $this->paginator->paginate(
            $query,
            $search->page,
            2 //nombre de voyage sur une la page
        );
    }
}
