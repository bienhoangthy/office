<?php
/**
 * name: tinhnguyenvan
 * email: tinhnguyenvan91@gmail.com
 * phone: 0909 977 920
 * @__construct => khoi tao doi tuong
 * @ index() => mac dinh
 */
class group extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->Model("cms/mcategory");
        $this->load->Model("cms/mpermission");
    }
    public function index()
    {
        $this->muser->checkPermission('group', 'index');
        $this->_data["title"]   = 'Danh sách group';
        $and                    = '';
        $this->_data['orderby'] = $orderby = 'group_order asc';
        $this->_data['list']    = $this->mgroup->getQuery($object = "", $join = "", $and, $orderby, $limit = "");

        /**begin xoa check chon*/
        if (isset($_POST['delAll'])) {
            $checkid = isset($_POST['checkid']) ? $_POST['checkid'] : '';
            if ($checkid) {
                foreach ($checkid as $key => $value) {
                    if (is_numeric($value)) {
                        $myGroup = $this->mgroup->getData("id", array("id" => $value));
                        if ($myGroup['id'] > 0) {
                            $this->mgroup->delete($value);
                        }
                    }
                }
                /**begin chuyen trang*/
                header("location:" . base64_decode($this->_data['redirect']));
                /**end chuyen trang*/
            } else {
                $this->_data['error'][] = 'Vui lòng kiểm tra check chọn';
            }
        }
        /**end xoa check chon*/
        $this->my_layout->view("cms/group/index", $this->_data);
    }
    public function add()
    {
        $this->muser->checkPermission('group', 'add');
        $this->_data['error']    = "";
        $this->_data['success']  = "";
        $this->_data['lang']     = my_lib::lang();
        $this->_data["title"]    = 'Add menu';
        $this->_data['formData'] = array(
            "id"             => "",
            "group_name"     => "",
            "group_note"     => "",
            "group_category" => "",
            "group_order"    => 0,
            "group_create"   => date("Y-m-d H:i:s"),
            "user"           => $this->_data['s_info']['s_user_id'],
        );

        if (isset($_POST['fsubmit'])) {
            $this->_data['formData'] = array(
                "group_name"     => $this->input->post('group_name'),
                "group_note"     => $this->input->post('group_note'),
                "group_order"    => $this->input->post('group_order'),
                "group_create"   => date("Y-m-d H:i:s"),
                "user"           => $this->_data['s_info']['s_user_id'],
            );
            if ($this->_data['formData']['group_name']) {
                $insert = $this->mgroup->add($this->_data['formData']);
                if (is_numeric($insert) > 0) {
                    /**begin add per cate*/
                    $permission = $this->input->post("permission");
                    $this->mpermission->deleteAnd(array("group_id" => $insert));
                    if ($permission) {
                        foreach ($permission as $key => $value) {
                            $this->_data['permission'] = array(
                                "gc_id"      => $value,
                                "group_id"   => $insert,
                                "per_create" => date("Y-m-d H:i:s"),
                                "user"       => $this->_data['s_info']['s_user_id'],
                            );
                            $this->mpermission->add($this->_data['permission']);
                        }
                    }
                    /**end add per cate*/

                    $this->_data['success'][] = "Add success";
                    $this->_data['formData']  = null;
                    /**begin chuyen trang*/
                    if (isset($_REQUEST['redirect']) && $_REQUEST['redirect']) {
                        header("location:" . base64_decode($_REQUEST['redirect']));
                    } else {
                        header("location:" . my_lib::cms_site() . "group/edit/" . $insert . "/?info=add");
                    }
                    /**end chuyen trang*/
                } else {
                    $this->_data['error'][] = "Add Not Success";
                }
            } else {
                $this->_data['error'][] = "Bạn chưa nhập tên";
            }
        }
        $this->_data['myPermission'] = $this->mgroupaction->loadGroupAction($this->_data['formData']['group_category'], $this->_data['formData']["id"]);
        $this->_data['myCategory']   = $this->mcategory->dropdownlist($this->_data['formData']['group_category']);
        $this->my_layout->view("cms/group/add", $this->_data);
    }

    public function edit($id)
    {
        $this->muser->checkPermission('group', 'edit');
        $myGroup = '';
        if (is_numeric($id)) {
            $myGroup = $this->mgroup->getData("", array("id" => $id));
            if ($myGroup['id'] <= 0) {
                header("location:" . my_lib::cms_site() . 'error/notfound');
                exit();
            }
        } else {
            header("location:" . my_lib::cms_site() . 'error/notfound');
            exit();
        }

        $this->_data['lang']    = my_lib::lang();
        $this->_data["title"]   = 'Update';
        $this->_data['error']   = "";
        $this->_data['success'] = "";
        $this->_data['info']    = "";
        if (isset($_REQUEST['info']) && $_REQUEST['info'] == "add") {
            $this->_data['info'][] = 'Edit success';
        }
        $this->_data["title"]    = 'Edit menu';
        $this->_data['formData'] = array(
            "id"             => $myGroup['id'],
            "group_name"     => $myGroup['group_name'],
            "group_note"     => $myGroup['group_note'],
            "group_order"    => $myGroup['group_order'],
            "group_create"   => date("Y-m-d H:i:s"),
            "user"           => $this->_data['s_info']['s_user_id'],
        );

        if (isset($_POST['fsubmit'])) {
            $this->_data['formData'] = array(
                "group_name"     => $this->input->post('group_name'),
                "group_note"     => $this->input->post('group_note'),
                "group_order"    => $this->input->post('group_order'),
                "user"           => $this->_data['s_info']['s_user_id'],
            );
            if ($this->_data['formData']['group_name']) {
                if ($this->mgroup->edit($id, $this->_data['formData'])) {
                    /**begin add per cate*/
                    $permission = $this->input->post("permission");
                    $this->mpermission->deleteAnd(array("group_id" => $id));
                    if ($permission) {
                        foreach ($permission as $key => $value) {
                            $this->_data['permission'] = array(
                                "gc_id"      => $value,
                                "group_id"   => $id,
                                "per_create" => date("Y-m-d H:i:s"),
                                "user"       => $this->_data['s_info']['s_user_id'],
                            );
                            $this->mpermission->add($this->_data['permission']);
                        }
                    }
                    /**end add per cate*/
                    $this->_data['success'][] = "Edit success";
                    $this->_data['formData']  = null;
                    /**begin chuyen trang*/
                    if (isset($_REQUEST['redirect']) && $_REQUEST['redirect']) {
                        header("location:" . base64_decode($_REQUEST['redirect']));
                    } else {
                        header("location:" . my_lib::cms_site() . "group/");
                    }
                    /**end chuyen trang*/
                } else {
                    $this->_data['error'][] = "Edit Not Success";
                }
            } else {
                $this->_data['error'][] = "Bạn chưa nhập tên";
            }
        }
        $this->_data['myPermission'] = $this->mgroupaction->loadGroupAction($this->_data['formData']['group_category'], $myGroup["id"]);
        $this->_data['myCategory']   = $this->mcategory->dropdownlist($this->_data['formData']['group_category']);
        $this->my_layout->view("cms/group/edit", $this->_data);
    }
    /**end them moi menu*/

    /**begin delete */
    public function delete($id)
    {
        $this->muser->checkPermission('group', 'delete');
        $myGroup              = '';
        $this->_data['title'] = "Delete";
        if (is_numeric($id)) {
            $myGroup = $this->mgroup->getData("id", array("id" => $id));
            if ($myGroup['id'] <= 0) {
                header("location:" . my_lib::cms_site() . 'error/notfound');
                exit();
            } else {
                $this->mgroup->delete($id);
                /**begin chuyen trang*/
                if (isset($_REQUEST['redirect']) && $_REQUEST['redirect']) {
                    header("location:" . base64_decode($_REQUEST['redirect']));
                } else {
                    header("location:" . my_lib::cms_site() . "group/");
                }
                /**end chuyen trang*/
            }
        } else {
            header("location:" . my_lib::cms_site() . 'error/notfound');
            exit();
        }
        $this->my_layout->view("cms/group/delete", $this->_data);
    }
    /**end delete */

    /*begin xu ly load permission group*/
    public function aj_loadPermission()
    {
        $arrcate = $this->input->post('arrcate');
        $groupID = $this->input->post('groupID');
        $data    = $this->mgroupaction->loadGroupAction($arrcate, $groupID);
        echo $data;
    }
    /*end xu ly load permission group*/
}
