<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/admin", name="index_admin_page")
     */
    public function indexAction()
    {
        //$total_museums = $this->getDoctrine()->getRepository('MuseumsBundle:Museum')->count_museums();
        //$total_expositions = $this->getDoctrine()->getRepository('ExpositionBundle:Exposition')->count_expositions();
        //$total_users = $this->getDoctrine()->getRepository('UserBundle:User')->count_users();

        return $this->render('AdminBundle::index.html.twig', array(
            'total_museums' => 1,
            'total_expositions' => 2,
            'total_users' => 3,
        ));
    }
}
