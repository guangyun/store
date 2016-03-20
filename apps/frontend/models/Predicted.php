<?php

namespace Store\Frontend\Models;

class Predicted extends \Phalcon\Mvc\Model
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
    public $qishu;

    /**
     *
     * @var integer
     */
    public $one;

    /**
     *
     * @var integer
     */
    public $two;

    /**
     *
     * @var integer
     */
    public $three;

    /**
     *
     * @var integer
     */
    public $four;

    /**
     *
     * @var integer
     */
    public $five;

    /**
     *
     * @var integer
     */
    public $six;

    /**
     *
     * @var integer
     */
    public $seven;

    /**
     *
     * @var string
     */
    public $calc;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'predicted';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Predicted[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Predicted
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
