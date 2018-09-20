<?php
/**
 * Created by PhpStorm.
 * User: radinaldn
 * Date: 26/08/18
 * Time: 22:56
 */

      function cetakTanggalNow(){


          ?>
          <!-- Menampilkan date time realtime -->
          <script type="text/javascript">
              function tampilkanwaktu(){         //fungsi ini akan dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
                  var waktu = new Date();            //membuat object date berdasarkan waktu saat
                  var sh = waktu.getHours() + "";    //memunculkan nilai jam, //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length    //ambil nilai menit
                  var sm = waktu.getMinutes() + "";  //memunculkan nilai detik
                  var ss = waktu.getSeconds() + "";  //memunculkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
                  document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
              }
          </script>

          <?php
          $hari = date('l');
          /*$new = date('l, F d, Y', strtotime($Today));*/
          if ($hari=="Sunday") {
              echo "Minggu";
          }elseif ($hari=="Monday") {
              echo "Senin";
          }elseif ($hari=="Tuesday") {
              echo "Selasa";
          }elseif ($hari=="Wednesday") {
              echo "Rabu";
          }elseif ($hari=="Thursday") {
              echo("Kamis");
          }elseif ($hari=="Friday") {
              echo "Jum'at";
          }elseif ($hari=="Saturday") {
              echo "Sabtu";
          }
          ?>,
          <!-- /*Selesai Menampilkan Hari*/

          /*Menampilkan Tanggal*/ -->
          <?php
          $tgl =date('d');
          echo $tgl;
          $bulan =date('F');
          if ($bulan=="January") {
              echo " Januari ";
          }elseif ($bulan=="February") {
              echo " Februari ";
          }elseif ($bulan=="March") {
              echo " Maret ";
          }elseif ($bulan=="April") {
              echo " April ";
          }elseif ($bulan=="May") {
              echo " Mei ";
          }elseif ($bulan=="June") {
              echo " Juni ";
          }elseif ($bulan=="July") {
              echo " Juli ";
          }elseif ($bulan=="August") {
              echo " Agustus ";
          }elseif ($bulan=="September") {
              echo " September ";
          }elseif ($bulan=="October") {
              echo " Oktober ";
          }elseif ($bulan=="November") {
              echo " November ";
          }elseif ($bulan=="December") {
              echo " Desember ";
          }
          $tahun=date('Y');
          echo $tahun;
          ?>
          <!-- /*Selesai Menampilkan Tanggal*/ -->
          <!--  -->
          <?php

      }

  function cetakWelcome(){
      $tanggal = mktime(date('m'), date("d"), date('Y'));
      // echo "Tanggal : <b> " . date("d-m-Y", $tanggal ) . "</b>";
      date_default_timezone_set("Asia/Jakarta");
      $jam = date ("H:i:s");
      // echo " | Pukul : <b> " . $jam . " " ." </b> ";
      $a = date ("H");
      if (($a>=4) && ($a<10)) {
          echo " <b>Selamat Pagi</b>";
      }else if(($a>=10) && ($a<=14)){
          echo "Selamat  Siang";
      }elseif(($a>=15) && ($a<=16)){
          echo "Selamat Sore";
      }elseif(($a>=17) && ($a<=18)){
          echo "Selamat Petang";
      }else{
          echo "<b> Selamat Malam </b>";
      }
  }
  ?>