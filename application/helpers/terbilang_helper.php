<?php
function konversi($x){
   
  $x = abs($x);
  $angka = array ("","Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
  $temp = ""; 
    if($x < 12){
     $temp = " ".$angka[$x];
    }else if($x<20){
     $temp = konversi($x - 10)." Belas";
    }else if ($x<100){
     $temp = konversi($x/10)." Puluh". konversi($x%10);
    }else if($x<200){
     $temp = " Seratus".konversi($x-100);
    }else if($x<1000){
     $temp = konversi($x/100)." Ratus".konversi($x%100);   
    }else if($x<2000){
     $temp = " Seribu".konversi($x-1000);
    }else if($x<1000000){
     $temp = konversi($x/1000)." Ribu".konversi($x%1000);   
    }else if($x<1000000000){
     $temp = konversi($x/1000000)." Juta".konversi($x%1000000);
    }else if($x<1000000000000){
     $temp = konversi($x/1000000000)." Milyar".konversi($x%1000000000);
    }
  return $temp;
 }
   

  
 function terbilang($x){
  if($x<0){
   $hasil = "minus ".trim(konversi(x));
  }else{
   $hasil = trim(konversi($x));
  }
  return $hasil;  
 }
 
?>