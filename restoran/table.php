<?php
include "connection/koneksi.php";
session_start();
ob_start();
$uang = 0;
?>
<div class="row-fluid">
      <div class="span9">
        <div class="widget-box">
          <div class="widget-title bg_lg"><span class="icon"><i class="icon-th-large"></i></span>
          	<h1 align="center">RESTAURANT</h1>
          	<h5 align="center">Jl. Inpres Tengah Kramat Jati Jakarta Timur</h5>
            <h2 align="center">Laporan Penjualan Hari Ini</h2>
          </div>
<div class="widget-content nopadding">
            <table class="table table-bordered table-invoice-full">
              <thead>
              	<table border="2" cellpadding="3">
                <tr>
                  <th class="width = 5%">No.</th>
                  <th class="width = 20%">Nama Menu</th>
                  <th class="width = 10%">Sisa Stok</th>
                  <th class="width = 10%">Jumlah Terjual</th>
                  <th class="width = 50%">Harga</th>
                  <th class="width = 50%">Total Masukan</th>
                </tr>
              </thead>
              <?php
                $no = 1;
                

                $query_lihat_menu = "select * from tb_masakan";
                $sql_lihat_menu = mysqli_query($conn, $query_lihat_menu);

              ?>
              <tbody>
              <?php
                while($r_lihat_menu = mysqli_fetch_array($sql_lihat_menu)){
              ?>
                <tr>
                  <td><center><?php echo $no++;?>.</center></td>
                  <td><?php echo $r_lihat_menu['nama_masakan'];?></td>
                  <td><center><?php echo $r_lihat_menu['stok'];?></center></td>
                  <td>
                    <center>
                      <?php
                        $id_masakan = $r_lihat_menu['id_masakan'];
                        $query_lihat_stok = "select * from tb_stok left join tb_pesan on tb_stok.id_pesan = tb_pesan.id_pesan left join tb_masakan on tb_pesan.id_masakan = tb_masakan.id_masakan where status_cetak = 'belum cetak'";
                        $query_jumlah = "select sum(jumlah_terjual) as jumlah_terjual from tb_stok left join tb_pesan on tb_stok.id_pesan = tb_pesan.id_pesan where id_masakan = $id_masakan and status_cetak = 'belum cetak'";
                        $sql_jumlah = mysqli_query($conn, $query_jumlah);
                        $result_jumlah = mysqli_fetch_array($sql_jumlah);

                        $jml = 0;

                        if($result_jumlah['jumlah_terjual'] != 0 || $result_jumlah['jumlah_terjual'] != null || $result_jumlah['jumlah_terjual'] != ""){
                          //echo $result_jumlah['jumlah_terjual'];
                          $jml = $result_jumlah['jumlah_terjual'];
                          echo $jml;
                        } else {
                          $jml = 0;
                          echo $jml;
                        }
                      ?>
                    </center>
                  </td>
                  <td style="text-align: right">Rp. <?php echo $r_lihat_menu['harga'];?> ,-</td>
                  <td style="text-align: right">Rp. 
                    
                      <?php

                        $id_masakan = $r_lihat_menu['id_masakan'];
                        $query_lihat_stok = "select * from tb_stok left join tb_pesan on tb_stok.id_pesan = tb_pesan.id_pesan left join tb_masakan on tb_pesan.id_masakan = tb_masakan.id_masakan where status_cetak = 'belum cetak'";
                        $query_jumlah = "select sum(jumlah_terjual) as jumlah_terjual from tb_stok left join tb_pesan on tb_stok.id_pesan = tb_pesan.id_pesan where id_masakan = $id_masakan and status_cetak = 'belum cetak'";
                        $sql_jumlah = mysqli_query($conn, $query_jumlah);
                        $result_jumlah = mysqli_fetch_array($sql_jumlah);

                        $jml = 0;

                        if($result_jumlah['jumlah_terjual'] != 0 || $result_jumlah['jumlah_terjual'] != null || $result_jumlah['jumlah_terjual'] != ""){
                          //echo $result_jumlah['jumlah_terjual'];
                          $jml = $result_jumlah['jumlah_terjual'] * $r_lihat_menu['harga'];
                          echo $jml;
                        } else {
                          $jml = $result_jumlah['jumlah_terjual'] * $r_lihat_menu['harga'];
                          echo $jml;
                        }
                        $uang += $jml;
                      ?>
                    
                   ,-</td>
                </tr>
              <?php
                }
                //echo $uang;
              ?>

              </tbody>
            </table>
            <div class="container-fluid">
    <div class="row-fluid">
      <ul class="quick-actions">
        <li class="bg_lg"><i class="icon-book"></i> <h4>Total Uang Masuk</h4><h4>Rp. <?php echo $uang;?> ,-</h4> </a> </li>
      </ul>
    </div>
          </div>
      </div>
  </div>
</div>


