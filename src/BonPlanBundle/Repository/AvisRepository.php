<?php
/**
 * Created by PhpStorm.
 * User: Ali
 * Date: 08/04/2018
 * Time: 16:09
 */

namespace BonPlanBundle\Repository;
use BonPlanBundle\Entity\Avis;


class AvisRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByCommentaire($id_P)
    {
        $q=$this->createQueryBuilder('s')
            ->where('s.userPlan = :idPlan')
            ->setParameter(':idPlan',$id_P)
            ->orderBy('s.datecomment' , 'DESC');
        return $q->getQuery()->getResult();
    }

    public function findByProp($id_P)
    {
        $q=$this->getEntityManager()
            ->createQuery("select u.id from BonPlanBundle:Avis a JOIN BonPlanBundle:USER u WHERE u.id=a.userPlan AND a.idavis=:id")
            ->setParameter(":id",$id_P);

        return $q->getResult();
    }
    public function findByuserP($user){
        $query=$this->createQueryBuilder('c')
            ->where('c.userPlan= :user_iduser1')

            ->setParameter(':user_iduser1',$user);

        return $query->getQuery()->getResult();
    }

}