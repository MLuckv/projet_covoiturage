<?php

namespace App\Repository;

use App\Entity\Voyage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voyage::class);
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

    public function paginationQuery()
    {
        return $this->createQueryBuilder('v')
            ->orderBy('v.created_at', 'ASC')
            ->getQuery()
        ;
    }




    //public function findByVilleIds($filters = [])
    //{
    //    $query = $this->createQueryBuilder('v')
    //        ->where('v.active = 1');
        // On filtre les données
    //    if (!empty($filters)) {
    //        $query->join('v.villeDepart', 'vd')
    //            ->join('v.villeArrive', 'va')
    //            ->andWhere('vd.id IN (:villes) OR va.id IN (:villes)')
    //            ->setParameter(':villes', array_values($filters));
    //    }
    //   $query->orderBy('v.nomVoyage');
    //    return $query->getQuery()->getResult();
    //}

    //verifie requete ajax à mettre dans le travel controller 
    // if($request->get('ajax')){
    //    return new JsonResponse([
    //        'content' => $this->renderView('travel/_content.html.twig', 
    //            ['pagination' => $pagination, 'ville' => $ville])
    //    ]);
    //}
    //réccupere les filtre
    // $filters = $request->get("ville");

    //    public function findOneBySomeField($value): ?Voyage
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
