            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Surat Masuk Ketua</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="?p=home">Home</a>
                        </li>
                        <li class="active">
                            <strong>Surat Masuk Ketua</strong>
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
                        <h5>Surat Masuk Ketua</h5>
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
                    <table class="table table-striped table-bordered table-hover " id="dataTables-example" >
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Nomor Surat</th>
                        <th>Pengirim</th>
                        <th>Perihal</th>
                        <th>Agenda</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT `tb_suratmasuk`.`id_sm`, `tb_suratmasuk`.`tglaccept`, `tb_suratmasuk`.`nosurat`, `tb_suratmasuk`.`pengirim`, `tb_agenda`.`agenda`, `tb_suratmasuk`.`perihal`, `tb_suratmasuk`.`uac`, `tb_suratmasuk`.`status` 
                                FROM `tb_suratmasuk` 
                                INNER JOIN `tb_agenda` ON (`tb_suratmasuk`.`id_ag` = `tb_agenda`.`id_ag`)
                                WHERE `tb_suratmasuk`.`id_ag` = '1' AND `tb_suratmasuk`.`status` = '1' ORDER BY `tb_suratmasuk`.`id_sm` DESC";
                        
                        $res = $conn->query($sql);
                        
                        $no = 0;
                        foreach ($res as $row) {

                        $status = $row['status'];
                        if ($status == "0"){
                            $status = '<span class="label label-warning">Belum dibaca</span>';
                        }else{
                            $status = '<span class="label label-primary">Sudah dibaca</span>';
                        }
                        
                        $no++;
                    ?>           
                    <tr class="odd gradeX">
                        <td><?php echo $no; ?></td>
                        <td><?php echo DateIndo($row['tglaccept']); ?></td>
                        <td><?php echo $row['nosurat'];?></td>
                        <td><?php echo $row['pengirim'];?></td>
                        <td><?php echo $row['perihal'];?></td>
                        <td><a href="?p=letter.ketua&q=<?php echo $row['id_sm']; ?>"><?php echo $status."</a> ".$row['agenda']; ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>