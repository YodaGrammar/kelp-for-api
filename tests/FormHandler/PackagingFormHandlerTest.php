<?php

namespace App\Tests\FormHandler;

use App\DTO\PackagingDTO;
use App\FormHandler\PackagingFormHandler;
use App\Repository\PackagingRepository;
use Prophecy\Argument;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use PHPUnit\Framework\TestCase;

class PackagingFormHandlerTest extends TestCase
{
    private $requestProphecy;
    private $formProphecy;
    private $formFactoryProphecy;
    private $repositoryProphecy;
    private $packagingFormHandler;

    /**
     * @throws \Prophecy\Exception\Doubler\ClassNotFoundException
     * @throws \Prophecy\Exception\Doubler\DoubleException
     * @throws \Prophecy\Exception\Doubler\InterfaceNotFoundException
     * @throws \Prophecy\Exception\Prophecy\ObjectProphecyException
     * @throws \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
    public function setUp()
    {
        $this->requestProphecy     = $this->prophesize(Request::class);
        $this->formProphecy        = $this->prophesize(FormInterface::class);
        $this->formFactoryProphecy = $this->prophesize(FormFactoryInterface::class);
        $this->repositoryProphecy  = $this->prophesize(PackagingRepository::class);

        $this->formFactoryProphecy
            ->createNamed(Argument::any(), Argument::any())
            ->willReturn($this->formProphecy->reveal());

        $this->packagingFormHandler = new PackagingFormHandler(
            $this->formFactoryProphecy->reveal(),
            $this->repositoryProphecy->reveal()
        );
    }

    /**
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testShouldReturnFormWhenGetFormCalled(): void
    {
        $this->assertInstanceOf(FormInterface::class, $this->packagingFormHandler->getForm());
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

        $this->repositoryProphecy->create(Argument::type(PackagingDTO::class))->shouldBeCalled();

        $result = $this->packagingFormHandler->process($this->requestProphecy->reveal(), new PackagingDTO());

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

        $this->repositoryProphecy->edit(Argument::type(PackagingDTO::class))->shouldBeCalled();

        $storage     = new PackagingDTO();
        $storage->id = 123;

        $result = $this->packagingFormHandler->process($this->requestProphecy->reveal(), $storage);

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

        $result = $this->packagingFormHandler->process($this->requestProphecy->reveal(), new PackagingDTO());

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

        $result = $this->packagingFormHandler->process($this->requestProphecy->reveal(), new PackagingDTO());

        $this->assertFalse($result);
    }
}
