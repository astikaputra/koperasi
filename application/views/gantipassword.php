<h2>Ganti Password</h2>
<div class="kotak2">
 <?php echo $this->session->flashdata('berhasil') ?>
       <form class="form-horizontal" action="<?php echo base_url()?>index.php/page/do_password" method="post" name="frmCO" id="frmCO">
        <div class="form-group  has-success has-feedback">
            <label class="control-label col-xs-3" for="inputEmail">Password Lama :</label>
            <div class="col-xs-9">
                <input type="password" class="form-control" name="password2" id="email" placeholder="Input Password lama">
            </div>
        </div>
        <div class="form-group  has-success has-feedback">
            <label class="control-label col-xs-3" for="inputEmail">Password Baru :</label>
            <div class="col-xs-9">
                <input type="password" class="form-control" name="password1" id="email" placeholder="Input Password baru">
            </div>
        </div>
        <div class="form-group  has-success has-feedback">
            <label class="control-label col-xs-3" for="firstName">Ulangi Password Baru :</label>
            <div class="col-xs-9">
                <input type="password" class="form-control" name="password" id="nama" placeholder="Ulangi Input Password baru">
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