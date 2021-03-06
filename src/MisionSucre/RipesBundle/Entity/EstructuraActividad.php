<?php

namespace MisionSucre\RipesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ambiente
 *
 * @ORM\Table(name="estructura_actividad")
 * @ORM\Entity(repositoryClass="MisionSucre\RipesBundle\Entity\EstructuraActividadRepository")
 */
class EstructuraActividad
{   
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     * @ORM\ManyToOne(targetEntity="Estructura", inversedBy="actividades")
     * @ORM\JoinColumn(name="estructura_id", referencedColumnName="id")
     */
    protected $estructura;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="responsablesactividades")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $responsable;
        
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;
    
     /**
     * @var string
     *
     * @ORM\Column(name="objetivo", type="string", length=50, nullable=true)
     */
    private $objetivo;
     /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=20, nullable=true)
     */
    private $nombre;
     /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=100, nullable=true)
     */
    private $observacion;
     /**
     * @var string
     *
     * @ORM\Column(name="lugar", type="string", length=50)
     */
    private $lugar;
     /**
     * @var string
     *
     * @ORM\Column(name="cumplimiento", type="string", length=2)
     */
    private $cumplimiento;
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return EstructuraActividad
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set objetivo
     *
     * @param string $objetivo
     * @return EstructuraActividad
     */
    public function setObjetivo($objetivo)
    {
        $this->objetivo = $objetivo;

        return $this;
    }

    /**
     * Get objetivo
     *
     * @return string 
     */
    public function getObjetivo()
    {
        return $this->objetivo;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     * @return EstructuraActividad
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string 
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set estructura
     *
     * @param \MisionSucre\RipesBundle\Entity\Estructura $estructura
     * @return EstructuraActividad
     */
    public function setEstructura(\MisionSucre\RipesBundle\Entity\Estructura $estructura = null)
    {
        $this->estructura = $estructura;

        return $this;
    }

    /**
     * Get estructura
     *
     * @return \MisionSucre\RipesBundle\Entity\Estructura 
     */
    public function getEstructura()
    {
        return $this->estructura;
    }

    /**
     * Set responsable
     *
     * @param \MisionSucre\RipesBundle\Entity\User $responsable
     * @return EstructuraActividad
     */
    public function setResponsable(\MisionSucre\RipesBundle\Entity\User $responsable = null)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return \MisionSucre\RipesBundle\Entity\User 
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set lugar
     *
     * @param string $lugar
     * @return EstructuraActividad
     */
    public function setLugar($lugar)
    {
        $this->lugar = $lugar;

        return $this;
    }

    /**
     * Get lugar
     *
     * @return string 
     */
    public function getLugar()
    {
        return $this->lugar;
    }

    /**
     * Set cumplimiento
     *
     * @param string $cumplimiento
     * @return EstructuraActividad
     */
    public function setCumplimiento($cumplimiento)
    {
        $this->cumplimiento = $cumplimiento;

        return $this;
    }

    /**
     * Get cumplimiento
     *
     * @return string 
     */
    public function getCumplimiento()
    {
        return $this->cumplimiento;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return EstructuraActividad
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }
}
