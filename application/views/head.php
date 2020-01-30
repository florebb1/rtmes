<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>덴탈랩</title>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo $base_url;?>plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo $base_url;?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo $base_url;?>plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo $base_url;?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $base_url;?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo $base_url;?>dist/css/common.css?ver=<?php echo rand();?>">
  
     
        <!-- REQUIRED SCRIPTS -->
        
        <!-- jQuery -->
        <script src="<?php echo $base_url;?>plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo $base_url;?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE -->
        <script src="<?php echo $base_url;?>dist/js/adminlte.js"></script>
        
        <!-- OPTIONAL SCRIPTS -->
        <?php /*?><script src="<?php echo $base_url;?>plugins/chart.js/Chart.min.js"></script>
        <script src="<?php echo $base_url;?>dist/js/demo.js"></script>
        <script src="<?php echo $base_url;?>dist/js/pages/dashboard3.js"></script><?php */?>
  
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo $base_url;?>" class="nav-link">Home</a>
      </li>
 
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="검색" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link text-center">
      <span class="brand-text font-weight-light">업체명</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           <?php for($i=0; $i<count($menus); $i++){?>
           <li class="nav-item has-treeview <?if($menus[$i]["menu_id"] == $parent_menu)echo "menu-open active "?>">
           		 <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p><?php echo $menus[$i]["name"]; ?>
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <?php if(count($menus[$i]["sub"]) > 0){?>
                <ul class="nav nav-treeview ">
                <?php for($j=0; $j<count($menus[$i]["sub"]); $j++){?>
                <li class="nav-item ">
                    <a href="<?php echo $menus[$i]["sub"][$j]["url"]; ?>" class="nav-link <?if($menus[$i]["sub"][$j]["menu_id"] == $menu) echo "active"?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p><?php echo $menus[$i]["sub"][$j]["name"];?></p>
                    </a>
                 </li>
                <?php }?>
                </ul>
                <?php }?>
           </li>
           <?php }?>   
           <?php /*?> 
          <li class="nav-item has-treeview <?if($menu == "info")echo "menu-open"?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>기준정보 관리
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/info/customer" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>고객사 정보</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/info/purchase" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>매입처 정보</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/info/item" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>품목정보</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/info/process" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>공정 정보</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/info/processitem" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>품목별 공정 정보</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/info/processdefect" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>공정 불량 정보</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/info/standardprice" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>표준 단가 정보</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/info/standardnumber" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>표준 수가 정보</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/info/employee" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>사원 정보</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/info/business" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>사업장 정보</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?if($menu == "material")echo "menu-open"?>">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>자재 관리
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/material/material" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>자재 등록</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/material/purchase" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>입고 관리</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/material/forwarding" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>출고 관리</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/material/stock" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>재고 현황</p>
                </a>
              </li>
             
            </ul>
          </li>
          <li class="nav-item has-treeview <?if($menu == "facilities")echo "menu-open"?>">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>설비 관리
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview ">
              <li class="nav-item ">
                <a href="/facilities/facilities" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>설비 등록/설정</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/facilities/purchase" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>설비 작업 현황</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/facilities/performance" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>설비 가동 실적</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/facilities/record" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>설비 보전 이력</p>
                </a>
              </li>
             
            </ul>
          </li>
          <li class="nav-item has-treeview <?if($menu == "process")echo "menu-open"?>">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>공정 관리
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/process/processsetting" class="nav-link"> 
                  <i class="far fa-circle nav-icon"></i>
                  <p>공정 설정</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/process/processefficiency" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>공정 효율 관리</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/process/processprovision" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>공정 제공 관리</p>
                </a>
              </li>
             
            </ul>
          </li>
          <li class="nav-item has-treeview <?if($menu == "item")echo "menu-open"?>">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>제품 관리
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/item/reception" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>접수 관리</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/item/lot" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>로트 관리</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item has-treeview <?if($menu == "production")echo "menu-open"?>">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>생산 관리
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/production/plan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>생산계획</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/production/order" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>작업 지시</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/production/performance" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>생산 실적 내역</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/production/report" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>생산 일보 관리</p>
                </a>
              </li>
             
            </ul>
          </li>
          <li class="nav-item has-treeview <?if($menu == "quality")echo "menu-open"?>">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>품질 관리
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/quality/defect" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>공정 불량 관리</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/quality/claim" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>클레임 관리</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/quality/remake" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>리메이크 관리</p>
                </a>
              </li>
             
            </ul>
          </li>
          <li class="nav-item has-treeview <?if($menu == "monitoring")echo "menu-open"?>">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>모니터링
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/monitoring/work" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>실시간 작업 현황</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/monitoring/process" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>실시간 공정 생산 등록</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?if($menu == "statistics")echo "menu-open"?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>통계 분석
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/statistics/defect" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>제조 불량률</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/statistics/time" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>제조 시간</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/statistics/reception" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>접수 현황</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/statistics/sales" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>매출 현황</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/statistics/request" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>의뢰 분류 추이</p>
                </a>
              </li>
            </ul>
          </li>
          <?php */?>  
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $title;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $title;?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
        <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
  
  