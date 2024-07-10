<!DOCTYPE html>
<html lang="en">

<head>
  

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Tổng hợp điểm</title>

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

    <!-- Thanh công cụ -->
    <?php require_once 'View/masster/footer.php'; ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Bảng điều khiển</a>
          </li>
          <li class="breadcrumb-item active">Tổng hợp chi tiết điểm</li>
        </ol>
        <div class="card mb-3 p-3">
            <div class="row">
                
                <div class="col-sm-6">
                    <form action="#" method="POST">
                      <label for="sel1" style="color: #FFFFFF;">Chọn lớp</label>

                      <div class="input-group mb-3">
                        <select class="form-control" name="txt_malop" >
                            <option value="">Chọn lớp để lọc theo lớp</option>
                          <?php foreach ($list_lop as $value) {

                            ?>
                            <option <?php echo isset($dataPost['txt_malop']) && $dataPost['txt_malop'] ==$value['ma_lop']?'selected':''; ?> value="<?php echo $value['ma_lop']; ?>"><?php echo $value['ten_lop']; ?></option>
                          <?php } ?>
                        </select>
                        <div class="input-group-append">
                          <button type="submit" name="Hienthi" class="btn-primary">Hiển thị</button>
                        </div>
                      </div>

                    </form>
                </div>
                <div class="col-sm-6">
                    <form action="#" method="POST">
                  <div class="form-group">
                    <input type="hidden" name="txt_malop" value="<?php echo isset($dataPost['txt_malop']) && $dataPost['txt_malop'] != ''? $dataPost['txt_malop']:''; ?>" >
                    <label for="sel2" style="color: #FFFFFF;">Danh sách sinh viên</label>
                    <select class="form-control" id="sel2" name="txt_masinhvien" size="8">
                      <?php 
                        foreach ($list_lop_sinhvien as $value) {
                      ?>
                      <option <?php echo isset($dataPost['txt_masinhvien']) && $dataPost['txt_masinhvien'] ==$value['ma_sv']?'selected':''; ?> value="<?php echo $value['ma_sv'] ?>"><?php echo $value['hoten_sv'] ?></option>
                      <a href=""><?php echo $value['hoten_sv'] ?></a>
                      <?php } ?>
                    </select>
                    <div class="input-group-append">
                      <button type="submit" name="xem" class="btn btn-primary">Xem chi tiết Sinh viên</button>
                    </div>
                  </div>
                </form>
                </div>
            </div>
        </div>
        <!-- DataTables Demo -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
          Bảng tổng hợp Điểm chi tiết sinh viên</div>
              <?php require_once "View/masster/tonghopdiem_content.php"; ?>
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
