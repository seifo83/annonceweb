<?php

namespace App\Repository;

use App\Entity\Annonce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Annonce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Annonce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Annonce[]    findAll()
 * @method Annonce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnonceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Annonce::class);
    }



    //creer une méthode pour récuperer la liste des villes(sans doublon) de la table annonce



    public function findVille(){

        //on appel à l'EntityManager depuis des méthodes du repository.

        // Méthode 1 : en passant par l'EntityManager
        // Dans un repository, $this->_entityName est le namespace de l'entité gérée


        /*------ méthod1:  prof pour récuperer les ville --------*/

       
        /*
            return $this->createQueryBuilder('a')
                                    ->select('a.ville')
                                    ->distinct(true)
                                    ->orderBy('a.ville', 'ASC')
                                    ->getQuery()
                                    ->getResult()
                                    ;
                                    */
           

        /*------- method2:  pour récupere les villes ------*/
            // nversion avec EntityManager
        
            $entitymanager = $this->getEntityManager();
            $requete = $entitymanager->createQuery("SELECT DISTINCT a.ville from App\Entity\Annonce a ORDER BY a.ville ");
            return $requete->getResult();

            


        

    }
        
        
        
        
        /*    -------Ma methode que j'ai trouvé sur internet ---------

        $queryBuilder = $this->_em->createQueryBuilder()
            ->select('a.ville')
            ->from($this->_entityName, 'a')
            ->distinct(true);


        // On récupère la Query à partir du QueryBuilder
        $query = $queryBuilder->getQuery();

        // On récupère les résultats à partir de la Query
        $results = $query->getResult();

        // On retourne ces résultats
        return $results;

        */



    /*
        $q = new Doctrine();
    
            $q->select('{e.ville}')
            ->from('annonce e')
            ->addComponent('e', 'annonce')
            ->distinct(true);
        
            return $q->execute();
    */



        // /**
        //  * @return Annonce[] Returns an array of Annonce objects
        //  */
        /*
        public function findByExampleField($value)
        {
            return $this->createQueryBuilder('a')
                ->andWhere('a.exampleField = :val')
                ->setParameter('val', $value)
                ->orderBy('a.id', 'ASC')
                ->setMaxResults(10)
                ->getQuery()
                ->getResult()
            ;
        }
        */

        /*
        public function findOneBySomeField($value): ?Annonce
        {
            return $this->createQueryBuilder('a')
                ->andWhere('a.exampleField = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        }
        */
    }
