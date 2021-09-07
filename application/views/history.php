<h2>History Order</h2>
<div class="kotak2">
       <form class="form-horizontal" action="<?php echo base_url()?>index.php/page/validate" method="post" name="frmCO" id="frmCO">
        <div class="form-group  has-success has-feedback">
            <label class="control-label col-xs-3" for="inputEmail">NIK:</label>
            <div class="col-xs-9">
                <input type="tetx" class="form-control" name="nik" id="nik" placeholder="Input Nomor Induk Karyawan" value="<?php echo $nik;?>" readonly>
            </div>
        </div>
        <div class="form-group  has-success has-feedback">
            <label class="control-label col-xs-3" for="firstName">Nama:</label>
            <div class="col-xs-9">
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Karyawan" value="<?php echo $nama;?>" readonly>
            </div>
        </div>
        
         <div class="form-group  has-success has-feedback">
            <label class="control-label col-xs-3" for="firstName">Departermen:</label>
            <div class="col-xs-9">
                <input type="text" class="form-control" name="departemen" id="departemen" placeholder="Departemen" value="<?php echo $departemen;?>" readonly>
            </div>
        </div>

         
        <div class="form-group  has-success has-feedback">
            <div class="col-xs-offset-3 col-xs-9">
                
                <a href="<?php echo base_url();?>" class="btn btn-default">kembali</a>
            </div>
        </div>
      </form>
      <?php if($order){?>
      <table class="table">
        <tr id= "main_heading">
        <td width="2%">No</td>
        <td width="20%" align="center">Nomor Order</td>
        <td width="17%">Tanggal</td>
        <td width="8%">Waktu</td>
        <td width="20%">Status</td>
        <td width="20%">Total Order</td>
        <td width="20%" align="right">Aksi</td>
        </tr>
      
      <?php
// Create form and send all values in "shopping/update_cart" function.
        $this->load->model('keranjang_model');
        $no = 1;
        foreach ($order as $i){
        //$grand_total = $grand_total + $item['subtotal'];
        $no_order=$i['id'];?>
        <tr>
        <td><?php echo $no;?></td>
        <td align="center"><?php echo $i['id'];?></td>
        <td><?php echo $i['tanggal'];?></td>
        <td><?php echo $i['jam'];?></td>
        <td><?php echo $i['status'];?></td>
        <td><?php echo $this->keranjang_model->rupiah($i['total_order']);?></td>
        <td><a href="<?php echo site_url('page/detil_order/'.$i['id'])?>"  class ='btn btn-sm btn-primary'>Detil Order</a></td>
        </tr>
        <?php $no++; }?>

       </table>
        <?php } else{
            echo "Anda Belum memiliki Order";
            }?>
</div>