<?php
declare(strict_types=1);

namespace Tests\Unit\Factory;

use Metamorph\Factory\MetamorphConfigFactory;
use Tests\Fixture\TestConfig;
use Tests\Fixture\TestConfigWithoutTransformations;
use Tests\Fixture\TestConfigNormalized;
use UnitTester;
use PHPUnit\Framework\Exception;

class MetamorphConfigFactoryCest
{
    public function testInvoke(UnitTester $I)
    {
        $config = TestConfig::get();

        $normalized = (new MetamorphConfigFactory())($config);

        $expected = TestConfigNormalized::get();

        $I->assertEquals($expected, $normalized);
    }

    public function testInvokeWithoutTransformationsConfig(UnitTester $I)
    {
        $config = TestConfigWithoutTransformations::get();

        $I->expectException(new Exception('The transformations is not found'), function() {
            (new MetamorphConfigFactory())($config);
        });
    }
}
