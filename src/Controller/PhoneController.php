<?php
namespace App\Controller;

use App\Entity\Phone;
use App\Repository\PhoneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PhoneController extends AbstractController
{
    #[Route('/phone', name: 'app_phone')]
    public function index(PhoneRepository $phoneRepository, EntityManagerInterface $em): Response
    {
        if (count($phoneRepository->findAll()) === 0) {
            $phones = [
                ['name' => 'iPhone 15 Pro', 'brand' => 'Apple', 'price' => 1299.99],
                ['name' => 'Galaxy S24', 'brand' => 'Samsung', 'price' => 999.99],
                ['name' => 'Pixel 8', 'brand' => 'Google', 'price' => 799.99],
                ['name' => 'Xiaomi 14', 'brand' => 'Xiaomi', 'price' => 699.99],
            ];

            foreach ($phones as $data) {
                $phone = new Phone();
                $phone->setName($data['name']);
                $phone->setBrand($data['brand']);
                $phone->setPrice($data['price']);
                $em->persist($phone);
            }
            $em->flush();
        }

        $phones = $phoneRepository->findAll();

        return $this->render('phone/index.html.twig', [
            'phones' => $phones,
        ]);
    }
}
