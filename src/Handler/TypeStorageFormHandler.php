<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 09/02/2018
 * Time: 13:34
 */

namespace App\Handler;

/**
 * Class ProgramFormHandler.
 *
 * @author Michael COULLERET <michael.coulleret.ext@francetv.fr>
 * @author Amine Fattouch <amine.fattouch.ext@francetv.fr>
 * @author Florent DESPIERRES <florent.despierres.ext@francetv.fr>
 */
class TypeStorageFormHandler
{
//    /**
//     * @var UserManager
//     */
//    protected $userManager;
//
//    /**
//     * @var TokenStorageInterface
//     */
//    protected $tokenStorage;
//
//    /**
//     * @var EventDispatcherInterface
//     */
//    protected $eventDispatcher;
//
//    /**
//     * @var LoggerInterface
//     */
//    protected $logger;
//
//    /**
//     * BroadcastHandler constructor.
//     *
//     * @param FormFactoryInterface     $factory
//     * @param UserManager              $userManager
//     * @param TokenStorageInterface    $tokenStorage
//     * @param EventDispatcherInterface $eventDispatcher
//     * @param LoggerInterface          $logger
//     */
//    public function __construct(
//        FormFactoryInterface $factory,
//        UserManager $userManager,
//        TokenStorageInterface $tokenStorage,
//        EventDispatcherInterface $eventDispatcher,
//        LoggerInterface $logger
//    )
//    {
//        $this->form            = $factory->createNamed('app_program',
//                                                       ProgramFormType::class, null,
//                                                       ['validation_groups' => ['program']]);
//        $this->userManager     = $userManager;
//        $this->tokenStorage    = $tokenStorage;
//        $this->eventDispatcher = $eventDispatcher;
//        $this->logger          = $logger;
//    }

//    /**
//     * process.
//     *
//     * @param Request $request
//     * @param Program $program
//     *
//     * @return bool
//     */
//    public function process(Request $request, Program $program)
//    {
//        $user = $this->tokenStorage->getToken()->getUser();
//        $program->setTeam($user->getTeamId());
//
//        $this->form->setData($program);
//        $this->form->handleRequest($request);
//
//        if ($this->form->isSubmitted() && $this->form->isValid()) {
//            /** @var User $user */
//            $user = $this->userManager->findOneById($user->getId());
//
//            $user->addUserProgram((new UserProgram())->setProgram($program)->setRole('ROLE_MANAGER'));
//
//            $isNewProgram = null === $program->getId();
//            $this->userManager->createOrUpdate($user);
//
//            if (true === $isNewProgram) {
//                try {
//                    $this->eventDispatcher->dispatch(AppEvents::PROGRAM_CREATED, new ProgramEvent($program));
//                } catch (\Exception $e) {
//                    $this->logger->error($e->getMessage());
//                }
//            }
//
//            return true;
//        }
//
//        return false;
//    }
}
