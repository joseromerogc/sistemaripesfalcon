<?php

namespace MisionSucre\RipesBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * DocenteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DocenteRepository extends EntityRepository
{
    public function findDocenteByUserAndId($aldea,$user)
    {
          return $this->getEntityManager()
            ->createQuery(
                'SELECT d FROM MisionSucreRipesBundle:Docente d
                    WHERE d.user=:user AND d.aldea=:aldea
                '
            )
            ->setParameters(array('user'=>$user,'aldea'=>$aldea))->getOneOrNullResult();
    }
    
    public function findAllOrderedByAldea($idaldea){
        
        return $this->getEntityManager()
            ->createQuery(
                'SELECT DISTINCT d.id,u.username,p.priNom,p.segNom, p.priApe, p.segApe, p.cedPer, p.sexPer,
                    u.id as idusr,d.unidadescurriculares, d.horas,p.celPer,p.telPer,d.exclusividad
                    FROM MisionSucreRipesBundle:Persona p, MisionSucreRipesBundle:User u,
                    MisionSucreRipesBundle:Docente d 
                    WHERE p.user=u.id AND d.user=u.id AND d.aldea =:idaldea
                    '
            )
            ->setParameter('idaldea', $idaldea)      
            ->getResult();
    }
    public function findByAldea($idaldea){
        
        return $this->getEntityManager()
            ->createQuery(
                'SELECT  IDENTITY(p.user) AS u, p.priNom,p.segNom, p.priApe, p.segApe, p.cedPer, p.sexPer
                    ,p.celPer,p.telPer, doc AS d FROM MisionSucreRipesBundle:Aldea a JOIN a.parroquia prq,
                    MisionSucreRipesBundle:Docente doc, MisionSucreRipesBundle:Persona p
                    WHERE doc.aldea = :idaldea AND doc.aldea = a.id  AND doc.user = p.user
                    '
            )
            ->setParameter('idaldea', $idaldea)      
            ->getResult();
    }
    
    public function findByAldeaAndUser($idaldea,$idusr){
        
        return $this->getEntityManager()
            ->createQuery(
                'SELECT d
                    FROM MisionSucreRipesBundle:Docente d
                    WHERE d.user=:idusr AND d.aldea =:idaldea
                    '
            )
            ->setParameters(array('idaldea'=> $idaldea,'idusr'=> $idusr))      
            ->getResult();
    }
    
    public function findByEjeAndUser($eje,$idusr){
        
        return $this->getEntityManager()
            ->createQuery(
                'SELECT d
                    FROM MisionSucreRipesBundle:Docente d JOIN d.aldea a JOIN a.parroquia prq
                    WHERE d.user=:idusr AND prq.eje = :eje
                    '
            )
            ->setParameters(array('eje'=> $eje,'eje'=> $idusr))      
            ->getResult();
    }
    
    public function cantidadAldea($aldea)
    {
          return $this->getEntityManager()
            ->createQuery(
                'SELECT COUNT (d) as cantidaddocentes FROM MisionSucreRipesBundle:Docente d
                            WHERE d.aldea = :aldea   
                    '
            )
            ->setParameters(array('aldea'=> $aldea))      
            ->getSingleResult();
    }
    
    //para la lista de docente
    public function findAllOrderedByEje($eje)
    {
          return $this->getEntityManager()
            ->createQuery(
                'SELECT  IDENTITY(p.user) AS u, p.priNom,p.segNom, p.priApe, p.segApe, p.cedPer, p.sexPer
                    ,p.celPer,p.telPer, doc AS d FROM MisionSucreRipesBundle:Aldea a JOIN a.parroquia prq,
                    MisionSucreRipesBundle:Docente doc, MisionSucreRipesBundle:Persona p
                    WHERE prq.eje = :eje AND doc.aldea = a.id  AND doc.user = p.user
                    '
            )
            ->setParameter('eje', $eje)      
            ->getResult();
    }
    
    public function findAllOrderedByUser()
    {
          return $this->getEntityManager()
            ->createQuery(
                'SELECT  IDENTITY(p.user) AS u, p.priNom,p.segNom, p.priApe, p.segApe, p.cedPer, p.sexPer
                    ,p.celPer,p.telPer, doc AS d FROM MisionSucreRipesBundle:Aldea a JOIN a.parroquia prq,
                    MisionSucreRipesBundle:Docente doc, MisionSucreRipesBundle:Persona p
                    WHERE doc.aldea = a.id  AND doc.user = p.user
                '
            )
            ->getResult();
    }
    
    
}
