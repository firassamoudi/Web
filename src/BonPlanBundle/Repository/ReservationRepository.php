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

    public function findByuserP($user){
        $query=$this->createQueryBuilder('c')
            ->where('c.userPlan= :user_iduser1')

            ->setParameter(':user_iduser1',$user);

        return $query->getQuery()->getResult();
    }
    //0 non lu
    //1 notif lu

    public function findByNotig($user){
        $query=$this->createQueryBuilder('c')
            ->where('c.userPlan = :user_iduser1')
            ->andWhere('c.notif = 0')
            ->setParameter(':user_iduser1',$user);

        return $query->getQuery()->getArrayResult();
    }
    public function Updatenotif($user){

        $nbr = 1;
        $query=$this->createQueryBuilder('c')->update()
            ->set('c.notif ', $nbr)
            ->where('c.userPlan= :user_iduser1')
            ->setParameter(':user_iduser1',$user);

        return $query->getQuery()->getResult();
    }
}