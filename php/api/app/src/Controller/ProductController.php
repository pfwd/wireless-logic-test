<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Exception\TableNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(ProductRepository $productRepository): JsonResponse
    {
        $data = [];
        try {
            $products = $productRepository->findAll();
            foreach($products as $key => $product) {
                $data[$key] = [
                    'id' => $product->getId(),
                    'heading' => $product->getHeading(),
                    'title' => $product->getTitle(),
                    'price' => $product->getPrice(),
                    'discount' => $product->getDiscount(),
                    'price_in_pence' => $product->getPriceInPence(),
                    'annual_price' => $product->getAnnualPrice()
                ];
            }
        } catch (TableNotFoundException $e) {
            return $this->json([
                'error' => 'Table not built yet. Please read the README and run the scraper console command',
            ], 500);;
        }


        return $this->json([
            'data' => $data,
        ]);
    }
}
