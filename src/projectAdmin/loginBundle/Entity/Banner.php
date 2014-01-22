<?php

namespace projectAdmin\loginBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Banner
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Banner
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
    * @ORM\Column(name="nombre", type="string", length=100 , nullable=true)
    */
    private $nombre;
    
    /**
    * @var string
    *
    * @ORM\Column(name="titulo", type="string", length=100 , nullable=true)
    */
    private $titulo;
    
    /**
    * @var string
    *
    * @ORM\Column(name="estado", type="string", length=100 , nullable=true)
    */
    private $estado;
    
    /**
    * @var string
    *
    * @ORM\Column(name="url", type="string", length=100 , nullable=true)
    */
    private $url;
    
    
    
    /**
     * @var string
     * 
     *  @ORM\Column(name="piedefoto", type="string", length=200 , nullable=true)
     */
    private $piedefoto;
    
    /**
    * @var string
    * @ORM\Column(name="idioma", type="string", length=255 , nullable=true)
    */
    private $idioma;
    
    /** @ORM\Column(type="datetime") */
    private $fecha;    
    
    
     /**
    * @var string
    *
    * @ORM\Column(name="link", type="string", length=500 , nullable=true)
    */
    
    private $link;

  

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
     * Set nombre
     *
     * @param string $nombre
     * @return Banner
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

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Banner
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
     * Set estado
     *
     * @param string $estado
     * @return Banner
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Banner
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
     * Set piedefoto
     *
     * @param string $piedefoto
     * @return Banner
     */
    public function setPiedefoto($piedefoto)
    {
        $this->piedefoto = $piedefoto;
    
        return $this;
    }

    /**
     * Get piedefoto
     *
     * @return string 
     */
    public function getPiedefoto()
    {
        return $this->piedefoto;
    }

    /**
     * Set idioma
     *
     * @param string $idioma
     * @return Banner
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Banner
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
     * Set link
     *
     * @param string $link
     * @return Banner
     */
    public function setLink($link)
    {
        $this->link = $link;
    
        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }
}