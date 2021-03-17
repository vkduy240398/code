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
                         <form class="user" method="post" enctype="multipart/form-data" action="<?php echo base_url('Home/updateAvatar').'/'.$values->id ?>">
                <div class="form-group row">
                    <div class="col-sm-6 form-group ">
                        <label for="">Ảnh đại diện</label>
                        <input type="file"name="avatar" value="<?php echo $this->encrypt->decode($values->avatar); ?>">
                    </div>
                    <div class="col-sm-6 form-group ">
                       <img src="<?= base_url('public/uploads/'.$values->id.'/').$this->encrypt->decode($values->avatar); ?>" width="300" alt="">
                    </div>
                    <div class="col-sm-12 form-group ">
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