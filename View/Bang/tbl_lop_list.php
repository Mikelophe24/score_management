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
            <a href="#">Bảng lớp</a>
          </li>
          <li class="breadcrumb-item active">Lớp</li>
        </ol>

        <!-- DataTables Demo -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Hiện thị bảng lớp
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <div class="d-flex justify-content-between mb-3">
                <a href="index.php?controllers=quanly&action=Add_lop">
                  <button class="btn btn-primary" type="submit">Thêm mới</button>
                </a>
                
                <form action="index.php?controllers=quanly&action=Search_lop" method="GET" class="d-flex w-50">
                  <input type="hidden" name="controllers" value="quanly">
                  <input type="hidden" name="action" value="Search_lop">
                  <div class="input-group flex-grow-1">
                    <input type="text" class="form-control" placeholder="Nhập mã lớp hoặc tên lớp..." name="keyword">
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
                    </div>
                  </div>
                </form>
              </div>

              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Mã lớp</th>
                    <th>Tên lớp</th>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $STT = 0;
                  foreach ($listlop as $value) {
                    $STT++;
                   ?>
                  <tr>
                    <td><?php echo $STT; ?></td>
                    <td><?php echo $value['ma_lop']; ?></td>
                    <td><?php echo $value['ten_lop']; ?></td>
                    <td>
                      <a href="index.php?controllers=quanly&action=Edit_lop&maLop=<?php echo $value['ma_lop']; ?>" title="Sửa"><i class="fas fa-edit"></i> </a>
                      <a onclick="return confirm('Bạn có chắc chắn muốn xóa không..?')" href="index.php?controllers=quanly&action=Delete_lop&maLop=<?php echo $value['ma_lop']; ?>" title="Xóa"><i class="fas fa-trash-alt"> </i></a>
                    </td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
            <div class="card-footer small text-muted">Cập nhật ngày <?php foreach ($time as $value) {
              echo date('d-m-Y g:i:s A',strtotime($value['Thoigian']));
            } ?></div>
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
