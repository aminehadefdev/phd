<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends AbstractController{
    /**
     * @Route("/", name="default")
     */
    public function index() : Response{
        return $this->render("app.html.twig");
    }
    /**
     * @Route("/findEvent", name="findEvent")
     */
    public function findEvent_vue() : Response{
        return $this->render("app.html.twig");
    }
    /**
     * @Route("/inbox", name="inbox")
    */
    public function inbox_vue() : Response{
        return $this->render("app.html.twig");
    }
    /**
     * @Route("/companies", name="companies")
    */
    public function companies_vue() : Response{
        return $this->render("app.html.twig");
    }
    /**
     * @Route("/findJob", name="findJob")
     */
    public function find_job_vue() : Response{
        return $this->render("app.html.twig");
    }
    /**
     * @Route("/publications", name="publications")
     */
    public function find_publications() : Response{
        return $this->render("app.html.twig");
    }
}