SELECT DATE_FORMAT(tr.`order_timestamp`,'%M') AS bulan,
SUM((`selling_price`-`buying_price`)*qty) AS 'profit_inventory',
IFNULL(subPinjaman.untung_koperasi,0) AS 'profit_koperasi'
FROM transaksi tr 
JOIN transaksi_detail td ON tr.`order_id`=td.`order_id` 
LEFT JOIN ( SELECT tp.`time_created`,DATE_FORMAT(tp.`time_created`,'%M')AS bulan, 
		SUM(tp.`bunga`) AS untung_koperasi ,tp.`id`
		FROM transaksi_pinjaman tp
		WHERE 1 
		AND YEAR(tp.`time_created`)='2017' 
		GROUP BY MONTH(tp.`time_created`) 
	 )subPinjaman 
	 ON MONTH(subPinjaman.`time_created`)=MONTH(tr.`order_timestamp`) 
WHERE 1 
AND tr.`payment_status`='lunas'
AND YEAR(tr.`order_timestamp`)='2017' 
GROUP BY MONTH(tr.`order_timestamp`)
UNION
SELECT subPinjaman2.`bulan` AS 'bulan',
IFNULL(SUM((`selling_price`-`buying_price`)*qty),0) AS 'profit_inventory',
IFNULL(subPinjaman2.untung_koperasi,0) AS 'profit_koperasi'
FROM transaksi tr 
JOIN transaksi_detail td ON tr.`order_id`=td.`order_id` 
RIGHT JOIN ( SELECT tp.`time_created`,DATE_FORMAT(tp.`time_created`,'%M')AS bulan,`status`, 
		SUM(tp.`bunga`) AS untung_koperasi ,tp.`id`
		FROM transaksi_pinjaman tp
		WHERE 1 
		AND YEAR(tp.`time_created`)='2017' 
		GROUP BY MONTH(tp.`time_created`) 
	 )subPinjaman2 
	 ON MONTH(subPinjaman2.`time_created`)=MONTH(tr.`order_timestamp`) 
WHERE 1 
AND subPinjaman2.`status`='lunas'
AND YEAR(subPinjaman2.`time_created`)='2017' 
GROUP BY MONTH(subPinjaman2.`time_created`);

SELECT tr.*,ma.*,
	SUM((trd.`selling_price`-trd.`buying_price`)*trd.`qty`) AS profit_detail_id
FROM transaksi tr
JOIN transaksi_detail trd ON tr.`order_id`=trd.`order_id`
LEFT JOIN master_anggota ma ON tr.`kode_customer`=ma.`no_anggota`
GROUP BY tr.`order_id`,trd.`order_detail_id`;

UPDATE transaksi tr SET tr.`kode_customer`='newCustomer' WHERE tr.`kode_customer`='';

SELECT * FROM transaksi tr
JOIN transaksi_detail trd ON tr.`order_id`=trd.`order_id`
WHERE 1
AND tr.`kode_customer`='239';
