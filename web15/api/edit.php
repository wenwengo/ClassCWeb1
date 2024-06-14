<?php
include_once "base.php";
$do = $_POST['table'];
$db = ${ucfirst($do)};

foreach ($_POST['id'] as $key => $id) {
    if (!empty($_POST['del']) && in_array($id, $_POST['del'])) {
        $db->del($id);
    } else {
        $row = $db->find($id);
        if (isset($_POST['text'])) {
            $row['text'] = $_POST['text'][$key];
        }
        if ($do == 'title') {
            $row['sh'] = (isset($_POST['sh']) && $_POST['sh'] == $id) ? 1 : 0;
        } else {
            $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;
        }

        $db->save($row);
    }
}


to("../admin.php?do=ad");
