<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 26/03/2018
 * Time: 10:32
 */

namespace App\Mapper;

use App\DTOFilter\PackagingDTOFilter;
use App\Entity\Packaging;
use App\Entity\Repository\PackagingRepository;
use App\Factory\PackagingFactory;
use Doctrine\Common\Persistence\ObjectManager;

class PackagingMapper
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var PackagingFactory
     */
    protected $packagingFactory;

    /**
     * PackagingMapper constructor.
     * @param ObjectManager    $objectManager
     * @param PackagingFactory $packagingFactory
     */
    public function __construct(ObjectManager $objectManager, PackagingFactory $packagingFactory)
    {
        $this->objectManager      = $objectManager;
        $this->packagingFactory = $packagingFactory;
    }

    /**
     * @return PackagingRepository
     */
    protected function getRepository():PackagingRepository
    {
        return $this->objectManager->getRepository(Packaging::class);
    }

    /**
     * @param PackagingDTOFilter $packagingDTO
     * @param                    $page
     * @param                    $maxPage
     * @return mixed
     */
    public function findAllByFilters(PackagingDTOFilter $packagingDTO, $page, $maxPage)
    {
        return $this->getRepository()->findAllByFilters($packagingDTO->text, $page, $maxPage);
    }
}
