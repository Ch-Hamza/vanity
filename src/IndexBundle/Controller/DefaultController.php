<?php

namespace IndexBundle\Controller;

use CommandeBundle\Entity\Commande;
use CommandeBundle\Entity\CommandeItem;
use CommandeBundle\Entity\PersonalInfo;
use CommandeBundle\Form\CommandeItemType;
use CommandeBundle\Form\CommandeType;
use CommandeBundle\Form\PersonalInfoType;
use IndexBundle\Entity\ContactMessage;
use IndexBundle\Entity\MailingList;
use IndexBundle\Form\ContactMessageType;
use IndexBundle\Form\EmailListType;
use ProductBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="index_page")
     */
    public function indexAction(Request $request)
    {
        $items = $this->getDoctrine()->getManager()->getRepository(CommandeItem::class)->findMostWanted();
        $highlights = $this->getDoctrine()->getManager()->getRepository(Product::class)->findRandom();

        $email = new MailingList();
        $form = $this->get('form.factory')->create(EmailListType::class, $email);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($email);
            $em->flush();
            return $this->redirectToRoute('index_page');
        }

        $serializer = $this->get('jms_serializer');
        $session = $this->get('session');
        $cartLogo = 0;
        if ($session->has('cartElements')) {
            $commandeJson = $session->get('cartElements');
            $commande = $serializer->deserialize($commandeJson, Commande::class, 'json');
            $cartLogo = count($commande->getItems());
        }

        return $this->render('@Index/IndexPage/index.html.twig', array(
            'items' => $items,
            'highlights' => $highlights,
            'form' => $form->createView(),
            'cartLogo' => $cartLogo,
        ));
    }

    /**
     * @Route("/shop-all", name="shop_all_page")
     */
    public function shopAllAction(Request $request)
    {
        $productList = $this->getDoctrine()->getManager()->getRepository(Product::class)->findAll();
        $email = new MailingList();
        $form   = $this->get('form.factory')->create(EmailListType::class, $email);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($email);
            $em->flush();
            return $this->redirectToRoute('shop_all_page');
        }

        $serializer = $this->get('jms_serializer');
        $session = $this->get('session');
        $cartLogo = 0;
        if ($session->has('cartElements')) {
            $commandeJson = $session->get('cartElements');
            $commande = $serializer->deserialize($commandeJson, Commande::class, 'json');
            $cartLogo = count($commande->getItems());
        }

        return $this->render('@Index/ShopAllPage.html.twig', array(
            'products' => $productList,
            'form' => $form->createView(),
            'cartLogo' => $cartLogo,
        ));
    }

    /**
     * @Route("/contact", name="contact_page")
     */
    public function contactAction(Request $request)
    {
        $email = new MailingList();
        $form   = $this->get('form.factory')->create(EmailListType::class, $email);

        $contact_message = new ContactMessage();
        $contact_form   = $this->get('form.factory')->create(ContactMessageType::class, $contact_message);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($email);
            $em->flush();
            return $this->redirectToRoute('contact_page');
        }

        if ($request->isMethod('POST') && $contact_form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact_message);
            $em->flush();
            return $this->redirectToRoute('index_page');
        }

        $serializer = $this->get('jms_serializer');
        $session = $this->get('session');
        $cartLogo = 0;
        if ($session->has('cartElements')) {
            $commandeJson = $session->get('cartElements');
            $commande = $serializer->deserialize($commandeJson, Commande::class, 'json');
            $cartLogo = count($commande->getItems());
        }

        return $this->render('@Index/contact.html.twig', array(
            'form' => $form->createView(),
            'contact_form' => $contact_form->createView(),
            'cartLogo' => $cartLogo,
        ));
    }

    /**
     * @Route("/about", name="about_page")
     */
    public function aboutAction(Request $request)
    {
        $email = new MailingList();
        $form   = $this->get('form.factory')->create(EmailListType::class, $email);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($email);
            $em->flush();
            return $this->redirectToRoute('about_page');
        }

        $serializer = $this->get('jms_serializer');
        $session = $this->get('session');
        $cartLogo = 0;
        if ($session->has('cartElements')) {
            $commandeJson = $session->get('cartElements');
            $commande = $serializer->deserialize($commandeJson, Commande::class, 'json');
            $cartLogo = count($commande->getItems());
        }

        return $this->render('@Index/about.html.twig', array(
            'form' => $form->createView(),
            'cartLogo' => $cartLogo,
        ));
    }

    /**
     * @Route("/store-policy", name="policy_page")
     */
    public function policyAction(Request $request)
    {
        $email = new MailingList();
        $form   = $this->get('form.factory')->create(EmailListType::class, $email);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($email);
            $em->flush();
            return $this->redirectToRoute('policy_page');
        }

        $serializer = $this->get('jms_serializer');
        $session = $this->get('session');
        $cartLogo = 0;
        if ($session->has('cartElements')) {
            $commandeJson = $session->get('cartElements');
            $commande = $serializer->deserialize($commandeJson, Commande::class, 'json');
            $cartLogo = count($commande->getItems());
        }

        return $this->render('@Index/store-policy.html.twig', array(
            'form' => $form->createView(),
            'cartLogo' => $cartLogo,
        ));
    }

    /**
     * @Route("/product-{id}", name="product_page")
     */
    public function productAction(Request $request, $id)
    {
        $product = $this->getDoctrine()->getManager()->getRepository(Product::class)->find($id);

        $serializer = $this->get('jms_serializer');
        $session = $this->get('session');
        $cartLogo = 0;
        if ($session->has('cartElements')) {
            $commandeJson = $session->get('cartElements');
            $commande = $serializer->deserialize($commandeJson, Commande::class, 'json');
            $cartLogo = count($commande->getItems());
        }

        $email = new MailingList();
        $form   = $this->get('form.factory')->create(EmailListType::class, $email);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($email);
            $em->flush();
            return $this->redirectToRoute('product_page', array('id' => $id));
        }

        $commandeItem = new CommandeItem();
        $cart_form = $this->get('form.factory')->create(CommandeItemType::class, $commandeItem);
        if($request->isMethod('POST') && $cart_form->handleRequest($request)->isValid()) {

            $commandeItem->setProduct($product);
            $session = $this->get('session');
            $em = $this->getDoctrine()->getManager();

            if ($session->has('cartElements')) {
                //add to existing commande
                $commandeJson = $session->get('cartElements');
                $commande = $serializer->deserialize($commandeJson, Commande::class, 'json');
                $database_commande = $this->getDoctrine()->getManager()->getRepository(Commande::class)->find($commande->getId());
                $database_commande->addItem($commandeItem);
                $commandeItem->setCommande($database_commande);
                $em->persist($database_commande);
                $em->flush();
                $jsonCommande = $serializer->serialize($database_commande, 'json');
                //die(var_dump($jsonCommande));
                $session->set('cartElements', $jsonCommande);
            }
            else{
                $commande = new Commande();
                $em->persist($commande);
                $em->flush();
                $commande->addItem($commandeItem);
                $commandeItem->setCommande($commande);
                $em->persist($commandeItem);
                $em->flush();
                $jsonCommande = $serializer->serialize($commande, 'json');
                $session->set('cartElements', $jsonCommande);
            }

            return $this->redirectToRoute('product_page', array('id' => $id));
        }

        return $this->render('@Index/product.html.twig', array(
            'cart_form' => $cart_form->createView(),
            'form' => $form->createView(),
            'product' => $product,
            'cartLogo' => $cartLogo,
        ));
    }

    /**
     * @Route("/cart-page", name="cart_page")
     */
    public function cartAction(Request $request)
    {
        $serializer = $this->get('jms_serializer');

        $email = new MailingList();
        $form = $this->get('form.factory')->create(EmailListType::class, $email);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($email);
            $em->flush();
            return $this->redirectToRoute('cart_page');
        }

        $session = $this->get('session');
        if ($session->has('cartElements')) {

            $commandeJson = $session->get('cartElements');
            $commande = $serializer->deserialize($commandeJson, Commande::class, 'json');
            $data = $commande->getItems();
            $em = $this->getDoctrine()->getManager();
            $database_commande = $this->getDoctrine()->getManager()->getRepository(Commande::class)->find($commande->getId());
            $commande_form = $this->get('form.factory')->create(CommandeType::class, $database_commande);
            if ($request->isMethod('POST') && $commande_form->handleRequest($request)->isValid()) {
                $em->persist($database_commande);
                $em->flush();
                return $this->redirectToRoute('checkout_page');
            }
        }
        else {
            return $this->redirectToRoute('index_page');
        }

        /*$session->clear();
        die('cleared');*/

        $serializer = $this->get('jms_serializer');
        $session = $this->get('session');
        $cartLogo = 0;
        if ($session->has('cartElements')) {
            $commandeJson = $session->get('cartElements');
            $commande = $serializer->deserialize($commandeJson, Commande::class, 'json');
            $cartLogo = count($commande->getItems());
        }

        return $this->render('@Index/checkout.html.twig', array(
            'form' => $form->createView(),
            'commande_form' => $commande_form->createView(),
            'cartLogo' => $cartLogo,
            'items1' => $data,
        ));
    }

    /**
     * @Route("/delete-cart-item-{id}", name="delete_cart_item")
     */
    public function deleteCartItemAction($id) {

        $em = $this->getDoctrine()->getManager();
        $serializer = $this->get('jms_serializer');
        $session = $this->get('session');

        if ($session->has('cartElements')) {
            $commandeJson = $session->get('cartElements');
            $commande = $serializer->deserialize($commandeJson, Commande::class, 'json');

            $database_commande = $this->getDoctrine()->getManager()->getRepository(Commande::class)->find($commande->getId());
            $item = $this->getDoctrine()->getManager()->getRepository(CommandeItem::class)->find($id);
            $database_commande->removeItem($item);

            $em->remove($item);
            $em->flush();

            $jsonCommande = $serializer->serialize($database_commande, 'json');
            $session->set('cartElements', $jsonCommande);
        }

        return $this->redirectToRoute('cart_page');
    }

    /**
     * @Route("/checkout-page", name="checkout_page")
     */
    public function checkoutAction(Request $request)
    {
        $email = new MailingList();
        $form   = $this->get('form.factory')->create(EmailListType::class, $email);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($email);
            $em->flush();
            return $this->redirectToRoute('checkout_page');
        }

        $serializer = $this->get('jms_serializer');
        $session = $this->get('session');
        if ($session->has('cartElements')) {
            $commandeJson = $session->get('cartElements');
            $commande = $serializer->deserialize($commandeJson, Commande::class, 'json');
            $cartLogo = count($commande->getItems());

            $database_commande = $this->getDoctrine()->getManager()->getRepository(Commande::class)->find($commande->getId());
            if($database_commande->getPersonalInfo()) {
                $personalinfo_form = $this->get('form.factory')->create(PersonalInfoType::class, $database_commande->getPersonalInfo());
            }
            else {
                $personal_info = new PersonalInfo();
                $database_commande->setPersonalInfo($personal_info);
                $personalinfo_form = $this->get('form.factory')->create(PersonalInfoType::class, $personal_info);
            }
            if ($request->isMethod('POST') && $personalinfo_form->handleRequest($request)->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                return $this->redirectToRoute('index_page');
            }
        }
        else {
            return $this->redirectToRoute('index_page');
        }

        return $this->render('@Index/commande.html.twig', array(
            'form' => $form->createView(),
            'personalinfo_form' => $personalinfo_form->createView(),
            'cartLogo' => $cartLogo,
        ));
    }
}
