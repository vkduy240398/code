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
        <div class="col-4">
            <p class="text text-success">
                <?php
                    if ($this->session->flashdata('action')) {
                        echo $this->session->flashdata('action');
                    }
                ?>
            </p>
            <p class="text text-danger">
                <?php
                         if ($this->session->flashdata('error')) {
                            echo $this->session->flashdata('error');
                        }
                        if ($this->session->flashdata('errorImage')) {
                            echo $this->session->flashdata('errorImage');
                        }
                    ?>
            </p>
        </div>
    </div>
 
    <div class="card-body">
            <form class="user" method="post" enctype="multipart/form-data" action="<?php echo base_url('Home/insert') ?>">
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 ">
                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                            placeholder="Họ Tên" name="name" value="<?= set_value('name') ?>">
                            <label for="" class="text-danger"><?= form_error('name'); ?></label>
                        </div>
                    <div class="col-sm-6 form-group " >
                      <input type="radio"  name="gender" checked value="Nam" >&nbsp;Nam:
                        <input type="radio"  name="gender" value="Nữ">&nbsp;Nữ: 
                        <label for="" class="text-danger"><?= form_error('gender'); ?></label>
                    </div>
                    <div class="col-sm-6 form-group ">
                        <label for="">Ảnh đại diện</label>
                        <input type="file"name="avatar" id="avatar" onchange = "CheckImage()">
                        <label for="" class="text-danger" id="check_types"><?= form_error('avatar'); ?></label>
                    </div>
                    <div class="col-sm-6 mb-3  form-group ">
                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                            placeholder="Địa chỉ" name="address" value="<?= set_value('address') ?>">
                            <label for="" class="text-danger"><?= form_error('address'); ?></label>
                    </div>
                    <div class="col-sm-6 mb-3 form-group ">
                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                            placeholder="Email" name="Email" value="<?= set_value('Email') ?>">
                            <label for="" class="text-danger"><?= form_error('Email'); ?></label>
                    </div>
                    <div class="col-sm-6 mb-3 form-group ">
                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                            placeholder="Số Điện Thoại" name="phone" value="<?= set_value('phone') ?>">
                            <label for="" class="text-danger"><?= form_error('phone'); ?></label>
                    </div>
                    <div class="col-sm-6 mb-3 form-group ">
                        <label for="">Lớp</label>
                        <select name="class" class="form-control"  id="">
                           <option value="">Chọn lớp</option>
                                <?php
                                foreach($data->result() as $values){?>
                                    <?php
                                    $selectd = "";
                                        if ($values->id === set_value('class')) {
                                          $selectd = "selected";
                                        }
                                    ?>
                                      <option <?= $selectd ?> value="<?php echo $values->id ?>"><?php echo $values->Name ?></option>
                                <?php }
                            ?>
                        </select>
                        <label for="" class="text-danger"><?= form_error('class'); ?></label>
                    </div>
                    <div class="col-sm-12 form-group ">
                        <input type="submit" class="form-control  btn btn-primary" id="exampleFirstName"
                            name="insert" value="Thêm">
                    </div>
                </div>
            </form>
    </div>
</div>

</div>