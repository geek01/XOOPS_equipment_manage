<?php
/**
 * Created by PhpStorm.
 * User: jjes
 * Date: 2016/11/1
 * Time: 下午 02:29
 */
    include '../../../../mainfile.php';

    $post_data = array_map("htmlspecialchars" ,array_map("addslashes", $_POST));

    if(strlen( $post_data["name"]) &&
        strlen($post_data["amount"]) &&
        intval($post_data["amount"]) > 0) {

        $post_data_name = $post_data["name"];
        $post_data_amount = intval($post_data["amount"]);
        $owner = $xoopsUser->uname();

        $sql = sprintf("INSERT INTO %s(`name`, `owner`, `amount`) VALUES('{$post_data_name}', '{$owner}', {$post_data_amount});"
            , $xoopsDB->prefix('equipment_desc'));

        $check_sql = sprintf("SELECT owner, name FROM %s WHERE owner='{$owner}' AND name='{$post_data_name}';",
            $xoopsDB->prefix('equipment_desc'));

        $check_result = $xoopsDB->query($check_sql);

        if($xoopsDB->getRowsNum($check_result) == 0) {

            $xoopsDB->queryF($sql);
        }
    }


    echo "<script>window.location.href='../manage.php';</script>";

