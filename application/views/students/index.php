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
            <label for="" class="text text-primary">Tìm kiếm theo lớp</label>
            <select name="" id="class" class="form-control">
                    <option value="">Tất cả</option>
                    <?php foreach($data->result() as $value){?>
                        <option value="<?= $value->id ?>"><?= $value->Name ?></option>
                    <?php } ?>
            </select>
        </div>
        <div class="form-group col-3">
        <label for="" class="text text-warning">Tìm kiếm theo Email</label>
                <input type="text" name="search_email" id="search_email" placeholder="Nhập Email cần tìm" class="form-control">
        </div>
    </div>
        <div class="table-responsive">
            <?php
                if ($this->session->flashdata('action')) {
                    echo "Xóa thành công";
                }
                if ($this->session->flashdata('error')) {
                    echo "Xóa thất bại";
                }
            ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Họ Tên</th>
                        <th>Giới Tính</th>
                        <th>Ảnh đại diện</th>
                        <th>Địa chỉ</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Lớp</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody id="getdata">
                   
                        <?php
                        $i =1;
                            foreach($list->result() as $values){?>
                                     <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $this->encrypt->decode($values->Name);?></td>
                                    <td><?= $this->encrypt->decode($values->gender);?></td>
                                    <td>
                                    <a href="<?= base_url('home/updateImage/').$values->id ?>">Sửa Hình ảnh</a>
                                    <img src="<?= base_url('public/uploads/'.$values->id.'/').$this->encrypt->decode($values->avatar);?>" alt="" width="200">
                                    </td>
                                    <td><?= $this->encrypt->decode($values->Address);?></td>
                                    <td><?= $values->Email;?></td>
                                    <td><?= $this->encrypt->decode($values->Phone);?></td>
                                    <td>
                                        <select name="" id="update_st" onchange ="changeIDClass(this,<?=  $values->id?>)">
                                            <option value="<?= $values->id_cl?>"><?= $values->id_class ?></option>
                                            <?php
                                                foreach($data->result() as $key){?>
                                                     <option value="<?= $key->id?>"><?= $key->Name ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </td>
                                    <td><a href="<?= base_url('Home/delete').'/'.$values->id ?>" onclick="return confirm('Bạn có muốn xóa');" class="btn btn-danger">Delete</a></td>
                                    <td><a href="<?= base_url('Home/edit').'/'.$values->id ?>" class="btn btn-warning">Edit</a></td>
                                </tr>
                            <?php $i++; }
                        ?>

                </tbody>
            </table>
            <div class="row">
                   <div class="col-12">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination text-center" style="justify-content:center">
                        <?php
                            $num_student_one_page = 4;
                            $all_stu = $list->num_rows();
                            $num_page = ceil($all_stu/$num_student_one_page);
                            for ($i=1; $i <= $num_page ; $i++) { ?>
                                <li class="page-item"><a class="page-link" id="pagination" href="javascript:" onclick ="Pagination(<?= $i ?>)"><?= $i ?></a></li>
                            <?php }
                        ?>
                        </ul>
                        </nav>
                   </div>             
            </div>
        </div>
    </div>
</div>

</div>