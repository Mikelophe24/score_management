<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Admin</title>

  <!-- phông chữ-->
  <link href="bootstraps/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- trang pluin-->
  <link href="bootstraps/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- phong cách-->
  <link href="bootstraps/css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">
  <!-- header -->
  <?php require_once 'View/masster/header.php'; ?>

  <div id="wrapper">

    <!-- Thanh công cụ footer-->
    <?php require_once 'View/masster/footer.php'; ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Bảng danh sách sinh viên thi lại</a>
          </li>
          <li class="breadcrumb-item active">Sinh viên thi lại</li>
        </ol>

        <!-- DataTables Demo -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
          Hiện thị bảng danh sách sinh viên thi lại</div>

          
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Mã SV</th>
                    <th>Mã Môn</th>
                    <th>Trang thái</th>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <tbody>
                	<?php if(is_array($list_sv) && count($list_sv) > 0): ?>
                  <?php 
                  $STT = 0;
                  foreach ($list_sv as $value) {
                    $STT++;
                   ?>
                  <tr>
                    <td><?php echo $STT; ?></td>
                    <td><?php echo $value['ma_sv']; ?></td>
                    <td><?php echo $value['ma_mon']; ?></td>
                    <td>
                    	<select class="select_trangthai">
                    		<option <?php echo $value['trangthai'] == 1?'selected':'';  ?> value="1" data-action="/index.php?controllers=quanly&action=Thi_lai&acplus=edit&ma_sv=<?php echo $value['ma_sv']; ?>&ma_mon=<?php echo $value['ma_mon']; ?>&trangthai=1">Đã thi lại</option>
                    		<option <?php echo $value['trangthai'] == 0?'selected':'';  ?> value="1" data-action="/index.php?controllers=quanly&action=Thi_lai&acplus=edit&ma_sv=<?php echo $value['ma_sv']; ?>&ma_mon=<?php echo $value['ma_mon']; ?>&trangthai=0">Chưa thi lại</option>
                    	</select>
                    </td>
                    <td>
                      <a onclick="return confirm('Bạn có chắc chắn muốn xóa không..?')" href="index.php?controllers=quanly&action=Thi_lai&acplus=delete&ma_sv=<?php echo $value['ma_sv']; ?>&ma_mon=<?php echo $value['ma_mon']; ?>" title="Xóa"><i class="fas fa-trash-alt"> </i></a>
                    </td>
                  </tr>
                <?php } ?>
            	<?php else: ?>
            		<tr>
                		<td colspan="100%">Chưa có dữ liệu!</td>
                	</tr>
            	<?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Sẵn sàng đang xuất?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Bạn có chắc chắn muốn đăng xuất tài khoản không?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
          <a class="btn btn-primary" href="index.php">Đăng xuất</a>
        </div>
      </div>
    </div>
  </div>

</body>
<!-- Bootstrap core JavaScript-->
<script src="bootstraps/vendor/jquery/jquery.min.js"></script>
<script src="bootstraps/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="bootstraps/vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Page level plugin JavaScript-->
<script src="bootstraps/vendor/chart.js/Chart.min.js"></script>
<script src="bootstraps/vendor/datatables/jquery.dataTables.js"></script>
<script src="bootstraps/vendor/datatables/dataTables.bootstrap4.js"></script>
<!-- Custom scripts for all pages-->
<script src="bootstraps/js/sb-admin.min.js"></script>
<!-- Demo scripts for this page-->
<script src="bootstraps/js/demo/datatables-demo.js"></script>
<script src="bootstraps/js/demo/chart-area-demo.js"></script>
</html>