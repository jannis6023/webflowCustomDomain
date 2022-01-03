<?php

namespace App\Controller;

use App\Entity\Site;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MainController extends AbstractController
{
    /**
     * @Route("/", requirements={"route"="^(?!.*api|_wdt|_profiler).+"})
     */
    function controller(Request $request, EntityManagerInterface $em, HttpClientInterface $client){
        /** @var Site $site */
        $site = $em->getRepository(Site::class)->findOneBy(["host" => $request->getHost()]);
        if($site->getRedirectURL() != null){
            return $this->redirect($site->getRedirectURL());
        }
        $response = $client->request($request->getMethod(), "https://" . $site->getWebflowAddress() . "/");
        $data = $response->getContent();
        $data = str_replace("<a class='w-webflow-badge' href='https://webflow.com?utm_campaign=brandjs'><img src='https://d3e54v103j8qbb.cloudfront.net/img/webflow-badge-icon.f67cd735e3.svg' alt='' style='margin-right: 8px; width: 16px;'><img src='https://d1otoma47x30pg.cloudfront.net/img/webflow-badge-text.6faa6a38cd.svg' alt='Made in Webflow'></a>", "", $data);
        return new Response($data, 200, ["Content-Type" => "text/html"]);
    }

    /**
     * @Route("/{route}", requirements={"route"="^(?!.*api|_wdt|_profiler).+"})
     */
    function controllerROUTE($route, Request $request, EntityManagerInterface $em, HttpClientInterface $client){
        /** @var Site $site */
        $site = $em->getRepository(Site::class)->findOneBy(["host" => $request->getHost()]);
        if($site->getRedirectURL() != null){
            return $this->redirect($site->getRedirectURL() . "/" .$route);
        }
        $response = $client->request($request->getMethod(), "https://" . $site->getWebflowAddress() . "/" . $route);
        $data = $response->getContent();
        $data = str_replace($site->getWebflowAddress(), $site->getHost(), $data);
        return new Response($data, 200, ["Content-Type" => "text/html"]);
    }
}