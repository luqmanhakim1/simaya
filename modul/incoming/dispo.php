            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Informasi Surat Masuk</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>Surat Masuk</a>
                        </li>
                        <li class="active">
                            <strong>Informasi Surat Masuk</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
            <div class="col-lg-12">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Informasi Surat Masuk</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Tanggal Diterima</th>
                        <th>Nomor Surat</th>
                        <th>Tanggal Surat</th>
                        <th>Perihal</th>
                        <th>Pengirim</th>
                        <th>Sifat Surat</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $getId  = $_GET['q']; 
                        $sql    = "SELECT tb_suratmasuk.tglaccept, tb_suratmasuk.nosurat, tb_suratmasuk.tglsurat, tb_suratmasuk.perihal, tb_suratmasuk.pengirim, tb_suratmasuk.file, tb_suratmasuk.lamp, tb_agenda.agenda, tb_sifat.sifat, tb_dispo.dispo, tb_dispo.isidispo, tb_suratmasuk.status
                            FROM `tb_suratmasuk` 
                            INNER JOIN `tb_sifat` ON (`tb_suratmasuk`.`id_sifat` = `tb_sifat`.`id_sifat`)
                            INNER JOIN `tb_agenda` ON (`tb_suratmasuk`.`id_ag` = `tb_agenda`.`id_ag`)
                            INNER JOIN `tb_dispo` ON (`tb_suratmasuk`.`id_sm` = `tb_dispo`.`id_dispo`)
                                WHERE `tb_suratmasuk`.`id_sm` = '{$getId}'"; 

                        $res    = $conn->query($sql);
                        $row    = $res->fetch_assoc();

                        $dispo = $row['dispo'];
                        
                        if ($dispo == "KBG"){
                            $dispo = 'Kabag Umum';
                        }elseif($dispo == "KBGR"){
                            $dispo = 'Kabag Rapat dan Perundang-undangan';
                        }elseif($dispo == 'KPH'){
                            $dispo = 'Kabag Perlengkapan dan Humas';
                        }elseif ($dispo == "KOMA"){
                            $dispo = 'Ketua Komisi A';
                        }elseif($dispo == "KOMB"){
                            $dispo = 'Ketua Komisi B';
                        }elseif($dispo == 'KOMC'){
                            $dispo = 'Ketua Komisi C';
                        }elseif($dispo == 'KOMD'){
                            $dispo = 'Ketua Komisi D';
                        }elseif ($dispo == 'SWN'){
                            $dispo = 'Sekwan';
                        }else{
                            echo '';
                        }

                        $status = $row['status'];
                        if ($status == "0"){
                            $status = '<span class="label label-warning">Belum dibaca</span>';
                        }else{
                            $status = '<span class="label label-primary">Sudah dibaca</span>';
                        }
                    ?>
                    <tr>
                        <td><?php echo DateIndo($row['tglaccept']); ?></td>
                        <td><?php echo $row['nosurat']; ?></td>
                        <td><?php echo DateIndo($row['tglsurat']); ?></td>
                        <td><?php echo $row['perihal']; ?></td>
                        <td><?php echo $row['pengirim']; ?></td>
                        <td><?php echo $row['sifat']; ?></td>
                    </tr>
                    </tbody>
                    </table>

                    <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Berkas Surat</th>
                        <th>Agenda</th>
                    </tr>
                    </thead>
                    <tbody>
                        <td style="width: 40%;"><?php echo $row['lamp']; ?> <a href="files/incoming/<?php echo $row['file']; ?>" target="_blank" ><?php echo $row['file']; ?></a></td>
                        <td><?php echo $row['agenda']." ".$status; ?></td>
                    </tbody>
                    
                    </table>
                    <form action="?p=incoming.action" method="post" class="form-horizontal" enctype="multipart/form-data">

                    <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Dispo kepada</th>
                        <th>Isi disposisi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="width: 40%;">
                            <input type="hidden" name="q" value="<?php echo $getId ?>" >
                            <select class="select2_demo_3 form-control" name="dispo" required="">
                                <option value="<?php echo $row['dispo']; ?>"> <?php echo $dispo; ?></option>
                                <option value="KBG">Kabag Umum</option>
                                <option value="KBGR">Kabag Rapat dan Perundang-undangan</option>
                                <option value="KPH">Kabag Perlengkapan dan Humas</option>
                            </select>       
                        </td>
                        <td>
                            <textarea type="text" name="isidispo" class="form-control" required=""><?php echo $row['isidispo']; ?></textarea>
                        </td>
                    </tr>
                    </tbody>
                    </table>
                        <button class="btn btn-primary" type="submit" name="disposisi">Kirim disposisi</button>
                    </form>
                    </div>
                </div>
            </div>