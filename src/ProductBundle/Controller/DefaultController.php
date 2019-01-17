<?php

namespace ProductBundle\Controller;

use ProductBundle\Entity\Product;
use ProductBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/products", name="index_products_page")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository(Product::class)->createQueryBuilder('p');
        if($request->query->getAlnum('filter')) {
            $queryBuilder->where('p.name LIKE :name')
                ->setParameter('name', '%'.$request->query->getAlnum('filter').'%');
        }

        $query = $queryBuilder->getQuery();
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 10)
        );
        dump($result);
        return $this->render('@Product/list.html.twig', array(
            'product_list' => $result,
        ));
    }

    /**
     * @Route("/products/add", name="add_product_page")
     */
    public function addAction(Request $request)
    {
        $product = new Product();
        $form = $this->get('form.factory')->create(ProductType::class, $product);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('index_products_page');
        }

        return $this->render('@Product/add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/products/edit/{id}", name="edit_product_page")
     */
    public function editAction(Request $request, $id)
    {
        $product = $this->getDoctrine()->getManager()->getRepository(Product::class)->find($id);
        $form = $this->get('form.factory')->create(ProductType::class, $product);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('index_products_page');
        }

        return $this->render('@Product/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/products/delete/{id}", name="delete_product_page")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($id);
        $em->remove($product);
        $em->flush();
        return $this->redirectToRoute('index_products_page');
    }

    /**
     * @Route("/products/enable/{id}", name="enable_product_page")
     */
    public function enableAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($id);
        if($product->isEnabled()) { $product->setEnabled(false); }
        else { $product->setEnabled(true); }
        $em->flush();
        return $this->redirectToRoute('index_products_page');
    }
}
