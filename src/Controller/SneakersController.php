<?php

namespace App\Controller;

use Throwable;
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
          
        ],422);
        }

        return $this->json([
            'message' => $sneakers,
          
        ],201);
    }

    #[Route('/sneakers/{id}', name: 'app_sneakers_delete', methods:['DELETE'])]
    public function delete(int $id, SneakersRepository $sneakersRepo): JsonResponse
    {
        $sneakers = $sneakersRepo->find($id);

        if( !$sneakers instanceof Sneakers ){ return $this->json([
            'message' => 'error on ne trouve pas cette sneakers',
          
            ],422);
        }

        $sneakersRepo->remove($sneakers, true);

        return $this->json([
            'message' => 'sneakers supprimé avec succes',
          
        ],201);
    }

    #[Route('/sneakers', name: 'app_sneakers_create', methods: ['POST'])]
    public function create(Request $request, SneakersRepository $sneakersRepo): JsonResponse
    {
        
        $data = json_decode($request->getContent(), true);

        foreach  ( $data as $d) { 
            if(empty($d)){
                $this->json([
                    'message' => 'tout les champs doivent etre rempli'
                ],422);
            }
        }
        

        try {
            $sneakers = new Sneakers;
            $sneakers->setName($data['name'])
            ->setMarque($data['marque'])
            ->setPrix($data['prix'])
            ->setDescription($data['description'])
            ->setAnnee($data['annee'])
            ->setImage($data['image']);
            $sneakersRepo->add($sneakers, true);
        } catch (Throwable $th) {
            return $this->json([
                'message' => 'sneakers non créer un probleme est survenu pensez à bein remplir les champs'
            ],422);
        }

        return $this->json([
            'message' => 'sneakers créer avec succes '
        ],201);

    }

    #[Route('/sneakers/{id}', name: 'app_sneakers_update', methods:['PATCH'])]
    public function update(int $id,Request $request, SerializerInterface $serializer, SneakersRepository $sneakersRepo): JsonResponse
    {
        $sneakers = $sneakersRepo->find($id);

        if( !$sneakers instanceof Sneakers ){ 
            return $this->json([
                'message' => 'error on ne trouve pas cette sneakers'
          
            ], 404);
        }

        $data = json_decode($request->getContent(), true);


        

        try {
            $sneakers = new Sneakers;
            $sneakers->setName($data['name'])
            ->setMarque($data['marque'])
            ->setPrix($data['prix'])
            ->setDescription($data['description'])
            ->setAnnee($data['annee'])
            ->setImage($data['image']);
            $sneakersRepo->add($sneakers, true);
        } catch (Throwable $th) {
            return $this->json([
                'message' => 'sneakers non modifié veuillez rentrer tout les champs'
            ],422);
        }
        
      
        return $this->json([
            'message' => 'sneakers modifié avec succes '
        ],201);


    }

}
