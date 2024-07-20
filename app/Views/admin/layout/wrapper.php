<?= $this->include('admin/layout/header'); ?>
<?= $this->include('admin/layout/navigasi'); ?>
<?php
if (isset($isi)) {
    echo $this->include($isi);
}
?>
<?= $this->include('admin/layout/footer'); ?>