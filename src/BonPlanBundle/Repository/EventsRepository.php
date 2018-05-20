<?php
/**
 * Created by PhpStorm.
 * User: meyss
 * Date: 03/04/2018
 * Time: 23:38
 */

namespace BonPlanBundle\Repository;

use Doctrine\ORM\EntityRepository;

class EventsRepository extends EntityRepository
{
    public function findByUser($user)
    { $query = $this->createQueryBuilder('e')
            ->where('e.userPlan= :user_iduser')

            ->setParameter(':user_iduser',$user);

        return $query->getQuery()->getResult();
    }

    public function findPublic()
     {
         $query = $this->createQueryBuilder('e')
             ->where('e.type LIKE :publique ')
         ->setParameter(':publique','publique');
           return $query->getQuery()->getResult();
     }

    public function findByEtat($word)
    {

        $query = $this->createQueryBuilder('e')
            ->where('e.etatev LIKE :word')
            ->setParameter('word', '%'.$word.'%');

        return $query->getQuery()->getResult();
    }


}


