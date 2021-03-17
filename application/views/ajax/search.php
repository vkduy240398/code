		
        <?php
        $i = 1;
            foreach($data->result() as $values){?>

                <tr>
                <td><?= $i++ ?></td>
                <td><?= $this->encrypt->decode($values->Name)?></td>
                <td><?= $this->encrypt->decode($values->gender) ?></td>
                <td>
                <a href="<?=  base_url('home/updateImage/').$values->id ?>">Sửa Hình ảnh</a>
                <img src="<?= base_url('public/uploads/'.$values->id.'/').$this->encrypt->decode($values->avatar) ?>" alt="" width="200">
                </td>
                <td><?= $this->encrypt->decode($values->Address) ?></td>
                <td><?= $values->Email ?></td>
                <td><?= $this->encrypt->decode($values->Phone) ?></td>
                <td>
                <select name="" id="update_st" onchange ="changeIDClass(this,<?=  $values->id?>)">
                       
                       <?php
                      foreach($class_id->result() as $key){?>
                              <?php
                              $selected = '';
                                  if ($key->id === $values->id_class) {
                                      $selected = 'selected';
                                  }
                              ?>
                              <option <?= $selected ?> value="<?= $key->id?>"><?= $key->Name ?></option>
                      <?php }
                  ?>
                  </select>
                </td>
                <td><a href="<?=  base_url('Home/delete').'/'.$values->id ?>" onclick="return confirm('You want delete');" class="btn btn-danger">Delete</a></td>
                <td><a href="<?= base_url('Home/edit').'/'.$values->id ?>" class="btn btn-warning">Edit</a></td>
        </tr>
            <?php }
            ?>
				