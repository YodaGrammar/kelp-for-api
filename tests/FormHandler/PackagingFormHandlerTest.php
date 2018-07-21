<?php

namespace App\Tests\FormHandler;

use App\Entity\Packaging;
use App\Form\Handler\PackagingFormHandler;
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

        $this->repositoryProphecy->createOrUpdate(Argument::type(Packaging::class))->shouldBeCalled();

        $result = $this->packagingFormHandler->process($this->requestProphecy->reveal(), new Packaging());

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

        $result = $this->packagingFormHandler->process($this->requestProphecy->reveal(), new Packaging());

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

        $result = $this->packagingFormHandler->process($this->requestProphecy->reveal(), new Packaging());

        $this->assertFalse($result);
    }
}
