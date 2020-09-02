@extends('pages.users.layout.index')

@section('content')

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>web_app_03</title>

</head>

<body>
    <div class="container shadow-lg" id="main" style="margin-top: 30px;">

        <nav class="navbar navbar-light navbar-expand-md" id="home"
            style="padding-right: 0px;padding-left: 0px;padding-bottom: 0px;padding-top: 20px;">
            <div class="container-fluid">
                <div id="home-user-id">
                    <h3 style="color: rgb(0,123,255);"><i class="fas fa-user-md" style="font-size: 50px;"></i>&nbsp;Home
                        - Healthcare : CustomerID&nbsp;</h3>
                </div>


                <!-- search-id  -->
                <div id="search-id">
                    <form
                        class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">

                            <input id="input-search-id" class="bg-light form-control border-0 small" type="text"
                                placeholder="Nhập số id ...">

                            <div class="input-group-append">
                                <button id="button-search-id" class="btn btn-primary py-0" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>

                        </div>
                    </form>
                </div>


            </div>
        </nav>

        <nav class="navbar navbar-light navbar-expand-md" id="services"
            style="padding-bottom: 16px;padding-top: 16px;padding-right: 0px;padding-left: 0px;">
            <div class="container-fluid">

                {{-- id --}}
                <div id="id">
                    <h4 style="color: rgba(0,123,255,0.8);"><i class="far fa-id-card"
                            style="font-size: 30px;color: rgba(0,123,255,0.8);"></i>&nbsp;: Nguyễn Văn Abcd ( ID: 123456
                        )&nbsp;</h4>
                </div>

                {{-- nav navbar-nav --}}
                <ul class="nav navbar-nav" id="sokhambenh_kedon">
                    {{-- ---------------------- --}}
                    <li class="nav-item dropdown border rounded" style="margin-right: 8px;background-color: #3395ff;">
                        <a id="so_kham_benh" class="dropdown-toggle nav-link" data-toggle="dropdown"
                            aria-expanded="false" href="#" style="color: rgba(255,255,255,0.89);">
                            <i class="fas fa-book-medical"> </i>&nbsp;Sổ Khám Bệnh
                        </a>
                        <div class="dropdown-menu" role="menu"
                            style="padding: 0px;padding-top: 0px;padding-bottom: 0px;width: 310px;margin-left:-70px;margin-top:10px; ">
                            <ul class="list-group" id="list_menu"></ul>
                        </div>
                    </li>
                    {{-- ---------------------- --}}
                    <li class="nav-item" role="presentation" id="ke-don-thuoc">
                        <a class="nav-link border rounded" href="kedon"
                            style="background-color: #3395ff;color: rgb(255,255,255);margin-right: 8px">
                            <i class="fa fa-file-text-o"></i>&nbsp;Kê đơn thuốc
                        </a>
                    </li>
                    {{-- ---------------------- --}}
                    <li class="nav-item" role="presentation" id="share-user-info">
                        <a class="nav-link border rounded" href="shareinfo"
                            style="background-color: #3395ff;color: rgb(255,255,255);">
                            <i class="fa fa-file-text-o"></i>&nbsp;Add users
                        </a>
                    </li>
                    {{-- ---------------------- --}}
                </ul>

            </div>
        </nav>

        <div class="container-fluid" id="sensor">
            <div class="row" id="row-sensor">
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-left-primary py-2" style="filter: blur(0px);">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>nhịp
                                            tim</span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0" id="heartbeat"><span>000 BPM</span>
                                    </div>
                                </div>
                                <div class="col-auto"><i class="fas fa-heartbeat fa-2x text-gray-300"
                                        style="color: rgb(51,149,255);"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-left-success py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Nồng độ
                                            oxy</span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0" id="oxy"><span>% SpO2 :
                                            000&nbsp;<br></span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-vial fa-2x text-gray-300"
                                        style="color: rgb(51,149,255);"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-left-info py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span>huyết
                                            áp</span></div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="text-dark font-weight-bold h5 mb-0 mr-3" id="blood_pressure">
                                                <span> 000</span></div>
                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-info" aria-valuenow="50" aria-valuemin="0"
                                                    aria-valuemax="100" style="width: 50%;"><span
                                                        class="sr-only">50%</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto"><i class="fas fa-stethoscope fa-2x text-gray-300"
                                        style="color: rgb(51,149,255);"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-left-warning py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>nhiệt
                                            độ cơ thể</span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0" id="body_temp"><span>000*C</span>
                                    </div>
                                </div>
                                <div class="col-auto"><i class="fa fa-thermometer-2 fa-2x text-gray-300"
                                        style="color: rgb(51,149,255);"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="row-sensor-1">
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-left-primary py-2" style="filter: blur(0px);">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Chiều
                                            cao</span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0" id="tall"><span>000 cm</span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-arrows-alt-v fa-2x text-gray-300"
                                        style="color: rgb(51,149,255);"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-left-success py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Cân
                                            nặng</span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0" id="weight"><span>&nbsp;000
                                            kg&nbsp;<br></span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-clipboard fa-2x text-gray-300"
                                        style="color: rgb(51,149,255);"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-left-info py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span>năm /
                                            tuổi</span></div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="text-dark font-weight-bold h5 mb-0 mr-3" id="old"><span>000
                                                    tuổi</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto"><i class="far fa-id-card fa-2x text-gray-300"
                                        style="color: rgb(51,149,255);"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-left-warning py-2">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col mr-2">
                                    <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>giới
                                            tính</span></div>
                                    <div class="text-dark font-weight-bold h5 mb-0" id="sex"><span>NULL</span></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-venus-mars fa-2x text-gray-300"
                                        style="color: rgb(51,149,255);"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid" id="chart-camera">
            <div class="row" id="row">
                <div class="col-sm-12 col-lg-6" id="chart">
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="text-primary font-weight-bold m-0">Biểu đồ :</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-area" style="height: 322px;"></div>
                        </div><button class="btn btn-primary" type="button">Save file ...</button>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6" id="camera">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="text-primary font-weight-bold m-0">Nội soi tai mũi họng :</h6>
                        </div>
                        <div class="card-body"><iframe allowfullscreen="" frameborder="0" width="560"
                                height="315"></iframe></div>
                        <div class="btn-group" role="group"><button class="btn btn-primary" type="button"
                                style="margin-right: 1px;"><i class="fas fa-chevron-left"
                                    style="font-size: 20px;"></i></button><button class="btn btn-primary" type="button"
                                style="margin-left: 1px;"><i class="fa fa-chevron-right"
                                    style="font-size: 20px;"></i></button></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid" id="donthuoc" >
            <div class="card" style="margin-top: 15px ; ">
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

                            <tbody id="list_data_thuoc"> </tbody>

                        </table>
                    </div>
                </div><button class="btn btn-primary" type="button">In đơn thuốc</button>
            </div>
        </div>

        <div class="container-fluid" id="info-doctor" style="margin-top: 20px" >
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary font-weight-bold m-0">Thông tin bác sỹ :</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 d-xl-flex justify-content-xl-center"><img class="img-thumbnail"
                                src="user_asset/assets/img/DR-GEORGES-(2).png"></div>
                        <div class="col-sm-8">
                            <h4><strong>Bác sĩ Armando Librino M.D.</strong><br></h4>
                            <p class="title"><strong>Chuyên Khoa -&nbsp;</strong>Khoa Tim Mạch &amp; Tim mạch can
                                thiệp<br></p>
                            <p class="title"><strong>Ngôn Ngữ -&nbsp;</strong>Tiếng Anh&nbsp;Tiếng Pháp&nbsp;Tiếng
                                Việt<br></p>
                            <h6 class="text-muted mb-2">Chứng chỉ</h6>
                            <p class="description"><strong>Trường đại học Y khoa&nbsp;</strong><br>&nbsp;- 1998: Bác Sĩ
                                Y khoa, Trường Đại Học Y Hà nội, Hà Nội, Việt Nam.<br><strong>Chứng chỉ sau đại
                                    học:</strong><br>- 1998-2002: Bác sĩ nội trú bệnh viện, Hồi sức cấp cứu, Đại
                                học Y Hà Nội, Việt Nam.2002:<br><br></p>
                            <p class="description"><strong>Chương trình đào tạo:&nbsp;</strong><br>- 2002: Cấp cứu cơ
                                bản- Đại học Nantes – Pháp<br>- 2006: Hồi sức tim mạch - Đại học Clermont Ferrand – CH
                                Pháp<br>- 2007: Thở máy trong hồi sức – ChiengMai-Thailand<br>- 2008:
                                Thực tập tim mạch nhi khoa – Đại học Melbourne - Australia<br>- 2004: Siêu âm tim mạch
                                cơ bản – Viện tim mạch Việt nam<br>- 2008-2015: Tiến sĩ nội tim mạch, Học viện quân Y;
                                đề tài: Đánh giá hiệ<br><br></p>
                            {{-- <button class="btn btn-primary"type="button">Đăt lịch khám bệnh&nbsp;</button> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="border rounded" class="rounded"
            style="background-color: #007bff;color: rgb(255,255,255);font-size: 16px;margin: 0px;margin-top: 15px;padding-bottom: 0px;margin-bottom: 15px;">
            <h2 class="text-center" style="padding-top: 0px;padding-right: 0px;padding-bottom: 40px;"><br>Gọi chúng tôi
                :<br>(84-24) 000 000 000<br></h2>
        </footer>

    </div>

    <script src="user_asset/assets/js/jquery.min.js"></script>
    <script src="user_asset/assets/js/jquery.cookie.js"></script>
    <script src="user_asset/assets/bootstrap/js/bootstrap.min.js"></script>

    {{-- <script src="user_asset/assets/js/chart.min.js"></script> --}}
    {{-- <script src="user_asset/assets/js/bs-init.js"></script> --}}

    <script src="user_asset/assets/js/untitled.js"></script>


</body>

</html>


@endsection
