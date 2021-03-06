<?php

namespace MisionSucre\RipesBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TriunfadorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TriunfadorRepository extends EntityRepository
{
    public function findAllOrderedByAmbiente($idamb){
        
        return $this->getEntityManager()
            ->createQuery(
                'SELECT DISTINCT t.id,u.username,p.priNom,p.segNom, p.priApe, p.segApe, p.cedPer, p.sexPer,t.condicion, u.id as idusr
                    ,p.celPer,p.telPer, t.becamision, t.sistema
                    FROM MisionSucreRipesBundle:Persona p, MisionSucreRipesBundle:User u,
                    MisionSucreRipesBundle:Triunfador t
                    WHERE p.user=u.id AND t.user=u.id AND t.ambiente =:idamb
                    ORDER BY p.priNom, p.segNom
                    '
            )
            ->setParameter('idamb', $idamb)      
            ->getResult();
    }
    
    public function cantidadAldea($aldea)
    {
          return $this->getEntityManager()
            ->createQuery(
                'SELECT COUNT (t) as cantidadtriunfadores FROM MisionSucreRipesBundle:Triunfador t JOIN t.ambiente a
                            WHERE a.aldea = :aldea  AND a.condicion !=:egresado
                            AND a.condicion !=:culminado
                    '
            )
            ->setParameters(array('aldea'=> $aldea, 'egresado'=>'Egresado','culminado'=>'Culminado'))      
            ->getSingleResult();
    }
    public function cantidadAldeaTurno($idcoordinador)
    {
          return $this->getEntityManager()
            ->createQuery(
                'SELECT COUNT (t) as cantidadtriunfadores FROM MisionSucreRipesBundle:Triunfador t JOIN t.ambiente a,
                    MisionSucreRipesBundle:CoordinadorTurno tu JOIN tu.coordinador c
                            WHERE c.id = :idcoordinador  AND a.condicion !=:egresado AND c.aldea = a.aldea AND tu.turno=a.turno
                            AND a.condicion !=:culminado
                    '
            )
            ->setParameters(array('idcoordinador'=> $idcoordinador, 'egresado'=>'Egresado','culminado'=>'Culminado'))      
            ->getSingleResult();
    }
    
    public function cantidadAldeanovinculados($aldea)
    {
          return $this->getEntityManager()
            ->createQuery(
                'SELECT COUNT (t) as cantidadtriunfadores FROM MisionSucreRipesBundle:Triunfador t JOIN t.ambiente a
                            WHERE a.aldea = :aldea AND upper(t.sistema) LIKE :parametro 
                    '
            )
            ->setParameters(array('aldea'=> $aldea,'parametro'=>"NO"))      
            ->getSingleResult();
    }
    
    public function cantidadAldeanovinculadosTurnos($idcoordinador)
    {
          return $this->getEntityManager()
            ->createQuery(
                'SELECT COUNT (t) as cantidadtriunfadores FROM MisionSucreRipesBundle:Triunfador t JOIN t.ambiente a,
                    MisionSucreRipesBundle:CoordinadorTurno tu JOIN tu.coordinador c
                            WHERE c.id = :idcoordinador AND c.aldea = a.aldea AND tu.turno=a.turno AND upper(t.sistema) LIKE :parametro 
                    '
            )
            ->setParameters(array('idcoordinador'=> $idcoordinador,'parametro'=>"NO"))      
            ->getSingleResult();
    }
    
    public function findAllByAldea($aldea)
    {
          return $this->getEntityManager()
            ->createQuery(
                'SELECT  IDENTITY(p.user) AS id,p.priNom,p.segNom, p.priApe, p.segApe, p.cedPer, p.sexPer
                    ,p.celPer,p.telPer, trf AS t FROM MisionSucreRipesBundle:PeriodoAcademicoAmbiente pacd JOIN pacd.ambiente a JOIN a.pnf pnf,
                    MisionSucreRipesBundle:Triunfador trf, MisionSucreRipesBundle:Persona p
                    WHERE a.aldea=:aldea AND trf.ambiente = a.id AND trf.user = p.user
                '
            )
            ->setParameters(array('aldea'=>$aldea))->getResult();
    }
    
    public function findAllOrderedByEje($eje)
    {
          return $this->getEntityManager()
            ->createQuery(
                'SELECT  IDENTITY(p.user) AS u, p.priNom,p.segNom, p.priApe, p.segApe, p.cedPer, p.sexPer
                    ,p.celPer,p.telPer, trf AS t FROM MisionSucreRipesBundle:PeriodoAcademicoAmbiente pacd JOIN pacd.ambiente am JOIN am.aldea a JOIN a.parroquia prq,
                    MisionSucreRipesBundle:Triunfador trf, MisionSucreRipesBundle:Persona p
                    WHERE prq.eje = :eje AND trf.ambiente = am.id  AND trf.user = p.user
                    '
            )
            ->setParameter('eje', $eje)      
            ->getResult();
    }
    
    public function findAllOrderedByUser()
    {
          return $this->getEntityManager()
            ->createQuery(
                'SELECT DISTINCT usr.id,usr.username,p.priNom,p.segNom, p.priApe, p.segApe, p.cedPer, p.sexPer
                    ,p.celPer,p.telPer, trf as t, pacd.trayecto, pacd.periodo
                    FROM
                    MisionSucreRipesBundle:Triunfador trf, MisionSucreRipesBundle:Persona p JOIN p.user usr,
                    MisionSucreRipesBundle:PeriodoAcademicoAmbiente pacd JOIN pacd.ambiente am
                    WHERE trf.user = p.user AND usr.id = p.user AND trf.user = usr.id AND am.id=trf.ambiente
                    '
            )
            ->getResult();
    }
    public function findAllOrderedByEgresado()
    {
          return $this->getEntityManager()
            ->createQuery(
                'SELECT DISTINCT usr.id,usr.username,p.priNom,p.segNom, p.priApe, p.segApe, p.cedPer, p.sexPer
                    ,p.celPer,p.telPer, trf as t
                    FROM
                    MisionSucreRipesBundle:Triunfador trf JOIN trf.ambiente am, MisionSucreRipesBundle:Persona p JOIN p.user usr    
                    WHERE trf.user = p.user 
                    AND trf.condicion=:egresado
                    '
            )->setParameters(array('egresado'=>'Egresado'))
            ->getResult();
    }
    public function findAllOrderedByEgresadoAndEje($eje)
    {
          return $this->getEntityManager()
            ->createQuery(
                'SELECT DISTINCT usr.id,usr.username,p.priNom,p.segNom, p.priApe, p.segApe, p.cedPer, p.sexPer
                    ,p.celPer,p.telPer, trf as t
                    FROM
                    MisionSucreRipesBundle:Triunfador trf JOIN trf.ambiente am JOIN am.aldea a JOIN a.parroquia prq, MisionSucreRipesBundle:Persona p JOIN p.user usr    
                    WHERE trf.user = p.user 
                    AND trf.condicion=:egresado AND prq.eje = :eje
                    '
            )->setParameters(array('egresado'=>'Egresado','eje'=>$eje))
            ->getResult();
    }
    public function findAllOrderedByEgresadoAndAldea($aldea)
    {
          return $this->getEntityManager()
            ->createQuery(
                'SELECT DISTINCT usr.id,usr.username,p.priNom,p.segNom, p.priApe, p.segApe, p.cedPer, p.sexPer
                    ,p.celPer,p.telPer, trf as t
                    FROM
                    MisionSucreRipesBundle:Triunfador trf JOIN trf.ambiente am, MisionSucreRipesBundle:Persona p JOIN p.user usr    
                    WHERE trf.user = p.user 
                    AND trf.condicion=:egresado AND am.aldea = :aldea
                    '
            )->setParameters(array('egresado'=>'Egresado','aldea'=>$aldea))
            ->getResult();
    }
}
