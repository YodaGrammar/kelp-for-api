<?php

namespace App\Tests\FormHandler;

use App\DTO\StorageDTO;
use App\Factory\Entity\StorageFactory;
use App\FormHandler\StorageFormHandler;
use App\Repository\StorageRepository;
use Prophecy\Argument;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use PHPUnit\Framework\TestCase;

class StorageFormHandlerTest extends TestCase
{
    private $requestProphecy;
    private $formProphecy;
    private $formFactoryProphecy;
    private $repositoryProphecy;
    private $storageFormHandler;
    private $factoryProphecy;

    /**
     * @throws \Prophecy\Exception\Doubler\ClassNotFoundException
     * @throws \Prophecy\Exception\Doubler\DoubleException
     * @throws \Prophecy\Exception\Doubler\InterfaceNotFoundException
     * @throws \Prophecy\Exception\Prophecy\ObjectProphecyException
     * @throws \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
    public function setUp(): void
    {
        $this->requestProphecy     = $this->prophesize(Request::class);
        $this->formProphecy        = $this->prophesize(FormInterface::class);
        $this->formFactoryProphecy = $this->prophesize(FormFactoryInterface::class);
        $this->repositoryProphecy  = $this->prophesize(StorageRepository::class);
        $this->factoryProphecy     = $this->prophesize(StorageFactory::class);

        $this->formFactoryProphecy
            ->createNamed(Argument::any(), Argument::any())
            ->willReturn($this->formProphecy->reveal());

        $this->storageFormHandler = new StorageFormHandler(
            $this->formFactoryProphecy->reveal(),
            $this->repositoryProphecy->reveal(),
            $this->factoryProphecy->reveal()
        );
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testShouldReturnFormWhenGetFormCalled(): void
    {
        $this->assertInstanceOf(FormInterface::class, $this->storageFormHandler->getForm());
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testShouldCallsAddIfFormIsValid(): void
    {
        $this->formProphecy->setData(Argument::any())->shouldBeCalled();
        $this->formProphecy->handleRequest(Argument::type(Request::class))->shouldBeCalled();

        $this->formProphecy->isValid()->willReturn(true);
        $this->formProphecy->isSubmitted()->willReturn(true);

        $this->repositoryProphecy->create(Argument::type(StorageDTO::class))->shouldBeCalled();

        $result = $this->storageFormHandler->process($this->requestProphecy->reveal(), new StorageDTO());

        $this->assertTrue($result);
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testShouldCallsEditIfFormIsValid(): void
    {
        $this->formProphecy->setData(Argument::any())->shouldBeCalled();
        $this->formProphecy->handleRequest(Argument::type(Request::class))->shouldBeCalled();

        $this->formProphecy->isValid()->willReturn(true);
        $this->formProphecy->isSubmitted()->willReturn(true);

        $this->repositoryProphecy->edit(Argument::type(StorageDTO::class))->shouldBeCalled();

        $storage     = new StorageDTO();
        $storage->id = 123;

        $result = $this->storageFormHandler->process($this->requestProphecy->reveal(), $storage);

        $this->assertTrue($result);
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testShouldReturnFalseIfFormIsInvalid(): void
    {
        $this->formProphecy->isValid()->willReturn(false);
        $this->formProphecy->isSubmitted()->willReturn(true);

        $this->formProphecy->setData(Argument::any())->shouldBeCalled();
        $this->formProphecy->handleRequest(Argument::type(Request::class))->shouldBeCalled();

        $result = $this->storageFormHandler->process($this->requestProphecy->reveal(), new StorageDTO());

        $this->assertFalse($result);
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testShouldReturnFalseIfFormIsNotSubmitted(): void
    {
        $this->formProphecy->isValid()->willReturn(true);
        $this->formProphecy->isSubmitted()->willReturn(false);

        $this->formProphecy->setData(Argument::any())->shouldBeCalled();
        $this->formProphecy->handleRequest(Argument::type(Request::class))->shouldBeCalled();

        $result = $this->storageFormHandler->process($this->requestProphecy->reveal(), new StorageDTO());

        $this->assertFalse($result);
    }
}
