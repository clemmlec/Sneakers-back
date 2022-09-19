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
    public function index(SneakersRepository $sneakersRepo): JsonResponse
    {
        $sneakers = $sneakersRepo->findAll();
        // $sneakersJson = $serializer->serialize($book, 'json', ['groups' => 'getBooks']);

        return $this->json([
            'message' => $sneakers,
          
        ]);
    }

    #[Route('/sneakers/{id}', name: 'app_sneakers_details', methods:['GET'])]
    public function details(int $id, SneakersRepository $sneakersRepo): JsonResponse
    {
        $sneakers = $sneakersRepo->find($id);

        if( !$sneakers instanceof Sneakers ){ return $this->json([
            'message' => 'error on ne trouve pas cette sneakers',
          
        ]);
        }

        // $sneakersJson = $serializer->serialize($book, 'json', ['groups' => 'getBooks']);

        return $this->json([
            'message' => $sneakers,
          
        ]);
    }

    #[Route('/sneakers', name: 'app_sneakers_create', methods: ['POST'])]
    public function create(Request $request, SerializerInterface $serializer,  SneakersRepository $sneakersRepo): JsonResponse
    {
        
        $sneakers = $serializer->deserialize($request->getContent(), Sneakers::class, 'json');
        
        if($sneakersRepo->add($sneakers, true)){
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
