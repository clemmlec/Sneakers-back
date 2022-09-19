<?php

namespace App\Controller;

use App\Entity\Sneakers;
use App\Repository\SneakersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SneakersController extends AbstractController
{
    #[Route('/sneakers', name: 'app_sneakers', methods:['GET'])]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/SneakersController.php',
        ]);
    }

    #[Route('/sneakers', name: 'app_sneakers_create', methods: ['POST'])]
    public function create(Request $request, SerializerInterface $serializer,  SneakersRepository $em): JsonResponse
    {
        
        $sneakers = $serializer->deserialize($request->getContent(), Sneakers::class, 'json');
        
        if($em->add($sneakers, true)){
            return $this->json([
                'message' => 'sneakers créer avec succes '
            ]);
        }else{
            return $this->json([
                'message' => 'sneakers non créer un probleme est survenu'
            ]);
        }
        

       
    }

}
