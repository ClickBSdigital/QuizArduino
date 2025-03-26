<?php
include 'includes/functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    deleteUser($id);
    header('Location: index.php');
    exit();
}
?>
