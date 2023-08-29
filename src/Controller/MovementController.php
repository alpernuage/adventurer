<?php

namespace App\Controller;

use App\Entity\Character;
use App\Form\CharacterType;
use App\Service\MapService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovementController extends AbstractController
{
    private array $mapData;

    public function __construct(private MapService $mapService)
    {
        if ($_ENV['APP_ENV'] === 'test') {
            $this->mapData = $this->mapService->loadMapFromFile('tests/data/test_carte.txt');
        } else {
            $this->mapData = $this->mapService->loadMapFromFile('data/carte.txt');
        }
    }

    #[Route('/move', name: 'app_move')]
    public function move(Request $request): Response
    {
        $form = $this->createForm(CharacterType::class);
        $form->handleRequest($request);
        $result = null;

        if ($form->isSubmitted() && $form->isValid()) {
            $initialX = $form->get('Line')->getData();
            $initialY = $form->get('Column')->getData();
            $movements = $form->get('movements')->getData();
            $character = new Character($initialX, $initialY);

            foreach (str_split($movements) as $movement) {
                $this->moveCharacter($character, $movement);
            }

            $finalX = $character->getX();
            $finalY = $character->getY();

            $result = [
                'x' => $finalX,
                'y' => $finalY,
            ];
        }

        return $this->render('movement.html.twig', [
            'form' => $form->createView(),
            'result' => $result,
        ]);
    }

    public function moveCharacter(Character $character, string $direction): void
    {
        if ($direction === 'N' && $this->mapService->isFieldAccessible($this->mapData, $character->getX() - 1, $character->getY())) {
            $character->setX($character->getX() - 1);
        } elseif ($direction === 'S' && $this->mapService->isFieldAccessible($this->mapData, $character->getX() + 1, $character->getY())) {
            $character->setX($character->getX() + 1);
        } elseif ($direction === 'E' && $this->mapService->isFieldAccessible($this->mapData, $character->getX(), $character->getY() + 1)) {
            $character->setY($character->getY() + 1);
        } elseif ($direction === 'O' && $this->mapService->isFieldAccessible($this->mapData, $character->getX(), $character->getY() - 1)) {
            $character->setY($character->getY() - 1);
        }
    }
}

