<?php
declare(strict_types=1);

namespace Tests\Functional\Generator;

use FunctionalTester;
use Metamorph\Context\TransformerType;
use Metamorph\Generator\TransformerGenerator;
use PhpParser\ParserFactory;
use Tests\Fixture\TestConfigNormalized;

class TransformerGeneratorFromArrayToObjectCest
{
    public function __construct()
    {
    }

    public function testClassGeneration(FunctionalTester $I)
    {
        $generator = new TransformerGenerator(TestConfigNormalized::get());

        $transformerType = (new TransformerType())
            ->setFrom('array')
            ->setTo('object')
            ->setType('user');

        $generator->generateType($transformerType);

        $fileName = __DIR__ . '/../../_support/Fixture/Transformer/TestUserArrayToObjectTransformer.php';
        $contents = file_get_contents($fileName);

        $I->assertSame($this->expectedClass(), $contents);
    }

    private function expectedClass()
    {
        return <<<'CLASS'
<?php

namespace Tests\Fixture\Transformer;

use Metamorph\Resource\AbstractResource;
use Metamorph\TransformerInterface;
class TestUserArrayToObjectTransformer implements TransformerInterface
{
    public function transform(AbstractResource $resource)
    {
        $userArray = $resource->getValue();
        $addressArray = $userArray['address'];
        $addressObject = new \Tests\Fixture\TestAddress();
        $addressObject->setCity($addressArray['city']);
        $addressObject->setState($addressArray['state']);
        $userObject = new \Tests\Fixture\TestUser();
        $userArrayBirthday = $userArray['birth_day'];
        if (empty($userArrayBirthday)) {
            $userObjectBirthday = null;
        }
        try {
            if ($userArrayBirthday instanceof \MongoDB\BSON\UTCDateTime) {
                $userArrayBirthday = $userArrayBirthday->toDateTime();
            }
            if ($userArrayBirthday instanceof \Carbon\Carbon) {
                $userObjectBirthday = $userArrayBirthday;
            }
            if ($userArrayBirthday instanceof \DateTime) {
                $userObjectBirthdayCarbon = new \Carbon\Carbon($userArrayBirthday);
                $userObjectBirthday = $userObjectBirthdayCarbon;
            }
            if (is_string($userArrayBirthday)) {
                $userObjectBirthdayCarbon = new \Carbon\Carbon($userArrayBirthday);
                $userObjectBirthday = $userObjectBirthdayCarbon;
            }
        } catch (\Exception $userObjectBirthdayE) {
            throw new \Metamorph\Exception\TransformException('Failed to transform userArrayBirthday because Carbon.');
        }
        $userArrayId = $userArray['_id'];
        $userObjectId = \Ramsey\Uuid\Uuid::fromString($userArrayId);
        $userObject->setAddress($addressObject);
        $userObject->setAllowed($userArray['allowed']);
        $userObject->birthday = $userObjectBirthday;
        $userObject->setId($userObjectId);
        $userObject->setQualified($userArray['qualified']);
        $userObject->setUsername($userArray['username']);
        return $userObject;
    }
    public function setExclusions(AbstractResource $resource)
    {
    }
}
CLASS;
    }
}
