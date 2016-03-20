<?php

namespace Store\Frontend\Models;

class GoodsImg extends \Phalcon\Mvc\Model
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
     * @var integer
     */
    public $vid;

    /**
     *
     * @var string
     */
    public $path;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'goods_img';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsImg[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsImg
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
