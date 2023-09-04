<?php

namespace App\Tests\Functional;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class TestBaseProcess extends WebTestCase
{
    protected KernelBrowser $client;


    protected function setUp(): void
    {
        $this->client = self::createClient();
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->client->getContainer()->get('doctrine')->getManager();
    }
}