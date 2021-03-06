<?php

namespace MisionSucre\RipesBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CoordinadorEjeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CoordinadorEjeRepository extends EntityRepository
{
    public function findAllOrderedByUser()
    {
          return $this->getEntityManager()
            ->createQuery(
                'SELECT DISTINCT u.id, u.username FROM MisionSucreRipesBundle:User u WHERE u.tip_usr=8  AND NOT EXISTS
                   ( SELECT ej FROM MisionSucreRipesBundle:CoordinadorEje ej WHERE u.id=ej.user  ) '
            )
            ->getResult();
    }
    
    public function findAllOrderedByEje()
    {
          return $this->getEntityManager()
            ->createQuery(
                'SELECT DISTINCT e.id, e.nombre FROM MisionSucreRipesBundle:Eje e WHERE NOT EXISTS
                   ( SELECT ej FROM MisionSucreRipesBundle:CoordinadorEje ej WHERE e.id=ej.eje)'
            )
            ->getResult();
    }
    
    public function findAllByEje($eje)
    {
          return $this->getEntityManager()
            ->createQuery(
                "SELECT u.username, u.id,r.id AS idrole, r.name FROM MisionSucreRipesBundle:Role r, MisionSucreRipesBundle:User u 
                    WHERE r.id=u.tip_usr AND(
                            (u.tip_usr=5 AND EXISTS 
                            ( SELECT ca FROM MisionSucreRipesBundle:CoordinadorAldea ca JOIN ca.aldea a JOIN a.parroquia prq
                            WHERE u.id=ca.user AND prq.eje =:eje )) OR
                            (u.tip_usr=6 AND EXISTS ( SELECT t FROM MisionSucreRipesBundle:Triunfador t JOIN t.ambiente am JOIN 
                            am.aldea at JOIN at.parroquia prqt
                            WHERE u.id=t.user AND prqt.eje =:eje ))
                            OR
                            (u.tip_usr=7 AND EXISTS 
                            ( SELECT d FROM MisionSucreRipesBundle:Docente d JOIN d.aldea ad JOIN ad.parroquia prqd
                            WHERE u.id=d.user AND prqd.eje =:eje)) OR
                            (u.tip_usr=9 AND EXISTS 
                            ( SELECT o FROM MisionSucreRipesBundle:Operario o JOIN o.aldea ao JOIN ao.parroquia prqo
                            WHERE u.id=o.user AND prqo.eje =:eje))

                            )
                            ORDER BY u.username
                        "
            )
            ->setParameter('eje',$eje)      
            ->getResult();
    }
    
    public function findAllByEjeAndUser($eje,$username,$role)
    {
          return $this->getEntityManager()
            ->createQuery(
                "SELECT u.username, u.id,r.id AS idrole, r.name FROM MisionSucreRipesBundle:Role r, MisionSucreRipesBundle:User u 
                    WHERE r.id=u.tip_usr AND u.username LIKE :username AND r.id=:role AND(
                            (u.tip_usr=5 AND EXISTS 
                            ( SELECT ca FROM MisionSucreRipesBundle:CoordinadorAldea ca JOIN ca.aldea a JOIN a.parroquia prq
                            WHERE u.id=ca.user AND prq.eje =:eje )) OR
                            (u.tip_usr=6 AND EXISTS ( SELECT t FROM MisionSucreRipesBundle:Triunfador t JOIN t.ambiente am JOIN 
                            am.aldea at JOIN at.parroquia prqt
                            WHERE u.id=t.user AND prqt.eje =:eje ))
                            OR
                            (u.tip_usr=7 AND EXISTS 
                            ( SELECT d FROM MisionSucreRipesBundle:Docente d JOIN d.aldea ad JOIN ad.parroquia prqd
                            WHERE u.id=d.user AND prqd.eje =:eje)) OR
                            (u.tip_usr=9 AND EXISTS 
                            ( SELECT o FROM MisionSucreRipesBundle:Operario o JOIN o.aldea ao JOIN ao.parroquia prqo
                            WHERE u.id=o.user AND prqo.eje =:eje))

                            )
                            ORDER BY u.username
                        "
            )->setParameters(array('username'=>"%$username%",'role'=>$role,'eje'=>$eje))      
            ->getResult();
    }
    
}

