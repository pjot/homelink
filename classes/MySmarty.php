<?php
require dirname(__FILE__) . '/smarty/Smarty.class.php';
class MySmarty extends Smarty
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplateDir('Templates');
        $this->setCacheDir('Cache/Smarty/Cache');
        $this->setCompileDir('Cache/Smarty/Compiled');
        $this->assign('baseUrl', Homelink::getConfig('BASE_URL'));
    }
}
