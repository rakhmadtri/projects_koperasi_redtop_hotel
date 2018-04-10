<?php $this->load->view("header") ?>
<title>Order Detail Customer</title>
<link href="<?php echo base_url() ?>include/styleAdmin.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<br />
<table width="670" border="0" align="center" cellpadding="0" cellspacing="0" style="background-color:white">
        <tr>
          <td width="698" class="boxProduk" valign="top"><form id="form2" name="form2" method="post" action="">
            <table width="670" border="0" cellspacing="4" cellpadding="0">
              <tr>
                <td class="tMenuMember2">Detail Pemesanan</td>
              </tr>
              <tr>
                <td class="dot"><img src="<?php echo base_url() ?>include/u.gif" width="1" height="1" /></td>
              </tr>
              <tr>
                <td><table width="670" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="670" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="330"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="29%" class="tTotalBelanja">Tanggal</td>
                            <td width="71%" class="tTotalBelanja"> : <?php echo isset($transaksi_detail[0]['payment_timestamp'])?($transaksi_detail[0]['payment_timestamp']):""; ?></td>
                          </tr>
                          <tr>
                            <td class="tTotalBelanja">No.Pemesanan</td>
                            <td class="tTotalBelanja">: <?php echo isset($transaksi_detail[0]['order_id'])?($transaksi_detail[0]['order_id']):""; ?></td>
                          </tr>
                          <tr>
                            <td class="tTotalBelanja">Status</td>
                            <td class="tTotalBelanja">: <?php echo isset($transaksi_detail[0]['payment_status'])?($transaksi_detail[0]['payment_status']):""; ?></td>
                          </tr>
                          <tr>
                            <td class="tTotalBelanja">&nbsp;</td>
                            <td class="tTotalBelanja">&nbsp;</td>
                          </tr>
                          </table></td>
                        <td><img src="<?php echo base_url() ?>include/u.gif" width="30" height="1" /></td>
                        <td width="330" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td class="tTotalBelanja">Nama</td>
                            <td class="tTotalBelanja" >: <?php echo isset($transaksi_detail[0]['nama'])?$transaksi_detail[0]['nama']:""; ?></td>
                          </tr>
                          <tr>
                            <td width="31%" class="tTotalBelanja">Email</td>
                            <td width="69%" class="tTotalBelanja" >: <?php echo isset($transaksi_detail[0]['email'])?$transaksi_detail[0]['email']:"" ?></td>
                          </tr>
                          <tr>
                            <td class="tTotalBelanja">No. Handphone</td>
                            <td class="tTotalBelanja">: <?php echo isset($transaksi_detail[0]['account_mobile'])?$transaksi_detail[0]['account_mobile']:""; ?></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td class=""><table width="100%" border="0" cellspacing="4" cellpadding="0">
                      <tr>
                        <td><table width="670" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td class="MemberTab"><table width="670" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="259" class="tTopMenu">Produk</td>
                                <td width="134" class="tTopMenu">SKU</td>
                                <td width="132" class="tTopMenu">Harga</td>
                                <td width="60" class="tTopMenu">Qty</td>
                                <td width="85" class="tTopMenu">Subtotal</td>
                                </tr>
                              </table></td>
                            </tr>
                          <tr>
                            <td class="boxProduk"><table width="670" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td><table width="670" border="0" cellspacing="0" cellpadding="0">
                                  <?php if (isset($transaksi_detail)): ?>
                                   <?php foreach ($transaksi_detail as $key => $value): ?>
                                    <tr>
                                      <td width="259" class="tTopMenu2"><?php echo $value['order_name']; ?></td>
                                      <td width="134" class="tTopMenu2"><?php echo $value['license']; ?></td>
                                      <td width="132" class="tTopMenu2"><?php echo $value['selling_price'] ?></td>
                                      <td width="59" class="tTopMenu2"><?php echo $value['qty'] ?></td>
                                      <td width="86" class="tTopMenu2"><?php echo $value['total_price']; ?></td>
                                    </tr>
                                  <?php endforeach ?>
                                  <?php endif ?>
                                </table>
                                </td>
                              </tr>
                              <tr>
                                <td class="dot"><img src="<?php echo base_url() ?>include/u.gif" width="1" height="1" /></td>
                              </tr>
                            </table>
                            </tr>
                          <tr>
                            <td><table width="250" border="0" align="right" cellpadding="0" cellspacing="5">
                              <tr>
                                <td class="tDetailMember">Ringkasan Pemesanan</td>
                              </tr>
                              <tr>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="50%" class="tTotalBelanja">Total Pembayaran</td>
                                    <td width="50%" class="tTotalHargaBelanja"><?php echo isset($transaksi_detail[0]['total_customer_price'])?$transaksi_detail[0]['total_customer_price']:"" ?></td>
                                  </tr>
                                  <tr>
                                    <td class="tTotalBelanja">Total Belanja</td>
                                    <td class="tTotalBelanja2"><?php echo isset($transaksi_detail[0]['total_customer_price'])?$transaksi_detail[0]['total_customer_price']:""; ?></td>
                                  </tr>
                                  <tr>
                                    <td class="tTotalBelanja">Biaya BCAKlikpay</td>
                                    <td class="tTotalBelanja2">0</td>
                                  </tr>
                                  <tr>
                                    <td class="tTotalBelanja">Biaya Pengiriman</td>
                                    <td class="tTotalBelanja2">0</td>
                                  </tr>
                                  <tr>
                                    <td class="tTotalBelanja">Diskon Voucher</td>
                                    <td class="tTotalBelanja2">0</td>
                                  </tr>
                                </table></td>
                              </tr>
                            </table></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="tDetailMember">Status Pemesanan</td>
                        </tr>
                        <tr>
                          <td class="tCartPeringatan"><table width="100%" border="0" cellspacing="2" cellpadding="0">
                            <tr>
                              <td class="tIngatSaya"><img src="<?php echo base_url() ?>include/clock.png" width="20" height="20" /></td>
                              <td class="tIngatSaya">31/12/15 08:24</td>
                              <td class="tBerita">Mengirim email &amp; SMS </td>
                              </tr>
                            <tr>
                              <td width="5%" class="tIngatSaya"><img src="<?php echo base_url() ?>include/clock.png" width="20" height="20" /></td>
                              <td width="20%" class="tIngatSaya"><?php echo isset($transaksi_detail[0]['payment_timestamp'])?$transaksi_detail[0]['payment_timestamp']:""; ?></td>
                              <td width="75%" class="tBerita">Verifikasi Konfirmasi Pembayaran</td>
                              </tr>
                            <tr>
                              <td class="tIngatSaya"><img src="<?php echo base_url() ?>include/clock.png" width="20" height="20" /></td>
                              <td class="tIngatSaya"><?php echo isset($transaksi_detail[0]['created_timestamp'])?$transaksi_detail[0]['created_timestamp']:""; ?></td>
                              <td class="tBerita">Melakukan proses Check Out order</td>
                              </tr>
                            </table></td>
                        </tr>
                        </table></td>
                  </tr>
                </table></td>
              </tr>
            </table>
          </form></td>
        </tr>
    </table>
<?php $this->load->view("footer") ?>