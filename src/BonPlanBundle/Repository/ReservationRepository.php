<?php
/**
 * Created by PhpStorm.
 * User: firas
 * Date: 30/03/2018
 * Time: 00:32
 */

namespace BonPlanBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ReservationRepository  extends EntityRepository
{

    public function findByuserV($user){
        $query=$this->createQueryBuilder('c')
            ->where('c.userVisiteur= :user_iduser')

            ->setParameter(':user_iduser',$user);

        return $query->getQuery()->getResult();
    }
}