<h2>Halaman Login</h2>
<div class="kotak2">
 <?php echo $this->session->flashdata('berhasil') ?>
       <form class="form-horizontal" action="<?php echo base_url()?>page/validate" method="post" name="frmCO" id="frmCO">
        <div class="form-group  has-success has-feedback">
            <label class="control-label col-xs-3" for="inputEmail">NIK:</label>
            <div class="col-xs-9">
                <input type="tetx" class="form-control" name="nik" id="email" placeholder="Input Nomor Induk Karyawan">
            </div>
        </div>
        <div class="form-group  has-success has-feedback">
            <label class="control-label col-xs-3" for="firstName">Password :</label>
            <div class="col-xs-9">
                <input type="password" class="form-control" name="password" id="nama" placeholder="Input Password">
            </div>
        </div>
        
        <div class="form-group  has-success has-feedback">
            <div class="col-xs-offset-3 col-xs-9">
                <button type="submit" class="btn btn-primary">Login</button>
                <button type="Reset" class="btn btn-default">Cancel</button>
            </div>
        </div>
      </form>
</div>