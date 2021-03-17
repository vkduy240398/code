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
    <?php
        if ($this->session->flashdata('error')) {
            echo "Sửa thất bại";
        }
        if ($this->session->flashdata('action')) {
            echo "Sửa thành công";
        }
  
    ?>
    <?php
              if (validation_errors() !='') {
                         echo '<div class="alert_danger text-danger">
                         <label for="">'.validation_errors().'</label>
                     </div>';
            }
    ?>
    <div class="card-body">
        <?php
            foreach($edit->result() as $values){?>
                         <form class="user" method="post" enctype="multipart/form-data" action="<?php echo base_url('Home/update').'/'.$values->id ?>">
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 ">
                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                            placeholder="Họ Tên" name="name" value="<?php echo $this->encrypt->decode($values->Name); ?>">
                    </div>
                    <div class="col-sm-6 form-group " >
                        Nam: <input type="radio" <?php if ($this->encrypt->decode($values->gender) === "Nam") {?>
                                checked
                        <?php  }
                        ?> name="gender" value="Nam">
                        Nữ: <input type="radio"  name="gender"  <?php if ($this->encrypt->decode($values->gender) === "Nữ") {?>
                                checked
                        <?php  }
                        ?> value="Nữ">
                    </div>
               
                    <div class="col-sm-6 mb-3  form-group ">
                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                            placeholder="Địa chỉ" name="address" value="<?php echo $this->encrypt->decode($values->Address); ?>">
                    </div>
                    <div class="col-sm-6 mb-3 form-group ">
                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                            placeholder="Email" name="Email" value="<?php echo $this->encrypt->decode($values->Email); ?>">
                    </div>
                    <div class="col-sm-6 mb-3 form-group ">
                        <input type="number" class="form-control form-control-user" id="exampleFirstName"
                            placeholder="Số Điện Thoại" name="phone" value="<?php echo $this->encrypt->decode($values->Phone); ?>">
                    </div>
                    <div class="col-sm-6 mb-3 form-group ">
                        <label for="">Lớp</label>
                        <select name="class" class="form-control"  id="">
                            <?php
                                foreach($data->result() as $key){?>
                                <?php
                                    $selected = '';
                                    if ($key->id === $values->id_class) {
                                        $selected = 'selected';
                                    }
                                ?>
                                      <option <?=  $selected; ?> value="<?php echo $key->id ?>"><?php echo $key->Name ?></option>
                                <?php }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-12 form-group ">
                    <input type="hidden" value="<?= $values->id ?>" class="form-control form-control-user" id="exampleFirstName" name="hidden_id">
                        <input type="submit" class="form-control  btn btn-success" id="exampleFirstName"
                            name="update" value="Sửa">
                    </div>
                </div>
            </form>
            <?php }
        ?>
           
    </div>
</div>

</div>