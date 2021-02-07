<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
		return $this->render("home/index.html.twig");
    }
	
	/**
     * @Route("/custom", name="custom")
     */
    public function custom(): Response
    {
        return $this->render("home/custom.html.twig");
    }
	
	/**
     * @Route("/custom/{name}", name="custom_name")
     */
    public function customName(Request $request): Response
    {
		return $this->render("home/custom_name.html.twig", [
			'name' => $request->get("name")
		]);
    }
}
