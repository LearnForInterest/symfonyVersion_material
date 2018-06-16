<?php
namespace Material\WebBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * Class orderform
 * @ORM\Entity(repositoryClass="OrderformRepository")
 * @ORM\Table(name="orderform")
 */
class Orderform{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="Material",inversedBy="orderforms")
     * @JoinColumn(name="material_id",referencedColumnName="id")
     */
    private $material;

    /**
     * @ORM\Column(type="integer")
     */
    protected $need_num;

    public function __construct()
    {
        $this->material = new ArrayCollection();
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
     * Set need_num
     *
     * @param integer $needNum
     * @return Order
     */
    public function setNeedNum($needNum)
    {
        $this->need_num = $needNum;

        return $this;
    }

    /**
     * Get need_num
     *
     * @return integer 
     */
    public function getNeedNum()
    {
        return $this->need_num;
    }

    /**
     * Set material
     *
     * @param \Material\WebBundle\Entity\Material $material
     * @return Order
     */
    public function setMaterial(\Material\WebBundle\Entity\Material $material = null)
    {
        $this->material = $material;

        return $this;
    }

    /**
     * Get material
     *
     * @return \Material\WebBundle\Entity\Material 
     */
    public function getMaterial()
    {
        return $this->material;
    }
}
