<?php

namespace Store\Frontend\Models;

class Roles extends \Phalcon\Mvc\Model
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
    public $role;

    /**
     *
     * @var string
     */
    public $alias;

    /**
     *
     * @var string
     */
    public $Privilege;
    
    public function initialize(){
        $this->hasMany('id', 'Store\Frontend\Models\Admins', 'gid');
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'roles';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Roles[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Roles
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
