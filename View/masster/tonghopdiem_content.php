<div class="card-body">
    <div class="table-responsive">
        <!-- TT -->
        <!-- TBL -->
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Lần thi</th>
                    <th>Mã môn</th>
                    <th>Tên môn</th>
                    <th>Số tín chỉ</th>
                    <th>Điểm học phần</th>
                    <th>Điểm chữ</th>
                    <th>Hệ Điểm số</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $STT = 0;
                    $TongSTC = 0;
                    $TongHDS = 0;
                    if (isset($ttDiem) && is_array($ttDiem)) {
                      foreach ($ttDiem as $value) {
                        $STT++;
                    
                        $diemHP = round(($value['diem_giua_ky']*0.3)+($value['diem_thi_hp']*0.7),1);
                        $diemchu = TongDiemChitiet::DC($diemHP);
                        $diemheso = TongDiemChitiet::HDS($diemHP);
                        
                        $TinhDHS = $value['sotinchi']*$diemheso;
                    
                        $TongSTC += $value['sotinchi'];
                        $TongHDS += $TinhDHS;
                        $lanthi = $value['lanthi'];
                    
                        ?>
                <tr>
                    <td><?php echo $STT; ?></td>
                    <td>Lần thi số <?php echo $lanthi; ?></td>
                    <td><?php echo $value['ma_mon']; ?></td>
                    <td><?php echo $value['ten_mon']; ?></td>
                    <td><?php echo $value['sotinchi']; ?></td>
                    <td><?php echo $diemHP; ?></td>
                    <td><?php echo $diemchu; ?></td>
                    <td><?php echo $diemheso; ?></td>
                    <td>
                        <?php if($diemHP < 4 && $lanthi == 1): ?>
                            <?php 
                                $sqlCheckUnique = 'select * from sinhvienthilai where ma_sv="'.$value['ma_sv'].'" and ma_mon="'.$value['ma_mon'].'"';
                                $dataCheckUnique = SinhvienThilai::Getdata($sqlCheckUnique);
                            ?>
                            <?php if(is_array($dataCheckUnique) && count($dataCheckUnique) > 0): ?>
                            <span>Đã gửi yêu cầu thi lại</span>
                            <?php else: ?>
                            <a href="/<?php echo $globalUrlAlias;?>/index.php?controllers=diem&action=Thi_lai&ma_sv=<?php echo $value['ma_sv']; ?>&ma_mon=<?php echo $value['ma_mon']; ?>" class="button_ajax">Yêu cầu thi lại</a>
                            <?php endif; ?>
                        <?php elseif($diemHP < 4 && $lanthi >= 2): ?>
                            <?php 
                                $sqlCheckUnique = 'select * from sinhvienhoclai where ma_sv="'.$value['ma_sv'].'" and ma_mon="'.$value['ma_mon'].'"';
                                $dataCheckUnique = SinhvienThilai::Getdata($sqlCheckUnique);
                            ?>
                            <?php if(is_array($dataCheckUnique) && count($dataCheckUnique) > 0): ?>
                            <span>Đã gửi yêu cầu học lại</span>
                            <?php else: ?>
                            <a href="/<?php echo $globalUrlAlias;?>/index.php?controllers=diem&action=Hoc_lai&ma_sv=<?php echo $value['ma_sv']; ?>&ma_mon=<?php echo $value['ma_mon']; ?>" class="button_ajax">Yêu cầu học lại</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php 
                    }}
                    ?>
            </tbody>
        </table>
        <!-- END TBL -->
        <!-- TT -->
        <table width="100%">
            <?php 
                if (isset($ttDiem) && is_array($ttDiem)) {
                  $tbtk = round($TongHDS/$TongSTC,2);
                  $xltk = TongDiemChitiet::XL_TK($TongHDS/$TongSTC);
                ?>
            <tr>
                <th>Mã sinh viên: </th>
                <td><?php if (isset($value['ma_sv'])) {
                    echo $value['ma_sv'];
                    } ?></td>
                <th>Nơi sinh: </th>
                <td><?php if (isset($value['noi_sinh'])) {
                    echo $value['noi_sinh'];
                    } ?></td>
                <th>TB toàn khóa: </th>
                <td><?php if (isset($tbtk)) {
                    echo $tbtk;
                    } ?></td>
            </tr>
            <tr>
                <th>Họ và tên: </th>
                <td><?php if (isset($value['hoten_sv'])) {
                    echo $value['hoten_sv'];
                    } ?></td>
                <th>Giới tính: </th>
                <td><?php if (isset($value['gioi_tinh'])) {
                    echo $value['gioi_tinh'];
                    } ?></td>
                <th>XL toàn khóa: </th>
                <td><?php if (isset($xltk)) {
                    echo $xltk;
                    } ?></td>
            </tr>
            <tr>
                <th>Ngày sinh: </th>
                <td><?php if (isset($value['ngay_sinh'])) {
                    echo date('d-m-Y',strtotime($value['ngay_sinh']));
                    } ?></td>
                <th>Dân tộc: </th>
                <td><?php if (isset($value['dan_toc'])) {
                    echo $value['dan_toc'];
                    } ?></td>
                <?php if($tbtk >= 3.8): ?>
                <th>Xét học bổng</th>
                <td><a href="/<?php echo $globalUrlAlias;?>/index.php?controllers=diem&action=Hoc_bong&ma_sv=<?php echo $value['ma_sv']; ?>" class="button_ajax btn btn-success">Xét Học Bổng</a></td>
                <?php else: ?>
                <th></th>
                <td></td>
                <?php endif; ?>
            </tr>
            <?php } ?>
        </table>
        <!-- END TT -->
    </div>
</div>
<div class="card-footer small text-muted">Cập nhật ngày hôm qua lúc 11:59</div>
</div>