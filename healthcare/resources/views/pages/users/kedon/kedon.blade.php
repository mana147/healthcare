<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Prescription</title>
    <link rel="stylesheet" href="user_asset/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arvo">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="user_asset/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="user_asset/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="user_asset/assets/fonts/typicons.min.css">
    <link rel="stylesheet" href="user_asset/assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="user_asset/assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="user_asset/assets/css/Header-Blue.css">
    <link rel="stylesheet" href="user_asset/assets/css/Highlight-Blue.css">
    <link rel="stylesheet" href="user_asset/assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="user_asset/assets/css/styles.css">
    <link rel="stylesheet" href="user_asset/assets/css/Team-Boxed.css">
    <link rel="stylesheet" href="user_asset/css/login-style.css">
</head>

<body>

    @include('pages.users.layout.header')

    <div class="container shadow-lg" id="main" style="margin-top: 30px;">
        <nav class="navbar navbar-light navbar-expand-md" id="home"
            style="padding-right: 0px;padding-left: 0px;padding-bottom: 20px;padding-top: 20px;">
            <div class="container-fluid">
                <div id="back-home" style="font-size: 30px;"><a style="color: rgb(0,123,255);"
                        href="/home"><i class="typcn typcn-backspace" style="  font-size: 38px;"></i> Home - Healthcare  </a></div>
            </div>
        </nav>
        <h2 class="text-center" style="color: rgb(0,123,255);padding-bottom: 20px;">Kê đơn thuốc - Prescription<br></h2>


        <div>
            <!-- chuẩn đoán bệnh  -->
            <div class="form-group">
                <!-- <label for="exampleFormControlTextarea1"> <strong> Chuẩn đoán bệnh / kê đơn thuốc : </strong> </label> -->
                <textarea id="chuandoanbenh" class="form-control" rows="2" placeholder="chuẩn đoán bệnh : " ></textarea>
            </div>

            <!-- begin list from -->
            <div id="kedon_0" class="form-row">
                <div class="form-group col-md-5">
                    <input type="text" class="form-control" id="ten_thuoc" placeholder="Nhập tên thuốc :" required>
                </div>
                <div class="form-group col-md-1">
                    <input type="text" class="form-control" id="don_vi_thuoc" placeholder="ĐV:">
                </div>
                <div class="form-group col-md-1">
                    <input type="number" min="0" class="form-control" id="so_luong_thuoc" placeholder="0" value="0">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" id="lieu_dung_thuoc" placeholder="Liều dùng:">
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-outline-primary" onclick="Func_ADD()">ADD </button>
                </div>
            </div>

            <!-- Modal Bootstrap’s -->
            <div id="modal_check_ADD" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">

                        <!-- modal header -->
                        <div class="modal-header">
                            <h6 class="modal-title" id="exampleModalLongTitle" style="color: #007bff">Vui lòng nhập tên
                                thuốc </h6>
                        </div>
                        <!-- <div class="modal-content">
                        </div> -->
                        <div class="modal-footer"> </div>

                    </div>
                </div>
            </div>


            <!-- code from ke don -->
            <div id="from-kedon"> </div>



            <!-- end list from -->

            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <button class="btn btn-outline-primary btn-block" onclick="Func_SAVE()">Save đơn thuốc </button>
                </div>
                <!-- Modal Xuất đơn thuốc -->
                <div id="modal_check_F_IN" class="modal fade">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <!--  -->
                            <div class="modal-header">
                                <h6 class="modal-title" style="color: #007bff;">Bạn muốn save đơn thuốc ? </h6>
                            </div>
                            <!-- <div class="modal-body"> </div> -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="modal_Func_SAVE()">Save</button>
                            </div>
                            <!--  -->
                        </div>
                    </div>
                </div>




                <!--  -->
                <div class="col-md-6 col-sm-6">
                    <button class="btn btn-outline-danger btn-block" onclick="Func_DELETE_ALL()">Xóa đơn thuốc </button>
                </div>
                <!-- Modal Xóa đơn thuốc -->
                <div id="modal_check_F_OUT" class="modal fade">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <!--  -->
                            <div class="modal-header">
                                <h6 class="modal-title" style="color: #007bff;">Bạn muốn xóa đơn thuốc ? </h6>
                            </div>
                            <!-- <div class="modal-body"> </div> -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger"
                                    onclick="modal_Func_DELETE_ALL()">Delete</button>
                            </div>
                            <!--  -->
                        </div>
                    </div>
                </div>


            </div>

            <div id="kedonxong" class="card" style="margin-top: 15px; display: none; ">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary font-weight-bold m-0">Đơn thuốc :</h6>
                </div>
                <div class="card-body">

                    <div id="chuandoanbenh_out" class="alert alert-success" role="alert">
                        <strong> Chuẩn đoán bệnh : </strong>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tên thuốc :</th>
                                    <th>Đơn Vị:</th>
                                    <th>Số lượng :</th>
                                    <th>Cách dùng :&nbsp;</th>
                                </tr>
                            </thead>

                            <tbody id="list_data_thuoc">

                            </tbody>
                        </table>
                    </div>
                </div><button class="btn btn-primary" type="button">In đơn thuốc</button>
            </div>

        </div>
        <footer id="info-footer" class="rounded"
            style="background-color: #007bff;color: rgb(255,255,255);font-size: 16px;margin-top: 20px;margin-bottom: 20px;">
            <h2 class="text-center" style="padding-top: 0px;padding-right: 0px;padding-bottom: 40px;"><br>Gọi chúng tôi
                :<br>(84-24) 000 000 000<br></h2>
        </footer>
    </div>

    <script src="user_asset/assets/js/jquery.min.js"></script>
    <script src="user_asset/assets/js/jquery.cookie.js"></script>
    <script src="user_asset/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="user_asset/assets/js/bs-init.js"></script>
    <script src="user_asset/assets/js/kedon.js"></script>

</body>

</html>
