<?php
/**
 * Created by PhpStorm.
 * User: Кирилл
 * Date: 24.02.2018
 * Time: 21:01
 */
abstract class Base_Metabox
{
    abstract public function save($postID);
    abstract public function render($post);
    protected $id;
    protected $title;
    protected $screen;
    protected $context;
    protected $priority;
    protected $callback_args;
    function __construct($id, $title, $screen = null, $context = 'advanced', $priority = 'default', $callback_args = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->screen = $screen;
        $this->context = $context;
        $this->priority = $priority;
        $this->callback_args = $callback_args;
        add_action('add_meta_boxes', array(&$this, 'init'));
        add_action('save_post', array($this, 'save'));
    }
    function init()
    {
        add_meta_box($this->id, $this->title, array(&$this, 'render'), $this->screen, $this->context, $this->priority, $this->callback_args);
    }
}