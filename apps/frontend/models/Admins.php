<?php

namespace Store\Frontend\Models;

class Admins extends \Phalcon\Mvc\Model
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
    public $nick;

    /**
     *
     * @var string
     */
    public $passwd;

    /**
     *
     * @var integer
     */
    public $reg_time;

    /**
     *
     * @var integer
     */
    public $login_time;

    /**
     *
     * @var string
     */
    public $login_ip;

    /**
     *
     * @var integer
     */
    public $counts;

    /**
     *
     * @var integer
     */
    public $gid;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'admins';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Admins[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Admins
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}