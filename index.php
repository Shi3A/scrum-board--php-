<?php
    session_start();
    require_once('./includes/template.class.php');

    $template = new template();
    print $template->make_template();

?>