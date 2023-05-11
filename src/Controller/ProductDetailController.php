<?php

namespace App\Controller;

use App\Entity\ProductDetails;
use App\Form\ProductDetailsType;
use App\Repository\ProductDetailsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/productDetails')]
class ProductDetailController extends AbstractController
{
    #[Route('/', name: 'app_productDetails_index', methods: ['GET'])]
    public function index(ProductDetailsRepository $productDetailsRepository): Response
    {
        return $this->render('productDetails/index.html.twig', [
            'productDetailss' => $productDetailsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_productDetails_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProductDetailsRepository $productDetailsRepository): Response
    {
        $productDetails = new ProductDetails();
        $form = $this->createForm(ProductDetailsType::class, $productDetails);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productDetailsRepository->save($productDetails, true);

            return $this->redirectToRoute('app_productDetails_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('productDetails/new.html.twig', [
            'productDetails' => $productDetails,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_productDetails_show', methods: ['GET'])]
    public function show(ProductDetails $productDetails): Response
    {
        return $this->render('productDetails/show.html.twig', [
            'productDetails' => $productDetails,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_productDetails_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductDetails $productDetails, ProductDetailsRepository $productDetailsRepository): Response
    {
        $form = $this->createForm(ProductDetailsType::class, $productDetails);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productDetailsRepository->save($productDetails, true);

            return $this->redirectToRoute('app_productDetails_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('productDetails/edit.html.twig', [
            'productDetails' => $productDetails,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_productDetails_delete', methods: ['POST'])]
    public function delete(Request $request, ProductDetails $productDetails, ProductDetailsRepository $productDetailsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productDetails->getId(), $request->request->get('_token'))) {
            $productDetailsRepository->remove($productDetails, true);
        }

        return $this->redirectToRoute('app_productDetails_index', [], Response::HTTP_SEE_OTHER);
    }
}
