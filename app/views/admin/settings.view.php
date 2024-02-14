<!--header-->
<?php $this->view('admin/admin.header', $data)?>

<h1><?=Auth::getRole()?> - settings</h1>

<!--footer-->
<?php $this->view('admin/admin.footer', $data)?>
