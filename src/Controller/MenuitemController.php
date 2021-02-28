<?php

namespace App\Controller;

use App\Entity\Menuitem;
use App\Form\MenuitemType;
use App\Repository\MenuitemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/menuitem")
 */
class MenuitemController extends AbstractController
{
    /**
     * @Route("/", name="menuitem_index", methods={"GET"})
     */
    public function index(MenuitemRepository $menuitemRepository): Response
    {
        return $this->render('menuitem/index.html.twig', [
            'menuitems' => $menuitemRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="menuitem_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $menuitem = new Menuitem();
        $form = $this->createForm(MenuitemType::class, $menuitem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($menuitem);
            $entityManager->flush();

            return $this->redirectToRoute('menuitem_index');
        }

        return $this->render('menuitem/new.html.twig', [
            'menuitem' => $menuitem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="menuitem_show", methods={"GET"})
     */
    public function show(Menuitem $menuitem): Response
    {
        return $this->render('menuitem/show.html.twig', [
            'menuitem' => $menuitem,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="menuitem_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Menuitem $menuitem): Response
    {
        $form = $this->createForm(MenuitemType::class, $menuitem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('menuitem_index');
        }

        return $this->render('menuitem/edit.html.twig', [
            'menuitem' => $menuitem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="menuitem_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Menuitem $menuitem): Response
    {
        if ($this->isCsrfTokenValid('delete'.$menuitem->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($menuitem);
            $entityManager->flush();
        }

        return $this->redirectToRoute('menuitem_index');
    }
}
