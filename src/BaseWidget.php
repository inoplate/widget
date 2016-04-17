<?php

namespace Inoplate\Widget;

abstract class BaseWidget
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var integer
     */
    protected $order;

    /**
     * @var double
     */
    protected $cache;

    /**
     * @var string
     */
    protected $view;

    /**
     * Retrieve widget's view
     * 
     * @return string
     */
    public function view()
    {
        return $this->view;
    }

    /**
     * Retrieve widget id
     * 
     * @return string
     */
    public function id()
    {
        if(is_null($this->id)) {
            $this->id = strtolower(str_replace('\\', '.', static::class));
        }

        return $this->id;
    }

    /**
     * Retrieve widget order
     * 
     * @return int
     */
    public function order()
    {
        return $this->order;
    }

    /**
     * retrieve widget options
     * 
     * @return array
     */
    public function options()
    {
        return $this->options;
    }

    /**
     * Retrieve cache
     * 
     * @return double
     */
    public function cache()
    {
        return $this->cache;
    }

    /**
     * Convert object to array
     * 
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->id(),
            'order' => $this->order(),
            'cache' => $this->cache(),
            'view' => $this->view(),
            'options' => $this->options()
        ];
    }
}