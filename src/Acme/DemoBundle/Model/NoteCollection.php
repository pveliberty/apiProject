<?php

namespace Acme\DemoBundle\Model;

use Acme\DemoBundle\Entity\Address;

class NoteCollection
{
    /**
     * @var Address[]
     */
    public $notes;

    /**
     * @var integer
     */
    public $offset;

    /**
     * @var integer
     */
    public $limit;

    /**
     * @param Note[]  $notes
     * @param integer $offset
     * @param integer $limit
     */
    public function __construct($notes, $offset = null, $limit = null)
    {
        $this->notes = $notes;
        $this->offset = $offset;
        $this->limit = $limit;
    }
}
