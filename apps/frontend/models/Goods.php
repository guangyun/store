<?php

namespace Store\Frontend\Models;

class Goods extends \Phalcon\Mvc\Model
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
    public $title;

    /**
     *
     * @var string
     */
    public $subhead;

    /**
     *
     * @var double
     */
    public $price;

    /**
     *
     * @var double
     */
    public $discount;

    /**
     *
     * @var integer
     */
    public $aid;

    /**
     *
     * @var integer
     */
    public $vid;

    /**
     *
     * @var integer
     */
    public $status;

    /**
     *
     * @var integer
     */
    public $auth;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'goods';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Goods[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Goods
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
