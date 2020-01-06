<!DOCTYPE html>
<html>
<head>
  <title><?=$title?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
   <style>


        table{
            border-collapse: collapse;
            width: 100%;
            'margin: 0 auto;
            padding-top: 35px;
        }
        h2{
            text-align: center;
        }
        h1{
            text-align: center;
        }
        

        #judul{
            font-size: 20px;
            font-weight: bold;
        }

        #tebal2{
            font-weight: bold;
        }

        #tebal{
            border:1px solid #000;
            padding: 3px;
            font-weight: normal;
            text-align: center;
        }

        #garis{
            width: 40%;
            border: 1px solid #000000;
        }
        #nis{
            text-align: left;
        }
        th{
            font-size: 11px;
        }
        td{
            font-size: 11px;
        }
        p{
            font-size: 11px;
        }
        @page {
            margin-top: -3em;
        }
        table th{
            border:1px solid #000;
            padding: 3px;
            font-weight: bold;
            text-align: center;
        }
        table td{
            border:1px solid #000;
            padding: 3px;
            text-align: center;
        }

    </style>
    
</head>
<body >
<h3 style="text-align: center; "><b>REPORT ORDER</b></h3>
<h3 style="text-align: center; "></h3>



<table>
     <tr>
        <th>NO</th>     
        <th>ID Order</th>
        <th>Tanggal Order</th>
        <th>Nama Pembeli</th>
        <th>No Hp (WA)</th>
        <th>Alamat</th>
        <th>Produk yang dibeli</th>
    </tr>

     <?php foreach($cet as $r){?>
    <tr>
        <td><?php echo $r->no; ?></td>
        <td><?php echo $r->id_order; ?></td>
        <td><?php echo $r->tanggal; ?></td>
        <td><?php echo $r->nama; ?></td>
        <td><?php echo $r->no_hp; ?></td>
        <td><?php echo $r->alamat; ?></td>
        <td><?php echo $r->produk; ?></td>
    </tr>

    <?php 
    }
    ?>
    
</table>






</body>
</html>