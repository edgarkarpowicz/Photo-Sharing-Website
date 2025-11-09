<?php 
$servername = "localhost"; // or the server address provided by your web host
$username = "picify_db_editor"; // your database username
$password = "#Ek11Mn35Gr06#"; // your database password
$database = "picify_new_final_database"; // your database name

$conn = new mysqli($servername, $username, $password, $database);

if(mysqli_connect_errno()) 
{
    echo "Fallo intentando conectarse " . mysqli_connect_error();
    exit();
    die();
}

?>

<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>AdminLTE v4 | Dashboard</title><!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="AdminLTE v4 | Dashboard">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"><!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="css/adminlte.css"><!--end::Required Plugin(AdminLTE)--><!-- apexcharts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous"><!-- jsvectormap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">
</head> <!--end::Head--> <!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="index.html" class="brand-link"> <!--begin::Brand Image--> <img src="assets/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> <span class="brand-text fw-light">AdminLTE 4</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
                </ul> <!--end::Start Navbar Links--> <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto"> <!--begin::Navbar Search-->
                    <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> <img src="assets/small_perfil.png" class="user-image rounded-circle shadow" alt="User Image"> <span class="d-none d-md-inline">FOTOVERSO - Administración</span> </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <!--begin::User Image-->
                            <li class="user-header text-bg-primary"> <img src="assets/small_perfil.png" class="rounded-circle shadow" alt="User Image">
                                <p>
                                    FOTOVERSO - Administración
                                    <small>Equipo de Administración</small>
                                </p>
                            </li> <!--end::User Image--> <!--begin::Menu Body-->
                        </ul>
                    </li> <!--end::User Menu Dropdown-->
                </ul> <!--end::End Navbar Links-->
            </div> <!--end::Container-->
        </nav> <!--end::Header--> <!--begin::Sidebar-->
        <main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Dashboard - Administrativo</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item active" aria-current="page">
                                    Datos Estadísticos
                                </li>
                            </ol>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div> <!--end::App Content Header--> <!--begin::App Content-->
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row"> <!--begin::Col-->
                        <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 1-->
                            <div class="small-box text-bg-primary">
                                <div class="inner">

                                    <?php 
                                        $result = mysqli_query($conn , "CALL GET_NUMBER_OF_USERS()");
                                        $array = mysqli_fetch_array($result);
                                        $totalUsers = $array['COUNT(*)'];
                                        $conn->next_result();

                                        echo " <h3> {$totalUsers} </h3> ";
                                    ?>

                                    <p>Usuarios Activos</p>
                                </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"></path>
                                </svg> <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"> </a>
                            </div> <!--end::Small Box Widget 1-->
                        </div> <!--end::Col-->
                        <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 2-->
                            <div class="small-box text-bg-success">
                                <div class="inner">

                                    <?php
                                        $result = mysqli_query($conn, "CALL GET_NUMBER_OF_GALLERIES()");
                                        $array = mysqli_fetch_array($result);
                                        $totalGalleries = $array['COUNT(*)'];
                                        $conn->next_result();

                                        echo " <h3> {$totalGalleries} </h3>";
                                    ?>

                                    <p>Cantidad de Galerías</p>
                                </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"></path>
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"></path>
                                </svg> <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"> </a>
                            </div> <!--end::Small Box Widget 2-->
                        </div> <!--end::Col-->
                        <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 3-->
                            <div class="small-box text-bg-warning">
                                <div class="inner">

                                    <?php
                                        $result = mysqli_query($conn, "CALL FOTOS_SUBIDAS_HOY()");
                                        $array = mysqli_fetch_array($result);
                                        $uploadedPicturesToday = $array['Hoy'];
                                        $conn->next_result();

                                        echo " <h3> {$uploadedPicturesToday} </h3>";
                                    ?>

                                    <p>Fotos subidas en el Día</p>
                                </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z"></path>
                                </svg> <a href="#" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover"> </a>
                            </div> <!--end::Small Box Widget 3-->
                        </div> <!--end::Col-->
                        <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 4-->
                            <div class="small-box text-bg-danger">
                                <div class="inner">

                                    <?php
                                        $result = mysqli_query($conn, "CALL FOTOS_SUBIDAS_MES()");
                                        $array = mysqli_fetch_array($result);
                                        $picturesMonth = $array[1];
                                        $conn->next_result();

                                        echo " <h3> {$picturesMonth} </h3>";
                                    ?>

                                    <p>Fotos subidas en el Mes</p>
                                </div> <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z"></path>
                                </svg> <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"> </a>
                            </div> <!--end::Small Box Widget 4-->
                        </div> <!--end::Col-->
                    </div> <!--end::Row--> <!--begin::Row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h3 class="card-title">Categorías más Populares </h3>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-sml">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Categoría</th>
                                                <th>Porcentaje</th>
                                                <th style="width: 40px">Cantidad</th>
                                            </tr>
                                        </thead>

                                        <?php
                                            $result = mysqli_query($conn, "CALL GET_MOST_POPULAR_CATEGORY()");
                                            $temp_storage_categorias = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                            $conn->next_result();

                                            $categoriasNombre = [];
                                            $categoriasCantidad = [];
                                            $categoriasID = [];
                                            $categoriasPorcentaje = [];
                                            $i = 0;
                                            
                                            $result = mysqli_query($conn, "CALL TOTAL_FOTOS()");
                                            $temp_total_fotos = mysqli_fetch_array($result);
                                            $conn->next_result();

                                            $totalFotos = $temp_total_fotos['NumeroFotos'];

                                            foreach($temp_storage_categorias as $categorias) 
                                            {
                                                $categoriasID[$i] = $categorias['ID_Categoria'];
                                                $categoriasCantidad[$i] = $categorias['CategoriaPopular'];

                                                $nameQuery = mysqli_query($conn, "CALL GET_CATEGORIA({$categoriasID[$i]})");
                                                $nameStorage = mysqli_fetch_array($nameQuery);
                                                $categoriasNombre[$i] = $nameStorage['Nombre'];
                                                $conn->next_result();

                                                $categoriasPorcentaje[$i] = (($categoriasCantidad[$i] * 100) / $totalFotos);
                                                
                                                $i++;

                                                if ($i == 6) {
                                                    break;
                                                }
                                            }

                                            if ($i != 6) {
                                                while ($i != 6) {
                                                    $categoriasNombre[$i] = "N/A";
                                                    $categoriasCantidad[$i] = 0;
                                                    $categoriasID[$i] = 0;
                                                    $i++;
                                                }
                                            }

                                            echo "
                                                                                    <tbody>
                                            <tr class='align-middle'>
                                                <td>1.</td>
                                                <td> {$categoriasNombre[0]} </td>
                                                <td>
                                                    <div class='progress progress-xs'>
                                                        <div class='progress-bar progress-bar-danger' style='width: {$categoriasPorcentaje[0]}%'></div>
                                                    </div>
                                                </td>
                                                <td><span class='badge text-bg-danger'> {$categoriasCantidad[0]} </span></td>
                                            </tr>
                                            <tr class='align-middle'>
                                                <td>2.</td>
                                                <td> {$categoriasNombre[1]} </td>
                                                <td>
                                                    <div class='progress progress-xs'>
                                                        <div class='progress-bar text-bg-warning' style='width: {$categoriasPorcentaje[1]}%'></div>
                                                    </div>
                                                </td>
                                                <td> <span class='badge text-bg-warning'> {$categoriasCantidad[1]} </span> </td>
                                            </tr>
                                            <tr class='align-middle'>
                                                <td>3.</td>
                                                <td> {$categoriasNombre[2]} </td>
                                                <td>
                                                    <div class='progress progress-xs progress-striped active'>
                                                        <div class='progress-bar text-bg-primary' style='width: {$categoriasPorcentaje[2]}%'></div>
                                                    </div>
                                                </td>
                                                <td> <span class='badge text-bg-primary'> {$categoriasCantidad[2]} </span> </td>
                                            </tr>
                                            <tr class='align-middle'>
                                                <td>4.</td>
                                                <td> {$categoriasNombre[3]} </td>
                                                <td>
                                                    <div class='progress progress-xs progress-striped active'>
                                                        <div class='progress-bar text-bg-info' style='width: {$categoriasPorcentaje[3]}%'></div>
                                                    </div>
                                                </td>
                                                <td> <span class='badge text-bg-success'> {$categoriasCantidad[3]} </span> </td>
                                            </tr>
                                            <tr class='align-middle'>
                                                <td>5.</td>
                                                <td> {$categoriasNombre[4]} </td>
                                                <td>
                                                    <div class='progress progress-xs progress-striped active'>
                                                        <div class='progress-bar text-bg-light' style='width: {$categoriasPorcentaje[4]}%'></div>
                                                    </div>
                                                </td>
                                                <td> <span class='badge text-bg-success'> {$categoriasCantidad[4]} </span> </td>
                                            </tr>
                                            <tr class='align-middle'>
                                                <td>6.</td>
                                                <td> {$categoriasNombre[5]} </td>
                                                <td>
                                                    <div class='progress progress-xs progress-striped active'>
                                                        <div class='progress-bar text-bg-dark' style='width: {$categoriasPorcentaje[5]}%'></div>
                                                    </div>
                                                </td>
                                                <td> <span class='badge text-bg-success'> {$categoriasCantidad[5]} </span> </td>
                                            </tr>
                                        </tbody> "
                                        ?>
                                    </table>
                                </div>
                            </div> <!-- /.card-body -->
                        </div> <!-- /.col -->
                        <div class="col mb-6">
                            <div class="card mb-4">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="card-title">Comparación - Fotos en el Día y Mes </h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">

                                        <?php
                                            $monthQuery = mysqli_query($conn, "CALL FOTOS_SUBIDAS_MES()");
                                            $monthStorage = mysqli_fetch_array($monthQuery);
                                            $totalMes = $monthStorage[1];
                                            $conn->next_result();

                                            echo " <p class='d-flex flex-column'> <span class='fw-bold fs-5'> {$totalMes} </span> <span>Total en el Mes</span> </p> ";
                                        ?>

                                    </div> <!-- /.d-flex -->
                                    <div class="position-relative mb-4">
                                        <div id="sales-chart"></div>
                                    </div>
                                    <div class="d-flex flex-row justify-content-end"> <span class="me-2"> <i class="bi bi-square-fill text-primary"></i> Día
                                        </span> <span> <i class="bi bi-square-fill text" style="color: #20c997"></i> Mes
                                        </span> </div>
                                    </div>
                                </div>
                            </div> <!-- /.card -->
                        </div>
                    </div> <!--end::Row-->
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h3 class="card-title">Fotos por Países</h3>
                                </div> <!-- /.card-header -->
                                <div class="card-body"> <!--begin::Row-->
                                    <div class="row">
                                        <div class="col-12">
                                            <div id="pie-chart"></div>
                                        </div> <!-- /.col -->
                                    </div> <!--end::Row-->
                                </div> <!-- /.card-body -->
                                <div class="card-footer p-0">
                                    <ul class="nav nav-pills flex-column">
                                        <?php
                                            $countryQuery = mysqli_query($conn, "CALL GET_MOST_POPULAR_COUNTRIES()");
                                            $countryStorage = mysqli_fetch_all($countryQuery, MYSQLI_ASSOC);
                                            $conn->next_result();

                                            $labels = [];
                                            $series = [];
                                            $i = 0;
                                            
                                            foreach ($countryStorage as $countries) {
                                                $labels[] = $countries['Country'];
                                                $series[] = (int)$countries['CountryPopular'];
                                                $i++;

                                                if ($i == 3) {
                                                    break;
                                                }
                                            }

                                            if ($i != 3) {
                                                while ($i != 3) {
                                                    $labels[$i] = "N/A";
                                                    $series[$i] = 0;
                                                    $i++;
                                                }
                                            }

                                            echo 
                                            "
                                            <li class='nav-item'> <a href='#' class='nav-link'>
                                                {$labels[0]}
                                                <span class='float-end text-danger'>
                                                    {$series[0]}
                                                </span> </a> </li>
                                            <li class='nav-item'> <a href='#' class='nav-link'>
                                                {$labels[1]}
                                                <span class='float-end text-success'> 
                                                {$series[1]}
                                                </span> </a> </li>
                                            <li class='nav-item'> <a href='#' class='nav-link'>
                                                {$labels[2]}
                                                <span class='float-end text-info'>
                                                {$series[2]}
                                                </span> </a> </li>
                                            ";
                                        ?>
                                    </ul>
                                </div> <!-- /.footer -->
                            </div> <!-- /.card --> <!-- PRODUCT LIST -->
                        </div> 
                    </div>
                </div> <!--end::Container-->
            </div> <!--end::App Content-->
        </main> <!--end::App Main--> <!--begin::Footer-->
        <footer class="app-footer"> <!--begin::To the end-->
            <strong>
                Copyright &copy; 2014-2024&nbsp;
                <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
            </strong>
            All rights reserved.
            <!--end::Copyright-->
        </footer> <!--end::Footer-->
    </div> <!--end::App Wrapper--> <!--begin::Script--> <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
        const Default = {
            scrollbarTheme: "os-theme-light",
            scrollbarAutoHide: "leave",
            scrollbarClickScroll: true,
        };
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (
                sidebarWrapper &&
                typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script> <!--end::OverlayScrollbars Configure--> <!-- OPTIONAL SCRIPTS --> <!-- sortablejs -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"> </script>
    <script>

        // Columnas - Fotos en el Día y Mes //

        <?php 
            $monthQuery = mysqli_query($conn, "CALL FOTOS_SUBIDAS_MES()");
            $monthStorage = mysqli_fetch_array($monthQuery);
            $totalMes = $monthStorage[1];
            $conn->next_result();

            $dayQuery = mysqli_query($conn, "CALL FOTOS_SUBIDAS_HOY()");
            $dayStorage = mysqli_fetch_array($dayQuery);
            $totalDia = $dayStorage[0];
            $conn->next_result();

            echo 
            "
                    const sales_chart_options = {
            series: [{
                    name: 'Día',
                    data: [{$totalDia}],
                },
                {
                    name: 'Mes',
                    data: [$totalMes],
                },
            ],
            chart: {
                type: 'bar',
                height: 200,
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded',
                },
            },
            legend: {
                show: false,
            },
            colors: ['#0d6efd', '#20c997'],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent'],
            },
            xaxis: {
                categories: [
                    'Fotos Subidas',
                ],
            },
            fill: {
                opacity: 1,
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + ' fotos';
                    },
                },
            },
        };";
        ?>

        const sales_chart = new ApexCharts(
            document.querySelector("#sales-chart"),
            sales_chart_options
        );
        sales_chart.render();

        // Torta - Países por Fotos //

        <?php 
            $countryQuery = mysqli_query($conn, "CALL GET_MOST_POPULAR_COUNTRIES()");
            $countryStorage = mysqli_fetch_all($countryQuery, MYSQLI_ASSOC);
            $conn->next_result();

            $labels = [];
            $series = [];
            
            foreach ($countryStorage as $countries) {
                $labels[] = $countries['Country'];
                $series[] = (int)$countries['CountryPopular']; // Ensure numeric values
            }

            $labels_json = json_encode($labels);
            $series_json = json_encode($series);

            $colors = [];
            $base_colors = ['#0d6efd', '#20c997', '#ffc107', '#d63384', '#6f42c1', '#adb5bd'];
            foreach ($labels as $index => $label) {
                $colors[] = $base_colors[$index % count($base_colors)]; // Cycle through base colors
            }
            $colors_json = json_encode($colors);
        ?>

        const labels = <?php echo $labels_json; ?>;
        const series = <?php echo $series_json; ?>;
        const colors = <?php echo $colors_json; ?>;

        const pie_chart_options = {
            series: series,
            chart: {
                type: "donut",
            },
            labels: labels,
            dataLabels: {
            enabled: false,
            },
        colors: colors,
        };

        const pie_chart = new ApexCharts(
            document.querySelector("#pie-chart"),
            pie_chart_options,
        );
        pie_chart.render();
    </script>
</body><!--end::Body-->
</html>