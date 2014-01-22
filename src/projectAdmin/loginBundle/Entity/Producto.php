<?php

namespace projectAdmin\loginBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Producto
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Producto
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
    * @ORM\Column(name="nombre", type="string", length=255 , nullable=true)
    */
    
    
    private $nombre;
    
    
    
    /**
    * @var string
    * @ORM\Column(name="codigo", type="string", length=255 , nullable=true)
    */
    private $codigo;
    
    /**
    * @var string
    * @ORM\Column(name="talla", type="string", length=5 , nullable=true)
    */
    private $talla;
    
    /**
    * @var string
    * @ORM\Column(name="descripcion", type="string", length=400 , nullable=true)
    */
    private $descripcion;
    
    /**
    * @var string
    * @ORM\Column(name="descripcioncorta", type="string", length=255 , nullable=true)
    */
    
    private $descripcioncorta;
    
    /**
    * @var string
    * @ORM\Column(name="caracteristicasuno", type="string", length=400 , nullable=true)
    */
    private $caracteristicasuno;
    
    /**
    * @var string
    * @ORM\Column(name="caracteristicasdos", type="string", length=400 , nullable=true)
    */
    private $caracteristicasdos;
    /**
    * @var string
    * @ORM\Column(name="caracteristicastres", type="string", length=400 , nullable=true)
    */
    private $caracteristicastres;
    /**
    * @var string
    * @ORM\Column(name="caracteristicascuatro", type="string", length=400 , nullable=true)
    */
    private $caracteristicascuatro;
    /**
    * @var string
    * @ORM\Column(name="caracteristicascinco", type="string", length=400 , nullable=true)
    */
    private $caracteristicascinco;
    /**
    * @var string
    * @ORM\Column(name="caracteristicasseis", type="string", length=400 , nullable=true)
    */
    private $caracteristicasseis;
    
    /**
    * @var string
    * @ORM\Column(name="stock", type="string", length=400 , nullable=true)
    */
    
   private $stock;
    /**
    * @var string
    * @ORM\Column(name="estado", type="string", length=400 , nullable=true)
    */
    
    private $estado;
    
    /**
    * @var string
    * @ORM\Column(name="idioma", type="string", length=255 , nullable=true)
    */
    private $idioma;
    
    
           
    /**
    * @ORM\OneToMany(targetEntity="projectAdmin\loginBundle\Entity\Foto", mappedBy="producto" , cascade={"remove"})
    */
    
    
    
        
    private $foto;
       
    /**
    * @ORM\ManyToOne(targetEntity="projectAdmin\loginBundle\Entity\Categoria", inversedBy="producto" )
    * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
    */
       
    private $categoria;

 
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->foto = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     * @return Producto
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
     * Set codigo
     *
     * @param string $codigo
     * @return Producto
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    
        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set talla
     *
     * @param string $talla
     * @return Producto
     */
    public function setTalla($talla)
    {
        $this->talla = $talla;
    
        return $this;
    }

    /**
     * Get talla
     *
     * @return string 
     */
    public function getTalla()
    {
        return $this->talla;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Producto
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
     * Set descripcioncorta
     *
     * @param string $descripcioncorta
     * @return Producto
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
     * Set caracteristicasuno
     *
     * @param string $caracteristicasuno
     * @return Producto
     */
    public function setCaracteristicasuno($caracteristicasuno)
    {
        $this->caracteristicasuno = $caracteristicasuno;
    
        return $this;
    }

    /**
     * Get caracteristicasuno
     *
     * @return string 
     */
    public function getCaracteristicasuno()
    {
        return $this->caracteristicasuno;
    }

    /**
     * Set caracteristicasdos
     *
     * @param string $caracteristicasdos
     * @return Producto
     */
    public function setCaracteristicasdos($caracteristicasdos)
    {
        $this->caracteristicasdos = $caracteristicasdos;
    
        return $this;
    }

    /**
     * Get caracteristicasdos
     *
     * @return string 
     */
    public function getCaracteristicasdos()
    {
        return $this->caracteristicasdos;
    }

    /**
     * Set caracteristicastres
     *
     * @param string $caracteristicastres
     * @return Producto
     */
    public function setCaracteristicastres($caracteristicastres)
    {
        $this->caracteristicastres = $caracteristicastres;
    
        return $this;
    }

    /**
     * Get caracteristicastres
     *
     * @return string 
     */
    public function getCaracteristicastres()
    {
        return $this->caracteristicastres;
    }

    /**
     * Set caracteristicascuatro
     *
     * @param string $caracteristicascuatro
     * @return Producto
     */
    public function setCaracteristicascuatro($caracteristicascuatro)
    {
        $this->caracteristicascuatro = $caracteristicascuatro;
    
        return $this;
    }

    /**
     * Get caracteristicascuatro
     *
     * @return string 
     */
    public function getCaracteristicascuatro()
    {
        return $this->caracteristicascuatro;
    }

    /**
     * Set caracteristicascinco
     *
     * @param string $caracteristicascinco
     * @return Producto
     */
    public function setCaracteristicascinco($caracteristicascinco)
    {
        $this->caracteristicascinco = $caracteristicascinco;
    
        return $this;
    }

    /**
     * Get caracteristicascinco
     *
     * @return string 
     */
    public function getCaracteristicascinco()
    {
        return $this->caracteristicascinco;
    }

    /**
     * Set caracteristicasseis
     *
     * @param string $caracteristicasseis
     * @return Producto
     */
    public function setCaracteristicasseis($caracteristicasseis)
    {
        $this->caracteristicasseis = $caracteristicasseis;
    
        return $this;
    }

    /**
     * Get caracteristicasseis
     *
     * @return string 
     */
    public function getCaracteristicasseis()
    {
        return $this->caracteristicasseis;
    }

    /**
     * Set stock
     *
     * @param string $stock
     * @return Producto
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    
        return $this;
    }

    /**
     * Get stock
     *
     * @return string 
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Producto
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
     * Set idioma
     *
     * @param string $idioma
     * @return Producto
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
     * Add foto
     *
     * @param \projectAdmin\loginBundle\Entity\Foto $foto
     * @return Producto
     */
    public function addFoto(\projectAdmin\loginBundle\Entity\Foto $foto)
    {
        $this->foto[] = $foto;
    
        return $this;
    }

    /**
     * Remove foto
     *
     * @param \projectAdmin\loginBundle\Entity\Foto $foto
     */
    public function removeFoto(\projectAdmin\loginBundle\Entity\Foto $foto)
    {
        $this->foto->removeElement($foto);
    }

    /**
     * Get foto
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set categoria
     *
     * @param \projectAdmin\loginBundle\Entity\Categoria $categoria
     * @return Producto
     */
    public function setCategoria(\projectAdmin\loginBundle\Entity\Categoria $categoria = null)
    {
        $this->categoria = $categoria;
    
        return $this;
    }

    /**
     * Get categoria
     *
     * @return \projectAdmin\loginBundle\Entity\Categoria 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }
}
