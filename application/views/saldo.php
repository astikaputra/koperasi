<h2>Chek Saldo</h2>
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
            <label class="control-label col-xs-3" for="firstName">Saldo</label>
            <div class="col-xs-9">
                <input type="text" class="form-control" name="saldo" id="saldo" placeholder="Saldo" value="<?php echo $saldo;?>" readonly>
            </div>
        </div>
        <div class="form-group  has-success has-feedback">
            <div class="col-xs-offset-3 col-xs-9">
                
                <a href="<?php echo base_url();?>" class="btn btn-default">kembali</a>
            </div>
        </div>
      </form>
</div>