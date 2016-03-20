<?php

namespace Store\Frontend\Models;

class GoodsComment extends \Phalcon\Mvc\Model
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
    public $gid;

    /**
     *
     * @var double
     */
    public $grade;

    /**
     *
     * @var integer
     */
    public $assess;

    /**
     *
     * @var string
     */
    public $comment;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'goods_comment';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsComment[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsComment
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
