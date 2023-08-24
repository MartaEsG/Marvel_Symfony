<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

    #[Route("/characters", methods:["GET"])]
    public function getCharacters (){

        $characters = [
            [
                "name" => "IronMan",
                "planet" => "Earth"

            ], 
            [
                "name" => "Thor",
                "planet" => "Asgard"
            ]
        ];
        return $this -> render ("personajes/listCharacters.html.twig", ["characters"=> $characters]);
        // return new JsonResponse($characters); esto es pera retornar un fichero del tipo json
    }

    #[Route("/character/{id}", methods:["GET"])]
    public function getCharacter ($id){
        $character = [
            "name" => "IronMan",
            "planet" => "Earth"
        ]; 

        return $this -> render ("personajes/character.html.twig", ["id"=> $id, "character"=> $character]);
    }

    #[Route("/character/{id}", methods:["PUT"])]
    public function edit($id){

        $response = [
            "message" => "Se ha editado correctamente el id $id",
            "success" => true
        ];

        return new JsonResponse($response); 

    }

    #[Route("/character/{id}", methods:["DELETE"])]
    public function delete($id){

        $response = [
            "message" => "Se ha borrado correctamente el id $id" ,
            "success" => true
        ];

        return new JsonResponse($response);
    } 


}