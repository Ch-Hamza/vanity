<?php

namespace CommandeBundle\Controller;

use CommandeBundle\Entity\Commande;
use CommandeBundle\Form\CommandeType;
use CommandeBundle\Form\FullCommande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/commandes", name="index_commandes_page")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository(Commande::class)->createQueryBuilder('c')->where('c.archived=false');
        if($request->query->getAlnum('filter')) {
            $queryBuilder->where('c.name LIKE :name')
                ->setParameter('name', '%'.$request->query->getAlnum('filter').'%');
        }

        $query = $queryBuilder->getQuery();
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 10)
        );

        return $this->render('@Commande/list.html.twig', array(
            'commande_list' => $result,
        ));
    }

    /**
     * @Route("/commande/add", name="add_commande_page")
     */
    public function addAction(Request $request)
    {
        $commande = new Commande();
        $form = $this->get('form.factory')->create(FullCommande::class, $commande);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commande);
            $em->flush();
            return $this->redirectToRoute('index_commandes_page');
        }

        return $this->render('@Commande/add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/commande/edit/{id}", name="edit_commande_page")
     */
    public function editAction(Request $request, $id)
    {
        $commande = $this->getDoctrine()->getManager()->getRepository(Commande::class)->find($id);
        $form = $this->get('form.factory')->create(FullCommande::class, $commande);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('index_commandes_page');
        }

        return $this->render('@Commande/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/commande/archive/{id}", name="archive_commande_page")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository(Commande::class)->find($id);
        $commande->setArchived(true);
        $em->flush();
        return $this->redirectToRoute('index_commandes_page');
    }
}
