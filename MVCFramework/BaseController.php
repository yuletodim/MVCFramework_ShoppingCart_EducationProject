<?php
namespace MVCFramework;

class BaseController
{
    /**
     * @var \MVCFramework\App
     */
    protected $app;
    /**
     * @var \MVCFramework\View
     */
    protected $view;
    /**
     * @var \MVCFramework\Config
     */
    protected $config;
    /**
     * @var \MVCFramework\InputData
     */
    protected $input;

    public function __construct(){
        $this->app = \MVCFramework\App::getInstance();
        $this->view = \MVCFramework\View::getInstance();
        $this->config = $this->app->getConfig();
        $this->input = \MVCFramework\InputData::getInstance();
    }
}