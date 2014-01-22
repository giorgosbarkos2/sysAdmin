<?php

namespace projectAdmin\loginBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Articulo
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Articulo
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
     * @ORM\Column(name="titulo", type="text", nullable=true)
     */
    private $titulo;
    /**
     * @var string
     *
     * @ORM\Column(name="idioma", type="text", nullable=true)
     */
    private $idioma;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcioncorta", type="text", nullable=true)
     */
    private $descripcioncorta;

    /**
     * @var string
     *
     * @ORM\Column(name="articulo", type="text", nullable=true)
     */
    private $articulo;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text", nullable=true)
     */
    private $url;


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
     * @return Articulo
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
     * @return Articulo
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
     * @return Articulo
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
     * Set articulo
     *
     * @param string $articulo
     * @return Articulo
     */
    public function setArticulo($articulo)
    {
        $this->articulo = $articulo;
    
        return $this;
    }

    /**
     * Get articulo
     *
     * @return string 
     */
    public function getArticulo()
    {
        return $this->articulo;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Articulo
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
}