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
    <div class="container shadow-lg" id="main" style="margin-top: 30px; font-size: 16px;">

        <nav class="navbar navbar-light navbar-expand-md" id="home"
            style="padding-right: 0px;padding-left: 0px;padding-bottom: 0px;padding-top: 20px;">
            <div class="container-fluid">
                <div id="home-user-id">
                    <h3 style="color: rgb(0,123,255);"><i class="fas fa-user-md" style="font-size: 50px;"></i>&nbsp;Home - Healthcare : CustomerID&nbsp;</h3>
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

        <div class="container">
            <!-- Nav tabs -->
            <ul id="nav_tab" class="nav nav-tabs" style="font-size: 20px; margin-top: 20px;"  >
                
                <li id="hometab" class="nav-item"> 
                    <a class="nav-link active" href="#" data-toggle="tab" style="color: rgb(0,123,255);" onclick="Roottab()">User</a> 
                </li>

                <li class="nav-item" onclick="creattab()"> 
                    <a class="nav-link" data-toggle="tab"  >+</a> 
                </li>
            
            </ul>
        
        </div>

        <div id="tab-creat" class="container-fluid"  style="margin-top: 20px" >

        </div>

        <div id="tab-main" class="container-fluid" style="margin-top: 20px" >

        </div>

        <div class="container-fluid" id="info-doctor" style="margin-top: 20px" >
            {{-- <div class="card">
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
                            <button class="btn btn-primary"type="button">Đăt lịch khám bệnh&nbsp;</button>
                        </div>
                    </div>
                </div>
            </div> --}}
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
    <script src="user_asset/assets/js/untitled.js"></script>

</body>

</html>


@endsection