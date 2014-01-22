<?php

namespace projectAdmin\loginBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Caluga
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Caluga
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
    * @var string
    *
    * @ORM\Column(name="titulo", type="string", length=100 , nullable=true)
    */
    private $titulo;
    
    /**
    * @var string
    *
    * @ORM\Column(name="idioma", type="string", length=100 , nullable=true)
    */
    private $idioma;
    
    /**
    * @var string
    *
    * @ORM\Column(name="descripccioncorta", type="string", length=255 , nullable=true)
    */
    private $descripcioncorta;
    
    /**
    * @var string
    *
    * @ORM\Column(name="descripcion", type="string", length=500 , nullable=true)
    */

    private $descripcion;

    /**
    * @var string
    *
    * @ORM\Column(name="url", type="string", length=255 , nullable=true)
    */

    private $url;
    
    /** @ORM\Column(type="datetime") */
    
    private $fecha;    
    
    
               
    /**
    * @ORM\OneToMany(targetEntity="projectAdmin\loginBundle\Entity\FotoCaluga", mappedBy="caluga" , cascade={"remove"})
    */
    
    
    
      
    private $FotoCaluga;
       
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->FotoCaluga = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set titulo
     *
     * @param string $titulo
     * @return Caluga
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    
        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set idioma
     *
     * @param string $idioma
     * @return Caluga
     */
    public function setIdioma($idioma)
    {
        $this->idioma = $idioma;
    
        return $this;
    }

    /**
     * Get idioma
     *
     * @return string 
     */
    public function getIdioma()
    {
        return $this->idioma;
    }

    /**
     * Set descripcioncorta
     *
     * @param string $descripcioncorta
     * @return Caluga
     */
    public function setDescripcioncorta($descripcioncorta)
    {
        $this->descripcioncorta = $descripcioncorta;
    
        return $this;
    }

    /**
     * Get descripcioncorta
     *
     * @return string 
     */
    public function getDescripcioncorta()
    {
        return $this->descripcioncorta;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Caluga
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Caluga
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Caluga
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
     * Add FotoCaluga
     *
     * @param \projectAdmin\loginBundle\Entity\FotoCaluga $fotoCaluga
     * @return Caluga
     */
    public function addFotoCaluga(\projectAdmin\loginBundle\Entity\FotoCaluga $fotoCaluga)
    {
        $this->FotoCaluga[] = $fotoCaluga;
    
        return $this;
    }

    /**
     * Remove FotoCaluga
     *
     * @param \projectAdmin\loginBundle\Entity\FotoCaluga $fotoCaluga
     */
    public function removeFotoCaluga(\projectAdmin\loginBundle\Entity\FotoCaluga $fotoCaluga)
    {
        $this->FotoCaluga->removeElement($fotoCaluga);
    }

    /**
     * Get FotoCaluga
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFotoCaluga()
    {
        return $this->FotoCaluga;
    }
}