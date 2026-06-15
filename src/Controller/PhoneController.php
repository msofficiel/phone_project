<?php
namespace App\Controller;

use App\Entity\Phone;
use App\Form\PhoneType;
use App\Repository\PhoneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PhoneController extends AbstractController
{
    #[Route('/phone', name: 'app_phone')]
    public function index(PhoneRepository $phoneRepository, EntityManagerInterface $em): Response
    {
       

        $phones = $phoneRepository->findAll();
        return $this->render('phone/index.html.twig', ['phones' => $phones]);
    }

    #[Route('/phone/new', name: 'app_phone_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $phone = new Phone();
        $form = $this->createForm(PhoneType::class, $phone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($phone);
            $em->flush();
            return $this->redirectToRoute('app_phone');
        }

        return $this->render('phone/new.html.twig', ['form' => $form]);
    }

    #[Route('/phone/{id}', name: 'app_phone_show')]
    public function show(Phone $phone): Response
    {
        return $this->render('phone/show.html.twig', ['phone' => $phone]);
    }
}
