<?php
include('config/apply.php');
if ($_POST['action'] == 'fetch') {
    if ($_POST['page'] == 'department') {
        $output = array();
        $tbl_name = "tbl_department";
        $where = "";
        if (isset($_POST['search']['value'])) {
            $where .= "(";
            $where .= 'department_name LIKE "%' . $_POST["search"]["value"] . '%" ';
            $where .= 'OR dept_id LIKE "%' . $_POST["search"]["value"] . '%" ';
            $where .= ")";
        }
        if (isset($_POST['order'])) {
            $where .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $where .= 'ORDER BY dept_id ASC ';
        }

        $other = '';

        if ($_POST['length'] != -1) {
            $other .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        $query = $obj->select_data($tbl_name, $where);
        $res = $obj->execute_query($conn, $query);
        $filtered_rows = $obj->num_rows($res);
        $data = array();
        while ($row = $obj->fetch_data($res)) {
            $sub_array = array();
            $sub_array[] .= $row['dept_id'];
            $sub_array[] .= $row['department_name'];
            $edit_button = '<a class="edit-data" id="' . $row['dept_id'] . '"><i class="fa fa-pencil fa-lg text-blue"></i></a>';
            $delete_button = '<a id="delete_department" data-id="' . $row['dept_id'] . '" ><i class="fa fa-trash fa-lg"></i></a>';
            $sub_array[] .= $edit_button;
            $sub_array[] .= $delete_button;
            $data[] = $sub_array;
        }
        $where = "";
        $query = $obj->select_data($tbl_name, $where);
        $res = $obj->execute_query($conn, $query);
        $total_rows = $obj->num_rows($res);
        $output = array(
            "draw"                =>    intval($_POST["draw"]),
            "recordsTotal"        =>    $total_rows,
            "recordsFiltered"    =>    $filtered_rows,
            "data"                =>    $data
        );
        echo json_encode($output);
    }
    if ($_POST['page'] == 'head') {
        $output = array();
        $tbl_name = "tbl_department_head join tbl_department on tbl_department_head.department_id=tbl_department.dept_id";
        $where = "";
        if (isset($_POST['search']['value'])) {
            $where .= "(";
            $where .= 'first_name LIKE "%' . $_POST["search"]["value"] . '%" ';
            $where .= 'OR last_name LIKE "%' . $_POST["search"]["value"] . '%" ';
            $where .= 'OR email LIKE "%' . $_POST["search"]["value"] . '%" ';
            $where .= 'OR username LIKE "%' . $_POST["search"]["value"] . '%" ';
            $where .= 'OR id LIKE "%' . $_POST["search"]["value"] . '%" ';
            $where .= ")";
        }
        if (isset($_POST['order'])) {
            $where .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $where .= 'ORDER BY id ASC ';
        }

        $other = '';

        if ($_POST['length'] != -1) {
            $other .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        $query = $obj->select_data($tbl_name, $where);
        $res = $obj->execute_query($conn, $query);
        $filtered_rows = $obj->num_rows($res);
        $data = array();
        while ($row = $obj->fetch_data($res)) {
            $sub_array = array();
            $sub_array[] .= $row['id'];
            $sub_array[] .= $row['first_name'];
            $sub_array[] .= $row['last_name'];
            $sub_array[] .= $row['email'];
            $sub_array[] .= $row['username'];
            $sub_array[] .= $row['department_name'];
            $edit_button = '<a class="edit-data" id="' . $row['id'] . '"><i class="fa fa-pencil fa-lg text-blue"></i></a>';
            $delete_button = '<a id="delete_head" data-id="' . $row['id'] . '" ><i class="fa fa-trash fa-lg"></i></a>';
            $sub_array[] .= $edit_button;
            $sub_array[] .= $delete_button;
            $data[] = $sub_array;
        }
        $where = "";
        $query = $obj->select_data($tbl_name, $where);
        $res = $obj->execute_query($conn, $query);
        $total_rows = $obj->num_rows($res);
        $output = array(
            "draw"                =>    intval($_POST["draw"]),
            "recordsTotal"        =>    $total_rows,
            "recordsFiltered"    =>    $filtered_rows,
            "data"                =>    $data
        );
        echo json_encode($output);
    }
}
