<?php

namespace Acme\DemoBundle\Manager;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\Mapping\ClassMetadata;

use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\EventDispatcher\EventDispatcher;

use  Acme\DemoBundle\Helper\QueryBuilderHelper;

class ApiEntityManager
{
    /**
     * @var string
     */
    protected $class;

    /**
     * @var ObjectManager
     */
    protected $om;

    /**
     * @var ClassMetadata|ClassMetadataInfo
     */
    protected $metadata;

    /**
     * @var EventDispatcher
     */
    protected $eventDispatcher;

    /**
     * Constructor
     *
     * @param string          $class Entity name
     * @param ObjectManager   $om Object manager
     */
    public function __construct($class, ObjectManager $om)
    {
        $this->om       = $om;
        $this->metadata = $this->om->getClassMetadata($class);
        $this->class    = $this->metadata->getName();
    }

    /**
     * Sets a event dispatcher
     *
     * @param EventDispatcher $eventDispatcher
     */
    public function setEventDispatcher(EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Get entity metadata
     *
     * @return ClassMetadata|ClassMetadataInfo
     * */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * Create new entity instance
     *
     * @return mixed
     */
    public function createEntity()
    {
        return new $this->class;
    }

    /**
     * Get entity by identifier.
     *
     * @param  mixed  $id
     * @return object
     *  */
    public function find($id)
    {
        $object = $this->getRepository()->find($id);

        return $object;
    }

    /**
     * @param  object                    $entity
     * @return int
     * @throws \InvalidArgumentException
     */
    public function getEntityId($entity)
    {
        $className = $this->class;
        if (!$entity instanceof $className) {
            throw new \InvalidArgumentException('Expected instance of ' . $this->class);
        }

        $idField   = $this->metadata->getSingleIdentifierFieldName();
        $entityIds = $this->metadata->getIdentifierValues($entity);

        return $entityIds[$idField];
    }

    /**
     * Return related repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return $this->getObjectManager()->getRepository($this->class);
    }

    /**
     * Retrieve object manager
     *
     * @return ObjectManager
     */
    public function getObjectManager()
    {
        return $this->om;
    }

    /**
     * Returns array of item matching filtering criteria
     *
     * In case when limit and offset set to null QueryBuilder instance will be returned.
     *
     * @deprecated since 1.4.1 use getListQueryBuilder instead
     * @param int        $limit
     * @param int        $page
     * @param array      $criteria
     * @param array|null $orderBy
     *
     * @return \Traversable
     */
    public function getList($limit = 10, $page = 1, $criteria = [], $orderBy = null)
    {
        $criteria = $this->prepareQueryCriteria($limit, $page, $criteria, $orderBy);

        return $this->getRepository()
            ->matching($criteria)
            ->toArray();
    }

    /**
     * Returns query builder that could be used for fetching data based on given filtering criteria
     *
     * @param int $limit
     * @param int $page
     * @param array $criteria
     * @param null $orderBy
     *
     * @param null $offset
     * @internal param null $offest
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getListQueryBuilder($limit = 10, $page = 1, $criteria = [], $orderBy = null, $offset = null)
    {
        $criteriaList = $this->prepareQueryCriteria($limit, $page, $criteria, $orderBy, $offset);

        $qb = $this->getRepository()->createQueryBuilder('e');
        foreach ($criteria as $fieldName => $value){
            if(is_array($value)){
                $qb->join('e.'.$fieldName, $fieldName)
                   ->andWhere($fieldName.'.id IN (:ids)')
                    ->setParameter('ids', $value);
            }
        }
        // fix of doctrine error with Same Field, Multiple Values, Criteria and QueryBuilder
        // http://www.doctrine-project.org/jira/browse/DDC-2798
        // TODO revert changes when doctrine version >= 2.5 in scope of BAP-5577
        QueryBuilderHelper::addCriteria($qb, $criteriaList);

        return $qb;
    }

    /**
     * @param int $limit
     * @param int $page
     * @param array $criteria
     * @param null $orderBy
     *
     * @param null $offset
     * @return array|Criteria
     */
    protected function prepareQueryCriteria($limit = 10, $page = 1, $criteria = [], $orderBy = null, $offset = null)
    {
        $orderBy = null !== $orderBy  ? $orderBy : $this->getDefaultOrderBy();

        if (is_array($criteria)) {
            $newCriteria = new Criteria();
            foreach ($criteria as $fieldName => $value) {
                if(!is_array($value)){
                    $newCriteria->andWhere(Criteria::expr()->eq($fieldName, $value));
                }
            }

            $criteria = $newCriteria;
        }

        if($offset === null){
            //$offset =  $this->getOffset($page, $limit);
        }
        //var_dump($offset);exit;

        if($orderBy === null){
            $orderBy = $this->getOrderBy($orderBy);
        }

        $criteria
            ->setMaxResults($limit)
            ->orderBy($orderBy)
            ->setFirstResult($offset);

        return $criteria;
    }

    /**
     * Get order by
     *
     * @param $orderBy
     * @return array|null
     */
    protected function getOrderBy($orderBy)
    {
        return $orderBy ? $orderBy : $this->getDefaultOrderBy();
    }

    /**
     * Get offset by page
     *
     * @param  int|null $page
     * @param  int      $limit
     * @return int
     */
    protected function getOffset($page, $limit)
    {
        if (!$page !== null) {
            $page = $page > 0
                ? ($page - 1) * $limit
                : 0;
        }

        return $page;
    }

    /**
     * Get default order by.
     *
     * @return array|null
     */
    protected function getDefaultOrderBy()
    {
        $ids = $this->metadata->getIdentifierFieldNames();
        $orderBy = $ids ? array() : null;
        foreach ($ids as $pk) {
            $orderBy[$pk] = 'ASC';
        }

        return $orderBy;
    }


    /**
     * @param QueryBuilder $queryBuilder
     *
     * @return null|Pagerfanta
     */
    public function getPaginator(QueryBuilder $queryBuilder)
    {
        try {
            return new Pagerfanta(new ArrayAdapter($queryBuilder->getQuery()->getResult()));
        } catch (\Exception $e) {
            var_dump($e->getMessage());exit;
            return null;
        }
    }
}