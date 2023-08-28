<?php 

namespace App\Controller;

use App\Entity\Characters;
use App\Entity\Weakness;
use App\Form\CharacterFormType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

    #[Route("/characters", methods:["GET"])]
    public function getCharacters (EntityManagerInterface $doctrine){

        $repository = $doctrine->getRepository(Characters::class);
        $characters = $repository ->findAll();
      
        return $this -> render ("personajes/listCharacters.html.twig", ["characters"=> $characters]);

        // return new JsonResponse($characters); esto es pera retornar un fichero del tipo json
    }

    #[Route("/character/{id}", name:"detailcharacter", methods:["GET"])]
    public function getCharacter ($id, EntityManagerInterface $doctrine){
        
        $repository = $doctrine->getRepository(Characters::class);
        $character = $repository->find($id);  //findByOne - findAll - findBy
        // dd($character);

        return $this -> render ("personajes/character.html.twig", ["id"=> $id, "character"=>$character]);
    }

    #[Route("/character/{id}", methods:["PUT"])]
    public function edit(Characters $character, $id, EntityManagerInterface $doctrine){

        $repository = $doctrine->getRepository(Characters::class);
        $character = $repository->find($id);

        // $character->setDescription("Es hijo de Odin y lleva un martillo mágico");

        // $date = new DateTime("1000-01-01");
        // $character->setBirthDate($date);

        $character->setDescription("Tiene mucho dinero y lleva un traje de hierro que se ha fabricado");

        $date = new DateTime("1980-09-30");
        $character->setBirthDate($date);
        $doctrine-> flush();

        $response = [
            "message" => "Se ha editado correctamente el id $id",
            "success" => true
        ];

        return new JsonResponse($response); 

    }

    #[Route("/character/{id}", methods:["DELETE"])]
    public function delete($id, EntityManagerInterface $doctrine){

        $repository = $doctrine->getRepository(Characters::class);
        $character = $repository->find($id);
        $doctrine->remove($character);
        $doctrine->flush();

        
        $response = [
            "message" => "Se ha borrado correctamente el id $id" ,
            "success" => true
        ];

        return new JsonResponse($response);
    } 



    #[Route("/character", methods:["POST"])]
    public function insertCharacter(EntityManagerInterface $doctrine)
    {
        $weakness = new Weakness ();
        $weakness -> setName("debilidad de IronMan");

        $weakness2 = new Weakness ();
        $weakness2 -> setName("debilidad de Thor");

        $character = new Characters();
        $character ->setName("Iron Man");
        $character ->setPlanet("Earth");
        $character ->setSuperPower("Inteligencia");
        $character-> addWeakness($weakness);
        $character ->setDescription("Lleva un traje de hierro que se ha fabricado");
        
        $character2 = new Characters();
        $character2 ->setName("Thor");
        $character2 ->setPlanet("Asgard");
        $character2 ->setSuperPower("rayo");
        $character2-> addWeakness($weakness2);
        $character2 ->setDescription("Lleva un martillo mágico");
        

        $doctrine->persist($weakness);
        $doctrine->persist($weakness2);
        $doctrine->persist($character);
        $doctrine->persist($character2);
        $doctrine->flush();

        return new Response ("Se ha insertado");
    } 

    #[Route ("/createCharacter", name: "createCharacter")]
    public function create(Request $request, EntityManagerInterface $doctrine){

        $form = $this->createForm(CharacterFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $character = $form->getData();
            $doctrine->persist($character);
            $doctrine->flush();
        }

        return $this->render("personajes/createCharacter.html.twig", ["formCharacter"=>$form]);
    }

}