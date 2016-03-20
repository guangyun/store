<?php

namespace Store\Frontend\Models;

class Lottery extends \Phalcon\Mvc\Model
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
     * @var string
     */
    public $kdate;

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
    public $next;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'lottery';
    }
    
    /**
     * 拿到最新三期数据
     */
    public function  getTre(){
        $data = $this->find(array('columns'=>'qishu,one,two,three,four,five,six,seven','order'=>"qishu desc",'limit'=>'3'));
        $this->dump($data);exit;
        return $data;
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Lottery[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Lottery
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}