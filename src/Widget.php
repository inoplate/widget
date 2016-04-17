<?php

namespace Inoplate\Widget;

use Illuminate\Contracts\Cache\Repository as Cache;

class Widget
{
    /**
     * @var array
     */
    protected $widgets;

    /**
     * @var Illuminate\Contracts\Config\Repository
     */
    protected $cache;

    /**
     * Create new widget instance
     * 
     * @param Illuminate\Contracts\Cache\Repository $cache
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Render widgets
     * 
     * @param  string $widget
     * @param  array  $data
     * @return array
     */
    public function render($widget, $data = [])
    {
        $raw = '';
        $handlers = $this->load($widget, $data) ?: [];

        foreach ($handlers as $key => $handler) {
            $content = view($handler['view'], $handler['options'])->render();

            if(!is_null($handler['cache'])) {
                $content = $this->cache->remember($handler['id'], $handler['cache'], $content);
            }

            $raw .= $content;
        }

        return $raw;
    }

    /**
     * Load widgets
     * @param  string $widget
     * @param  array  $data
     * @return array
     */
    public function load($widget, $data = [])
    {
        if(!$handlers = $this->getHandlers($widget))
            return;

        $handlers = $this->sortHandlers($this->extractHandlers($handlers, $data));

        return $handlers;
    }

    /**
     * Register widget
     * 
     * @param string $widget
     * @param string $handler
     */
    public function register($widget, $handler)
    {
        if($this->getHandlers($widget))
            $this->widgets[$widget][] = $handler;
        else
            $this->widgets[$widget] = [$handler];
    }

    /**
     * Retrieve widget handlers
     * 
     * @param  string $widget
     * @return array|null
     */
    protected function getHandlers($widget)
    {
        return isset($this->widgets[$widget]) ? $this->widgets[$widget] : null;
    }

    /**
     * Extracting widget handlers
     * 
     * @param string    $widget
     * @param array     $data
     * @return array
     */
    protected function extractHandlers($handlers, $data)
    {
        foreach ($handlers as $key => $handler) {
            $handlers[$key] = app()->make($handler, $data)->toArray();
        }

        return $handlers;
    }

    /**
     * Sort widget handlers
     * 
     * @param  array $handlers
     * @return array
     */
    protected function sortHandlers($handlers)
    {
        uasort($handlers, function($a, $b){
            return $a['order'] - $b['order'];
        });

        return $handlers;
    }
}
