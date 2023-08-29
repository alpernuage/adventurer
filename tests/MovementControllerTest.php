<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class MovementControllerTest extends WebTestCase
{
    public function testShowMovePage(): void
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, '/move');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Movement Page');
    }

    /**
     * @dataProvider scenarioProvider
     */
    public function testScenario($startCoordinates, $movements, $expectedCoordinates): void
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, '/move');

        $client->submitForm('Submit', [
            'character[Column]' => $startCoordinates[0],
            'character[Line]' => $startCoordinates[1],
            'character[movements]' => $movements,
        ]);

        self::assertResponseIsSuccessful();
        self::assertSelectorExists("h2:contains('Result:')");
        self::assertSelectorTextContains('p', 'Final coordinates: Y = ' . $expectedCoordinates[0] . ', X = ' . $expectedCoordinates[1]);
    }

    /*
     * Start at[Y, X], Move to, End at[Y, X]
     */
    public static function scenarioProvider(): array
    {
        return [
            [[3, 0], 'SSSSEEEEEENN', [9, 2]],
            [[12, 4], 'OONOOOSSOO', [7, 5]],
        ];
    }
}
