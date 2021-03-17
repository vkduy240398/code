<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank"
        href="https://datatables.net">official DataTables documentation</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
  
  <div class="row">
    <div class="col-4 text-center">
    <?php
        if ($this->session->flashdata('Error')) {?>
            <label for="" class="text text-danger"><?= $this->session->flashdata('Error') ?></label>
        <?php }
     ?>
       <?php
        if ($this->session->flashdata('success')) {?>
            <label for="" class="text text-success"><?= $this->session->flashdata('success') ?></label>
        <?php }
     ?>
    </div>
  </div>
    <div class="card-body">
            <form class="user" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/insert') ?>">
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 ">
                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                            placeholder="Username" name="username" value=<?= set_value('username') ?>>
                            <label for="" class="text text-danger"><?= form_error('username'); ?></label>
                    </div>
                    <div class="col-sm-6 mb-3 ">
                        <input type="password" class="form-control form-control-user" id="exampleFirstName"
                            placeholder="PassWord" name="password" value=<?= set_value('password') ?>>
                            <label for="" class="text text-danger"><?= form_error('password'); ?></label>
                    </div>
                    <div class="col-sm-12 form-group ">
                        <input type="submit" class="btn btn-primary" id="exampleFirstName"
                            name="insert" value="Thêm">
                    </div>
                </div>

            </form>
    </div>
</div>

</div>