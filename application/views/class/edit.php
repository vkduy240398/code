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
            <?php
                foreach($list->result() as $value){?>
                    <form class="user" method="post" enctype="multipart/form-data" action="<?php echo base_url('ClassStudy/update/').$value->id ?>">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 ">
                                <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                    placeholder="Tên lớp" name="name" value="<?= $value->Name ?>">
                                    <label for="" class="text text-danger"><?= form_error('name'); ?></label>
                            </div>
                            <div class="col-sm-6 mb-3 ">
                                <select name="status" id="" class="form-control">
                                    <option value="">Chọn trạng thái</option>
                                <?php
                                        foreach($data->result() as $values){?>
                                            <?php
                                            $selected = '';
                                                if ($values->id ==  $value->id_status) {
                                                    $selected = "selected";     
                                                }    
                                            ?>
                                            <option <?= $selected;  ?> value="<?= $values->id; ?>"><?= $values->name; ?></option>
                                        <?php }
                                ?>
                                </select>
                                <label for="" class="text text-danger"><?= form_error('status'); ?></label>
                            </div>
                            <div class="col-sm-12 form-group ">
                                <input type="submit" class="btn btn-primary" id="exampleFirstName"
                                    name="update" value="Sửa">
                            </div>
                        </div>
                    </form>
                <?php }
            ?>
          
    </div>
</div>

</div>