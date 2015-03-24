<?php

namespace Acme\DemoBundle\Handler\Api;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityNotFoundException;
use Acme\DemoBundle\Manager\ApiEntityManager;
use Acme\DemoBundle\Manager\DeletionManager;

/**
 * A class encapsulates a business logic responsible to delete entity
 */
class DeleteHandler
{

    /**
     * @var DeletionManager
     */
    protected $deletionManager;

    /**
     * @param DeletionManager $deletionManager
     */
    public function __construct(DeletionManager $deletionManager)
    {
        $this->deletionManager = $deletionManager;
    }

    /**
     * Handle delete entity object.
     *
     * @param mixed            $id
     * @param ApiEntityManager $manager
     * @throws EntityNotFoundException if an entity with the given id does not exist
     * @throws \Exception
     */
    public function handleDelete($id, ApiEntityManager $manager)
    {
        $entity = $manager->find($id);
        if (!$entity) {
            throw new EntityNotFoundException();
        }

        $em = $manager->getObjectManager();
        $this->checkPermissions($entity, $manager);
        $this->deleteEntity($entity, $em);
        $em->flush();
    }

    /**
     * Checks if a delete operation is allowed
     * @param $entity
     * @param ApiEntityManager $manager
     * @throws \Exception
     */
    protected function checkPermissions($entity, ApiEntityManager $manager)
    {
        $this->deletionManager->setApiEntitManager($manager);

        if ($this->deletionManager->hasAssignments($entity)) {
            throw new \Exception('has assignments');
        };
    }

    /**
     * Deletes the given entity
     *
     * @param object        $entity
     * @param ObjectManager $em
     */
    protected function deleteEntity($entity, ObjectManager $em)
    {
        $em->remove($entity);
    }
}
