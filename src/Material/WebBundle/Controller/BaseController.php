<?php

namespace Material\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BaseController extends Controller{

    /**
     * @return mixed \Material\WebBundle\Entity\MaterialRepository
     */
    protected function getMaterialRepository(){
        return $this->getDoctrine()->getManager()->getRepository('MaterialWebBundle:Material');
    }

    /**
     * @return mixed \Material\WebBundle\Entity\ProductRepository
     */
    protected function getProductRepository(){
        return $this->getDoctrine()->getManager()->getRepository('MaterialWebBundle:Product');
    }

    /**
     * @return mixed \Material\WebBundle\Entity\OrderformRepository
     */
    protected function getOrderformRepository(){
        return $this->getDoctrine()->getManager()->getRepository('MaterialWebBundle:Orderform');
    }

}