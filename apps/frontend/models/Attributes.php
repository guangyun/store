<?php

namespace Store\Frontend\Models;

class Attributes extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $attribute;

    /**
     *
     * @var string
     */
    public $alias;

    /**
     *
     * @var integer
     */
    public $tid;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'attributes';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Attributes[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Attributes
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
