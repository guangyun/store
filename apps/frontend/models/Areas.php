<?php

namespace Store\Frontend\Models;

class Areas extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $area_no;

    /**
     *
     * @var string
     */
    public $area_name;

    /**
     *
     * @var integer
     */
    public $parent_no;

    /**
     *
     * @var string
     */
    public $area_code;

    /**
     *
     * @var integer
     */
    public $area_level;

    /**
     *
     * @var string
     */
    public $type_name;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'areas';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Areas[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Areas
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
