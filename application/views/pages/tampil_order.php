<h2>Berikut data order online yang sudah bisa di ambil</h2>


<form action="<?php echo base_url()?>index.php/shopping/save_order" method="post" name="frmShopping" id="frmShopping" class="form-horizontal" enctype="multipart/form-data">
<?php
	if ($order)
		{
 ?>
<br>
<br>
<table class="table">
<tr id= "main_heading">
 <th>No</th>
                                            <th>Nama</th>
                                            <th>Tgl Order</th>
                                            <th>Waktu Order</th>
                                            
                                            <th>status</th>

</tr>
<?php
// Create form and send all values in "shopping/update_cart" function.
$grand_total = 0;
$no = 1;
$this->load->model('keranjang_model');
foreach ($order as $r):
//$grand_total = $grand_total + $item['subtotal'];
?>
<tr>
<td><?php echo $no;?></td>
                                <td><?php echo  $r['nama'];?></td>
                                <td><?php echo $r['tanggal'];?></td>
                                <td><?php echo $r['jam'];?></td>
                        
                                <td><?php echo $r['status']; $no++;?></td>
<?php endforeach; ?>
</tr>

</table>
<?php
		}
	else
		{
			echo "<h3>Data masih kosong</h3>";	
		}	
?>
</form>


  <!-- Modal Penilai -->
  <!--End Modal-->