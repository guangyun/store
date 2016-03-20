<?php

namespace Store\Frontend\Models;

class Types extends \Phalcon\Mvc\Model
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
    public $type;

    /**
     *
     * @var string
     */
    public $alias;

    /**
     *
     * @var integer
     */
    public $cid;

    /**
     *
     * @var integer
     */
    public $bid;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'types';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Types[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Types
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
