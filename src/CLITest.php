<?php


require_once('CLI.php');
require_once('Controller.php');
require_once ('Exceptions/MissingArgumentException.php');

use PHPUnit\Framework\TestCase;

class CLITest extends TestCase
{

    /**
     * Test params parsing with given filename and capacity in proper way.
     */
    public function testCLIWithFilenameCapacity()
    {
        $filename = 'sample_filename';
        $capacity = 1024;

        $cli = new CLI();
        $cli->init(['path', '-f', $filename, '-c', $capacity]);

        $controller = $cli->getController();

        $this->assertEquals($filename, $controller->getFilename());
        $this->assertEquals($capacity, $controller->getCapacity());
        $this->assertEquals(0, $controller->getAlgorithm());
    }

    /**
     * Test params parsing with given filename, capacity and algorithm in proper way.
     */
    public function testCLIWithFilenameCapacityAlgorithm()
    {
        $filename = 'sample_filename';
        $capacity = 1024;
        $algorithm = 2;

        $cli = new CLI();
        $cli->init(['path', '-f', $filename, '-c', $capacity, '-a', $algorithm]);

        $controller = $cli->getController();

        $this->assertEquals($filename, $controller->getFilename());
        $this->assertEquals($capacity, $controller->getCapacity());
        $this->assertEquals($algorithm, $controller->getAlgorithm());
    }

    /**
     * Test params parsing with given filename, capacity and algorithm in proper way.
     * Some unsupported params has been added at the end.
     */
    public function testCLIWithFilenameCapacityAlgorithmOther_v1()
    {
        $filename = 'sample_filename';
        $capacity = 1024;
        $algorithm = 2;

        $cli = new CLI();
        $cli->init(['path', '-f', $filename, '-c', $capacity, '-a', $algorithm, '-s', '-p', 'abc']);

        $controller = $cli->getController();

        $this->assertEquals($filename, $controller->getFilename());
        $this->assertEquals($capacity, $controller->getCapacity());
        $this->assertEquals($algorithm, $controller->getAlgorithm());
    }

    /**
     * Test params parsing with given filename, capacity and algorithm in proper way.
     * Some unsupported params has been added into the middle and at the end.
     */
    public function testCLIWithFilenameCapacityAlgorithmOther_v2()
    {
        $filename = 'sample_filename';
        $capacity = 1024;
        $algorithm = 2;

        $cli = new CLI();
        $cli->init(['path', '-f', $filename, '-p', '-qwerty', '-c', $capacity, '-a', $algorithm, '-s', '-p', 'abc']);

        $controller = $cli->getController();

        $this->assertEquals($filename, $controller->getFilename());
        $this->assertEquals($capacity, $controller->getCapacity());
        $this->assertEquals($algorithm, $controller->getAlgorithm());
    }

    /**
     * Test params parsing with given filename, capacity and algorithm in proper way.
     * Some unsupported params has been in a random places.
     */
    public function testCLIWithFilenameCapacityAlgorithmOther_v3()
    {
        $filename = 'sample_filename';
        $capacity = 1024;
        $algorithm = 2;

        $cli = new CLI();
        $cli->init(['path', 'qwerty', '-f', $filename, '-p', '-qwerty', '-c', $capacity, '-a', $algorithm, '-s', '-p', 'abc']);

        $controller = $cli->getController();

        $this->assertEquals($filename, $controller->getFilename());
        $this->assertEquals($capacity, $controller->getCapacity());
        $this->assertEquals($algorithm, $controller->getAlgorithm());
    }

    /**
     * Test missing filename argument (-f parameter at the end).
     */
    public function testCLIWithMissingFilename_v1()
    {
        $capacity = 1024;
        $algorithm = 2;

        $cli = new CLI();
        $this->assertEquals($cli->init(['path', 'qwerty', '-p', '-qwerty', '-c', $capacity, '-a', $algorithm, '-s', '-p', '-f']), false);
    }

    /**
     * Test missing filename argument (-f parameter in the middle).
     */
    public function testCLIWithMissingFilename_v2()
    {
        $capacity = 1024;
        $algorithm = 2;

        $cli = new CLI();
        $this->assertEquals($cli->init(['path', 'qwerty', '-f', '-qwerty', '-c', $capacity, '-a', $algorithm, '-s', '-p']), false);
    }

    /**
     * Test missing filename argument (no -f parameter).
     */
    public function testCLIWithMissingFilename_v3()
    {
        $capacity = 1024;
        $algorithm = 2;

        $cli = new CLI();
        $this->assertEquals($cli->init(['path', 'qwerty', '-qwerty', '-c', $capacity, '-a', $algorithm, '-s', '-p']), false);
    }
}
