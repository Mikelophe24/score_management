<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Admin</title>

  <!-- Font Awesome -->
  <link href="bootstraps/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- DataTables CSS -->
  <link href="bootstraps/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom Styles -->
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
            <a href="#">Bảng danh sách sinh viên nhận học bổng</a>
          </li>
          <li class="breadcrumb-item active">Sinh viên nhận học bổng</li>
        </ol>

        <!-- DataTables Demo -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Hiện thị bảng danh sách sinh viên nhận học bổng
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Mã SV</th>
                    <th>Tên SV</th>
                    <th>Mã lớp</th>
                    <th>Tên lớp</th>
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
                    <td><?php echo $value['hoten_sv']; ?></td>
                    <td><?php echo $value['ma_lop']; ?></td>
                    <td><?php echo $value['ten_lop']; ?></td>
                    <td>
                      <a onclick="return confirm('Bạn có chắc chắn muốn xóa không..?')" href="index.php?controllers=quanly&action=Hoc_bong&acplus=delete&ma_sv=<?php echo $value['ma_sv']; ?>" title="Xóa"><i class="fas fa-trash-alt"> </i></a>
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
          <div class="card-footer">
            <!-- Export Excel Button -->
            <button class="btn btn-success" id="exportExcelBtn">Xuất Excel</button>
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
            <h5 class="modal-title" id="exampleModalLabel">Sẵn sàng đăng xuất?</h5>
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



  <!-- Export Excel Script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.0/xlsx.full.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('exportExcelBtn').addEventListener('click', function() {
        // Select the table
        var table = document.querySelector('#dataTable');

        // Convert the table to a workbook
        var wb = XLSX.utils.table_to_book(table, { sheet: "Sheet JS" });

        // Save the workbook as an Excel file
        var today = new Date();
        var fileName = 'export_' + today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate() + '.xlsx';
        XLSX.writeFile(wb, fileName);
      });
    });
  </script>

  
</html>
