<?php
/**
 *
 */
class mcategory extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    protected $table = 'tkwp_category';

    /**begin danh sach menu top*/
    public function getCategory()
    {
        $data    = null;
        $orderby = 'category_orderby asc';
        $object  = "id,category_name,category_parent,category_component,category_action,category_icon";
        $list    = $this->getQuery($object, "category_status = 1 and category_parent = 0", $orderby, "");
        if (isset($list) && $list) {
            foreach ($list as $key => $value) {
                if ($value["category_name"]) {
                    $data[] = array(
                        "id"                 => $value["id"],
                        "category_name"      => $value["category_name"],
                        "category_parent"    => $value["category_parent"],
                        "category_component" => $value["category_component"],
                        "category_icon"      => $value["category_icon"],
                        "category_action"    => $value["category_action"],
                    );
                    /**begin menu cap 2*/
                    $list_c2 = $this->getQuery($object, "category_status = 1 and category_parent = " . $value['id'], $orderby, "");
                    if (isset($list_c2) && $list_c2) {
                        foreach ($list_c2 as $key_c2 => $value_c2) {
                            if ($value_c2["category_name"]) {
                                $data[$key][$value["category_parent"]][] = array(
                                    "id"                 => $value_c2["id"],
                                    "category_name"      => $value_c2["category_name"],
                                    "category_parent"    => $value_c2["category_parent"],
                                    "category_component" => $value_c2["category_component"],
                                    "category_icon"      => $value_c2["category_icon"],
                                    "category_action"    => $value_c2["category_action"],
                                );
                            }
                        }
                    }
                    /**end menu cap 2*/
                }
            }
        }
        return $data;
    }
    /**end danh sach menu top*/
    /**begin drop down parent*/
    public function dropdownlist($active = '', $parent = "")
    {
        $html      = '';
        $tmpParent = $parent != "" ? $parent : 0;
        $orderby   = 'category_orderby asc';
        $data      = $this->getQuery("id,category_name", "category_parent = " . $tmpParent, $orderby, "");
        if ($data) {
            $html .= '<option value="0">-- Danh mục --</option>';
            foreach ($data as $key => $value) {
                $selected = '';
                if (is_array($active)) {
                    if (in_array($value['id'], $active)) {
                        $selected = 'selected';
                    }
                } elseif ($active == $value['id']) {
                    $selected = 'selected';
                }
                $html .= '<option ' . $selected . ' value="' . $value["id"] . '">' . $value["category_name"] . '</option>';
                /**begin cap 2*/
                $data2 = $this->getQuery("id,category_name", "category_parent = " . $value['id'], $orderby, "");
                if ($data2) {
                    foreach ($data2 as $key2 => $value2) {
                        $selected = '';
                        if (is_array($active)) {
                            if (in_array($value2['id'], $active)) {
                                $selected = 'selected';
                            }
                        } elseif ($active == $value2['id']) {
                            $selected = 'selected';
                        }
                        $html .= '<option ' . $selected . ' value="' . $value2["id"] . '">-- ' . $value2["category_name"] . '</option>';
                    }
                }
                /**end cap 2*/
            }
        } else {
            $html .= '<option value="0">Data empty</option>';
        }
        return $html;
    }
    /**end drop down parent*/

    public function showNameUnserialize($string)
    {
        $html = '';
        if ($string) {
            $string = unserialize($string);
            if ($string) {
                foreach ($string as $key => $value) {
                    $myCategory = $this->getData(array("category_name", "category_icon"), array("id" => $value));
                    $html .= '<small class="label label-default" style="margin:3px;"><i class="' . $myCategory["category_icon"] . '"></i> ' . $myCategory["category_name"] . '</small>';
                }
            }
        }
        return $html;
    }
}
