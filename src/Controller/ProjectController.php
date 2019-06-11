<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/project")
 */
class ProjectController extends AbstractController
{
    /**
     * @Route("/", name="project_index", methods={"GET"})
     */
    public function index(ProjectRepository $projectRepository, SerializerInterface $serializer): Response
    {

        // find all products in database
        $projects = $projectRepository->findAll();

        if(!$projects)
        {
            throw $this->createNotFoundException('Aucun article n\'a été trouvé');
        }

        // setup serializer parameters
        $normalizers = [
            new ObjectNormalizer() // new instance of ObjectNormalizer
        ];
        $encoders = [
            new JsonEncoder() // new instance of JsonEncoder
        ];

        // instantiate serializer and pass the normalizers && encoders parameters
        $serializer = new Serializer($normalizers, $encoders);

        // serialize $projects object
        $data = $serializer->serialize($projects, 'json');

        return new JsonResponse($data, 200, [], true);

    }

    /**
     * @Route("/new", name="project_new", methods={"POST"})
     */
    public function new(Request $request, ObjectManager $manager, ValidatorInterface $validator): Response
    {
        $project = new Project();
        
        $body = $request->getContent();
        $data = json_decode($body, true);
        $data['created_at'] = new \DateTime();

        $form = $this->createForm(ProjectType::class, $project);
        $form->submit($data);

        $errors = $validator->validate($project);

        if(count($errors) > 0)
        {
            $errorMessage = (string) $errors;
            return new JsonResponse($errorMessage);
        }

        $manager->persist($project);
        $manager->flush();

        return new JsonResponse([
            'message' => 'Project saved to db'
        ], 200,[]);

    }

    /**
     * @Route("/{id}", name="project_show", methods={"GET"})
     */
    public function show(Project $project, SerializerInterface $serializer): Response
    {

        // setup serializer parameters
        $normalizers = [
            new ObjectNormalizer()
        ];
        $encoders = [
            new JsonEncoder() // we're going ton encode to Json
        ];

        // instantiate serializer and pass the normalizers && encoders parameters
        $serializer = new Serializer($normalizers, $encoders);

        // serialize $projects object
        $data = $serializer->serialize($project, 'json');

        // return response
        return new JsonResponse($data, 200, [], true);
        
    }

    /**
     * @Route("/{id}/edit", name="project_edit", methods={"PUT","POST"})
     */
    public function edit(Request $request, Project $project , ValidatorInterface $validator, ObjectManager $manager): Response
    {
        
        $body = $request->getContent();
        $data = json_decode($body, true);

        $form = $this->createForm(ProjectType::class, $project);
        $form->submit($data);

        $errors = $validator->validate($project);

        if(count($errors) > 0)
        {
            $errorMessage = (string) $errors;
            return new JsonResponse($errorMessage);
        }

        $manager->persist($project);
        $manager->flush();

        return new JsonResponse([
            'message' => 'Project updated and saved to db'
        ], 200,[]);

        // return $this->render('project/edit.html.twig', [
        //     'project' => $project,
        //     'form' => $form->createView(),
        // ]);
    }

    /**
     * @Route("/{id}", name="project_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Project $project, ObjectManager $manager): Response
    {
            $manager->remove($project);
            $manager->flush();

        return new JsonResponse([
            'message' => 'Project successfully removed from db'
        ], 200, []);
    }
}
