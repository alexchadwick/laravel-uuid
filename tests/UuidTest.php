<?php

use PHPUnit\Framework\TestCase;

use AlexChadwick\Uuid\Uuid;

class UuidTest extends TestCase
{
    public function testStaticGeneration()
    {
        $uuid = Uuid::generate(4);
        $this->assertInstanceOf('AlexChadwick\Uuid\Uuid', $uuid);
    }

    public function testStaticGenerationStringProperty()
    {
        $uuid = Uuid::generate(4);
        $this->assertInstanceOf('AlexChadwick\Uuid\Uuid', $uuid);
        $this->assertTrue(is_string($uuid->string));
    }

    public function testStaticGenerationCastString()
    {
        $uuid = Uuid::generate(4);
        $this->assertInstanceOf('AlexChadwick\Uuid\Uuid', $uuid);
        $this->assertTrue(is_string((string) $uuid));
    }

    public function testStaticStringGeneration()
    {
        $uuid = Uuid::uuid4();
        $this->assertTrue(is_string($uuid));
    }

    public function testGenerationOfValidUuidViaValidator()
    {
        $uuid4String = Uuid::uuid4();
        $this->assertTrue(Uuid::validate($uuid4String));

        $uuid = Uuid::generate(4);
        $this->assertTrue(Uuid::validate($uuid->string));
    }

    public function testGenerationOfInvalidUuidViaValidator()
    {
        $invalidUuid4String = '1e196941-bd7e-01fb-9c10-717208373c21';
        $this->assertFalse(Uuid::validate($invalidUuid4String));
    }
}