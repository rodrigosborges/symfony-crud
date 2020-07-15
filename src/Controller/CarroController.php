<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\{Carro, Marca, Modelo};
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\Tools\Pagination\Paginator;

class CarroController extends AbstractController
{
    /**
     * @Route("/carro", name="carro")
     */
    public function index(Request $request){

        $data = $request->query->all();

        $carros = $this->getDoctrine()->getRepository(Carro::class)->createQueryBuilder('c');

        if(array_key_exists('proprietarioplaca', $data)){
            $carros->andWhere('c.proprietario LIKE :proprietario')
                ->setParameter('proprietario', '%'.$data['proprietarioplaca'].'%')
                ->orWhere('c.placa LIKE :placa')
                ->setParameter('placa', $data['proprietarioplaca']);
        }

        if(array_key_exists('modelos', $data)){
            $carros->andWhere('c.modelo IN (:modelos)')
                ->setParameter('modelos', $data['modelos']);
        }else if(array_key_exists('marcas', $data)){
            $carros->leftJoin('c.modelo', 'mo');
            $carros->leftJoin('mo.marca','ma');
            $carros->andWhere('mo.marca IN (:marcas)')
                ->setParameter('marcas', $data['marcas']);
        }

        $carros = $carros->orderBy('c.proprietario', 'ASC')->getQuery();

        $carros = $carros->execute();

        $marcas = $this->getDoctrine()->getRepository(Marca::class)->findAll();

        return $this->render('carro/index.html.twig', [
            'marcas' => $marcas,
            'carros' => $carros
        ]);
    }

    /**
     * @Route("/carro/modelos", name="carro/modelos")
     */
    public function modelos(Request $request){
        $query = $request->query->get('marcas');

        $ids = array_map('intval', explode(',', $query));

        $modelos = $this->getDoctrine()->getRepository(Modelo::class)->findBy(['marca' => $ids]);

        return new JsonResponse($modelos);
    }

    /**
     * @Route("/carro/new", name="carro/new")
     */
    public function new(Request $request){
        
        $data = $request->query->all();

        $marcas = $this->getDoctrine()->getRepository(Marca::class)->findAll();
        $modelos = $this->getDoctrine()->getRepository(Modelo::class)->findAll();

        return $this->render('carro/form.html.twig', [
            'marcas'    => $marcas,
            'action'    => '/carros/store',
            'method'    => 'POST'
        ]);
    }


}
