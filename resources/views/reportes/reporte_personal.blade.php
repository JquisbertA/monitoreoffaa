<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/dgae_logo.png"> 
    <title>DATOS PERSONAL</title>
    
    <!-- CSS only -->
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> --}}
    <style>
        @page{
            /*margin: 0rem;
            margin-top:0rem;
            padding: 1rem;*/
            margin: 0cm 0cm;
        }
        body {
            /*margin: 0px;*/
            margin-top: 2cm;
            margin-bottom: 2cm;
            /** margenes de izquierda y derecha es menos un cm*/
            margin-left: 3cm;
            margin-right: 2cm;
            /* border: 1px solid #C00; */
        }
        header {
            position: fixed;
            top: 0cm;
            left: 3cm;
            right:2cm;
            height: 3cm;
            /*background-color: #3498DB;*/
            color: black;
            text-align: right;
            /*line-height: 10px;
            font-size: 9px;
            border: 1px solid #C00;*/
            padding-top: 5px;
            padding-bottom: 0px;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 3cm;
            right: 2cm;
            height: 2cm;
            /*background-color: #3498DB;*/
            color: black;
            /*text-align: right;*/
            line-height: 24px;
            /*font-size: 9px;*/
            /* border: 1px solid #C00; */
        }

        * {
            font-family: verdana, arial, sans-serif;
        }
    </style>

</head>
<body>

<header>        
    <!-- <div style="padding-top: 22px; padding-bottom: 1px;">
        <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/margin-bottom: 0px; " class="table table-bordered table-striped">
            <tbody class="table-striped">
                <tr>
                    <td style="/*border: 1px solid #000;*/ vertical-align: bottom;">
                        <div style="text-align: center; width: 230px; font-size: 11.5px; /*border: 1px solid #C00;*/">
                            <p style="margin: 1px;">FUERZA AÉREA BOLIVIANA</p>
                            <p style="margin: 1px;">DIRECCIÓN GENERAL DE AERONAVES DE ESTADO</p>
                            <p style="margin: 1px;"><u><strong>BOLIVIA</strong></u></p>
                        </div>
                    </td>
                    
                </tr>  
            </tbody>
        </table>
    </div> -->
</header> 

<footer>
    <div>
        <table width="100%" style="border-collapse: collapse; 
            border-spacing: 0; 
            /* border: black 1px; */
            margin-bottom: 5px;" class="table table-bordered table-striped">
            <tbody class="table-striped">
                <tr>
                    <td style="/*border: 1px solid #000;*/ padding-top: 25px; padding-bottom: 25px; font-size: 10px; text-align: left; font-weight: bold;">
                        <span>Fecha de Emisión: 
                            <?php
                                $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
                                $fecha = date('dHi')."-".$meses[date('n')-1]."-".date('Y');
                                echo $fecha;
                            ?>
                        </span>
                    </td>
                    <td style="/*border: 1px solid #000;*/ padding: 0px; font-size: 10px; text-align: right; font-weight: bold;">
                        <span>CEO "CIBERDEFENSA" - 
                            <?php
                                $gestion_act = date("Y");
                                echo $gestion_act;
                            ?>
                        </span>
                    </td>
                </tr>  
            </tbody>
        </table>
    </div>
</footer>
    <main>  
    
        <div class="cabecera">
            <div style="padding-top: 0px; padding-bottom: 1cm;">
                <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/ margin-bottom: 0px; " class="table table-bordered table-striped">
                    <tbody class="table-striped">
                        <tr>
                            <td style="/*border: 1px solid #000;*/ vertical-align: top;">
                                <div style="text-align: center; width: 325px; font-size: 10pt;">
                                    <p style="margin: 1px; /*border: 1px solid #000;*/">COMANDO EN JEFE DE LAS FF. AA. DEL ESTADO</p>
                                    <p style="margin: 1px; /*border: 1px solid #000;*/">CEO. "CIBERDEFENSA"</p>
                                    <p style="margin: 1px; /*border: 1px solid #000;*/"><u><strong>BOLIVIA</strong></u></p>
                                </div>
                            </td>
                            
                        </tr>  
                    </tbody>
                </table>
            </div>


            <div style="padding-top: 10px; padding-bottom: 10px; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">EL COMANDANTE DEL CEO. "CIBERDEFENSA" CERTIFICA:</p>
            </div>

            <!-- <div style="padding-top: 2px; padding-bottom: 2px; text-align: justify; font-size: 12pt; font-weight: bold; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">CERTIFICA:</p>
            </div> -->
            
            <div style="padding-top: 2px; padding-bottom: 10px; text-align: justify; font-size: 12pt; font-weight: normal; /*border: 1px solid #C00;*/">   
                    <p style="margin: 1px">Qué, revisada la documentación existente en este Comando, se establece que el Señor(a):</p>
            </div>
                
            <div>
                <table width="100%" style="border-collapse: collapse; border-spacing: 0; /*border: black 1px;*/ margin-bottom: 5px;" class="table table-bordered table-striped">
                    <tbody class="table-striped">
                        <tr>
                            <td width="45%" style="/*border: 1px solid #000;*/ padding: 1px; font-size: 12pt; text-align: right;">
                                <span>
                                    <p style="margin: 1px; font-weight: bold; /*border: 1px solid #000;*/">GRADO:</p>
                                    <p style="margin: 1px; font-weight: bold; /*border: 1px solid #000;*/">APELLIDO(S):</p>
                                    <p style="margin: 1px; font-weight: bold; /*border: 1px solid #000;*/">NOMBRE(S):</p>
                                    <p style="margin: 1px; font-weight: bold; /*border: 1px solid #000;*/">CEDULA DE IDENTIDAD:</p>
                                    <p style="margin: 1px; font-weight: bold; /*border: 1px solid #000;*/">CARNET MILITAR:</p>

                                </span>
                            </td>
                            <td width="55%" style="/*border: 1px solid #000;*/ padding: 1px; font-size: 12pt; text-align: left;">
                                <span>
                                    <p style="margin: 1px; /*font-weight: bold;*/ /*border: 1px solid #000;*/"> {{$personal->abreviatura}}</p>
                                    <p style="margin: 1px; /*font-weight: bold;*/ /*border: 1px solid #000;*/"> {{$personal->ap_paterno}} {{$personal->ap_materno}}</p>
                                    <p style="margin: 1px; /*font-weight: bold;*/ /*border: 1px solid #000;*/"> {{$personal->nombre}}</p>
                                    <p style="margin: 1px; /*font-weight: bold;*/ /*border: 1px solid #000;*/"> {{$personal->ci}}</p>
                                    <p style="margin: 1px; /*font-weight: bold;*/ /*border: 1px solid #000;*/"> {{$personal->cm}}</p>
                                </span>
                            </td>
                        </tr> 
                    </tbody>
                </table>
            </div>

            <div style="padding-top: 10px; padding-bottom: 10px; text-align: justify; font-size: 12pt; font-weight: normal; /*border: 1px solid #C00;*/">
                <p style="margin: 1px">Es cuanto tengo a bien certificar, para los fines consiguientes.</p>
            </div>

            <div style="padding-top: 1px; padding-bottom: 1px; text-align: right; font-size: 12pt; font-weight: normal; /*border: 1px solid #C00;*/">
                La Paz, 
                    <?php
                        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                        echo date('d')." de ".$meses[date('n')-1]." del ".date('Y');
                    ?>
            </div>

            <div style="padding-top: 3cm; padding-bottom: 0px; text-align: center; /*position: fixed; bottom: 2cm; left: 3cm; right: 2cm;*/ /*font-size: 14px; font-weight: bold;*/ /*border: 1px solid #C00;*/">
                <p style="margin: 1px; font-size: 12pt;">My. DIM. Ebert Richard Villarroel Casas</p>
                <p style="margin: 1px; font-size: 12pt; font-weight: bold;">COMANDANTE ACC. DEL CEO. "CIBERDEFENSA"</p>
            </div>
        </div>
    </main>
    
    <script type="text/php">
            if(isset($pdf)) {
                $pdf->page_script('
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $pdf->text(310, 760, "$PAGE_NUM - $PAGE_COUNT", $font, 9);
                ');
            }
    </script>

</body>

</html>
