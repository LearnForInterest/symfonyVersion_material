<?php
namespace Material\WebBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;

/**
 * Class product
 * @ORM\Entity(repositoryClass="ProductRepository")
 * @ORM\Table(name="product")
 */
class Product{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $customer;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $description;

    /**
     * @ORM\Column(type="integer")
     */
    protected $total_price;

    /**
     * @ManyToMany(targetEntity="Material",inversedBy="products")
     * @JoinTable(name="materials_products")
     */
    private $materials;

    public function __construct()
    {
        $this->materials = new ArrayCollection();
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
     * Set customer
     *
     * @param string $customer
     * @return Product
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return string 
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set total_price
     *
     * @param integer $totalPrice
     * @return Product
     */
    public function setTotalPrice($totalPrice)
    {
        $this->total_price = $totalPrice;

        return $this;
    }

    /**
     * Get total_price
     *
     * @return integer 
     */
    public function getTotalPrice()
    {
        return $this->total_price;
    }

    /**
     * Add materials
     *
     * @param \Material\WebBundle\Entity\Material $materials
     * @return Product
     */
    public function addMaterial(\Material\WebBundle\Entity\Material $materials)
    {
        $this->materials[] = $materials;

        return $this;
    }

    /**
     * Remove materials
     *
     * @param \Material\WebBundle\Entity\Material $materials
     */
    public function removeMaterial(\Material\WebBundle\Entity\Material $materials)
    {
        $this->materials->removeElement($materials);
    }

    /**
     * Get materials
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMaterials()
    {
        return $this->materials;
    }

    public function __toString()
    {
        return $this->name;
    }


    /**
     * Set name
     *
     * @param string $name
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
}
