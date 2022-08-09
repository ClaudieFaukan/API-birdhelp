<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    protected $categories;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categories = $categoryRepository;
    }

    /**
     *@Route("/categories", name="get_all_categories", methods="GET") 
     *
     */
    public function getCategories()
    {
        /** @var Category[] */
        $categoriesCollection = $this->categories->findAll();
        $categories = [];
        foreach ($categoriesCollection as $item) {
            $categories[] = ['id' => $item->getId(), 'name' => $item->getName()];
        }

        return new JsonResponse($categories);
    }

    /**
     * @Route("/categorie", name="post_categorie")
     */
    public function postCategorie(Request $request)
    {
    }
}
