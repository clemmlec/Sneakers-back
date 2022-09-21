<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[Route('/register', name: 'app_user_register', methods: ['POST'])]
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordEncoder,
        UserRepository $userRepo): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        try {
            $user = new User;
            $user->setEmail($data['email'])
                ->setPassword($passwordEncoder->hashPassword(
                    $user,
                    $data['password']
                ));
            
            $userRepo->add($user, true);

        } catch (Throwable $th) {
            return $this->json([
                'message' => 'user non créer un probleme est survenu pensez à bein remplir les champs'
            ],422);
        }

        return $this->json([
            'message' => 'user créer avec succes '
        ],201);
    }
    
    // #[Route('/login', name: 'app_user_login', methods: ['POST'])]
    // public function index(Request $request,UserRepository $userRepo): JsonResponse
    // {

    //     $data = json_decode($request->getContent(), true);

    //     try {

    //         $user
            
            
            

    //     } catch (Throwable $th) {
    //         return $this->json([
    //             'message' => 'user non créer un probleme est survenu pensez à bein remplir les champs'
    //         ],422);
    //     }

    //     return $this->json([
    //         'message' => 'user créer avec succes '
    //     ],201);
    // }
}
