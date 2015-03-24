<?php

namespace Acme\DemoBundle\Manager;


class DeletionManager
{
    /**
     * @var ApiEntityManager
     */
    protected $apiEm;

    /**
     * @var ObjectManager
     */
    protected $om;


    /**
     * @param ApiEntityManager $apiEm
     */
    public function setApiEntitManager(ApiEntityManager $apiEm){

        $this->apiEm = $apiEm;
        $this->om = $apiEm->getObjectManager();
    }

    /**
     * Checks if the entity has a Assignments
     * @param $entity
     * @return bool
     * @throws \Exception
     */
    public function hasAssignments($entity)
    {

        $result    = false;
        $classMeta = $this->om->getClassMetadata($this->apiEm->getClass());

        foreach ($classMeta->getAssociationMappings() as $association) {
            $functName = 'get'.ucfirst($association['fieldName']);
            $data = call_user_func([$entity, $functName],null);
            if (!empty($data)) {
                $result = true;
                break;
            }
        }

        return $result;
    }


}
