<?php
class error extends MY_Controller
{

    public function __construct()
    {

        parent::__construct();

    }
    public function permission()
    {
        $this->_data["title"] = 'Permission';
        $this->my_layout->view("cms/error/permission", $this->_data);
    }
    public function notfound()
    {
        $this->_data["title"] = 'Error';
        $this->my_layout->view("cms/error/notfound", $this->_data);
    }
}
