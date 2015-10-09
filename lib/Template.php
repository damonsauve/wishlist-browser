<?php

class Template
{
    private $template;
    private $vars;
    private $pagination;
    private $smarty;

    function __construct($template, $template_vars, $pagination)
    {
        $this->template     = $template;
        $this->vars         = $template_vars;
        $this->pagination   = $pagination;

        $this->smarty = new Smarty;

        $tpldir = dirname(__FILE__) . '/../smarty/';

        $this->smarty->setTemplateDir(  $tpldir . '/templates');
        $this->smarty->setCompileDir(   $tpldir . '/templates_c');
        $this->smarty->setCacheDir(     $tpldir . '/cache');
        $this->smarty->setConfigDir(    $tpldir . '/configs');

        //$this->smarty->debugging = true;

        //$this->smarty->setCaching(true);
        //$this->smarty->caching = 1;
        //$this->smarty->compile_check = true;

        //$this->smarty->testInstall();
    }

    private function assignVars()
    {
        $product_info = array();

        foreach ($this->vars['items'] as $var)
        {
            $product_info[] = $var;
        }

        // expected to be an array
        //
        $this->smarty->assign(
            'products',
            $product_info
        );

        foreach ($this->vars['meta'] as $k => $v)
        {
            $this->smarty->assign(
                $k,
                $v
            );
        }

        if(!empty($this->pagination))
        {
            foreach ($this->pagination as $k => $v)
            {
                $this->smarty->assign(
                    $k,
                    $v
                );
            }
        }
    }

    public function fetch()
    {
        $this->assignVars();

        return $this->smarty->fetch($this->template);
    }

    private function dump($value, $label)
    {
        if(!isset($label))
        {
            $label = '';
        }
        else
        {
            $label = '<b>'. $label . ' = </b>';
        }
        print '<pre>';
        print $label;
        print_r($value);
        print '</pre>';
    }
}
