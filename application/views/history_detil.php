<h2>History Order Detail</h2>
<div class="kotak2">
       <form class="form-horizontal" action="<?php echo base_url()?>/index.php/page/validate" method="post" name="frmCO" id="frmCO">
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
            <label class="control-label col-xs-3" for="firstName">No Order:</label>
            <div class="col-xs-9">
                <input type="text" class="form-control" name="departemen" id="departemen" placeholder="Departemen" value="<?php echo $id;?>" readonly>
            </div>
        </div>
         <div class="form-group  has-success has-feedback">
            <label class="control-label col-xs-3" for="firstName">Tanggal/Waktu:</label>
            <div class="col-xs-9">
                <input type="text" class="form-control" name="departemen" id="departemen" placeholder="Departemen" value="<?php echo $tanggal;?>/<?php echo $jam;?>" readonly>
            </div>
        </div>
         <div class="form-group  has-success has-feedback">
            <label class="control-label col-xs-3" for="firstName">Status:</label>
            <div class="col-xs-9">
                <input type="text" class="form-control" name="departemen" id="departemen" placeholder="Departemen" value="<?php echo $status;?>" readonly>
            </div>
        </div>

         
        <div class="form-group  has-success has-feedback">
            <div class="col-xs-offset-3 col-xs-9">
                
                <a href="<?php echo base_url();?>/page/history" class="btn btn-default">kembali</a>
            </div>
        </div>
      </form>
      <?php if($detil_order){?>
      <table class="table">
        <tr id= "main_heading">
        <td width="2%">No</td>
        <td >Nama Produk</td>
        <td width="10%">Qty</td>
        <td width="12%">Harga </td>
        <td width="10%">Posting</td>
        <td width="15%" align="right">Total Harga</td>
       
        </tr>
      
      <?php
// Create form and send all values in "shopping/update_cart" function.
        $this->load->model('keranjang_model');
        $no = 1;
        $grand_total=0;
        foreach ($detil_order as $i){
        $grand_total = $grand_total + $i['total_harga'];
        $no_order=$i['id'];?>
        <tr>
        <td><?php echo $no;?></td>
        <td><?php echo $i['nama_produk'];?></td>
        <td align="center"><?php echo $i['qty'];?></td>
        <td><?php echo $i['harga'];?></td>
        <td><?php echo $i['posting'];?></td>
        <td align="right"><?php echo $this->keranjang_model->rupiah($i['total_harga']);?></td>
       
         </tr>
        <?php $no++; }?>
        <tr id= "main_heading">
        <td colspan="5" align="right">Total Order</td>
        <td align="right"><b><?php echo $this->keranjang_model->rupiah($grand_total);?></b></td>
        </tr>
       </table>
        <?php } else{
            echo "Anda Belum memiliki Order";
            }?>
</div>