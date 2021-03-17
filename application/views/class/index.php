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
    <div class="card-body">
    <div class="row">
        <div class="form-group col-3">
         
        </div>
        
    </div>
        <div class="table-responsive">
            <div class="row">
                <div class="col-4">
                <?php
                if ($this->session->flashdata('success')) {?>
                        <p class="text text-success">
                            <?php echo $this->session->flashdata('success');  ?>
                        </p>
                    <?php }
                ?>
                  <?php
                if ($this->session->flashdata('Error')) {?>
                        <p class="text text-danger">
                            <?php echo $this->session->flashdata('Error');  ?>
                        </p>
                    <?php }
                ?>
                </div>
            </div>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Họ Tên</th>
                        <th>Trạng thái</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody >
                <?php 
                  $i =1;
                    foreach($list->result() as $values){?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $values->Name; ?></td>
                            <td>
                                <?php
                                 $check = '';
                                    if ($values->id_status == 2) {  $check = 'checked'; ?>
                                   <?php   } 
                                ?>
                                 <input <?= $check; ?> type="checkbox" name="check_status" data-id ="<?= $values->id ?>" id="check_stt" value="<?= $values->id_status ?>">
                            </td>
                            <td><a href="<?= base_url('ClassStudy/delete/').$values->id ?>" onclick="return confirm('bạn chắc muốn xóa')" class="btn btn-danger">Delete</a></td>
                            <td><a href="<?= base_url('ClassStudy/edit/').$values->id ?>" class="btn btn-warning">Edit</a></td>
                        </tr>
                    <?php }
                ?>
                    
                </tbody>
            </table>
          
        </div>
    </div>
</div>

</div>