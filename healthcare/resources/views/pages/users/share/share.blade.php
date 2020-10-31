<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Share Information</title>
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

                <div id="back-home" style="font-size: 30px;"><a style="color: rgb(0,123,255);" href="home">
                    <i class="typcn typcn-backspace" style="font-size: 38px;"></i> Home - Healthcare</a></div>

            </div>
        </nav>

        <h2 class="text-center" style="color: rgb(0,123,255);padding-bottom: 20px;">Share Information<br></h2>

        <div class="container" style="padding-left: 200px; padding-right: 200px; ">

            <!-- begin list from -->
            <div id="kedon_0" class="form-row">
                <div class="form-group col-md">
                    <input type="text" class="form-control" id="iduser" placeholder="Nhập id của người bạn muốn chia sẻ thông tin :" required>
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
                            <h6 class="modal-title" id="exampleModalLongTitle" style="color: #007bff">Vui lòng nhập id người dùng </h6>
                        </div>
                        <!-- <div class="modal-content">
                        </div> -->
                        <div class="modal-footer"> </div>

                    </div>
                </div>
            </div>


            <!-- from list id -->
            <div id="from-list-id"> </div>


            <!-- end list from -->

            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <button class="btn btn-outline-primary btn-block" onclick="Func_Save()">Save thông tin </button>
                </div>
                <!-- Modal Xuất đơn thuốc -->
                <div id="modal_check_F_IN" class="modal fade">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <!--  -->
                            <div class="modal-header">
                                <h6 class="modal-title" style="color: #007bff;">Bạn muốn lưu thông tin </h6>
                            </div>
                            <!-- <div class="modal-body"> </div> -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="modal_Func_Save()">Save</button>
                            </div>
                            <!--  -->
                        </div>
                    </div>
                </div>




                <!--  -->
                <div class="col-md-6 col-sm-6">
                    <button class="btn btn-outline-danger btn-block" onclick="Func_DELETE_ALL()">Xóa toàn bộ danh sách ID Users </button>
                </div>
                <!-- Modal Xóa đơn thuốc -->
                <div id="modal_check_F_OUT" class="modal fade">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <!--  -->
                            <div class="modal-header">
                                <h6 class="modal-title" style="color: #007bff;">Bạn muốn xóa toàn bộ danh sách ID</h6>
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


        </div>

        <footer class="rounded" id="info-footer" style="background-color: #007bff;color: rgb(255,255,255);font-size: 16px;margin-top: 20px;margin-bottom: 20px;">
            <h2 class="text-center" style="padding-top: 0px;padding-right: 0px;padding-bottom: 40px;"> <br>Gọi chúng tôi:<br>(84-24) 000 000 000<br></h2>
        </footer>

    </div>

    <script src="user_asset/assets/js/jquery.min.js"></script>
    <script src="user_asset/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="user_asset/assets/js/bs-init.js"></script>
    <script src="user_asset/assets/js/share.js"></script>

</body>

</html>
