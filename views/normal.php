<?php
session_start();
if(!isset($_SESSION['ID'])){
  header("Location:../../../index.php");
}
 $Id_User=$_SESSION['ID'];

			$filtro=$_POST['matricula'];
			$id_alumnos=$_POST['id_alumnos'];
			$nombre=$_POST['nombre'];
			$num=$_POST['num'];

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alumnos</title>

    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/datepicker3.css" rel="stylesheet">
    <link href="../../css/bootstrap-table.css" rel="stylesheet">
    <link href="../../css/styles.css" rel="stylesheet">

    <!--Icons-->
    <script src="../../js/lumino.glyphs.js"></script>

    <script>
        function printlayer(layer) {
            var generator = window.open(",'name,");
            var layertext = document.getElementById(layer);
            generator.document.write(layertext.innerHTML.replace("Print Me"));
            generator.document.close();
            generator.print();
            generator.close();
        }
    </script>

</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php"><span>Sistema</span>escolar</a>
                <ul class="user-menu">
                    <li class="dropdown pull-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user">
                                <use xlink:href="#stroked-male-user"></use>
                            </svg> Usuario<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="../../../Login/logout.php"><svg class="glyph stroked cancel"
                                        <?php echo $_SESSION['ID']; ?>>
                                        <use xlink:href="#stroked-cancel"></use>
                                    </svg>Cerrar Sesion</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div><!-- /.container-fluid -->
    </nav>
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <form role="search">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Buscar">
            </div>
        </form>
        <ul class="nav menu">
            <li><a href="../../views_admin/view_alumnos.php"><svg class="glyph stroked arrow left">
                        <use xlink:href="#stroked-arrow-left" /></svg> Menu</a></li>
            <li> <a href="#" id="Imprimir" onclick="javascript:printlayer('div-id-name')"><svg
                        class="glyph stroked app-window">
                        <use xlink:href="#stroked-app-window"></use>
                    </svg>Imprimir</a></li>
            <div class="alert alert-info" role="alert">Para editar las Calificaciones, solo da Clic en la calificación
                que desees editar</div>
        </ul>
    </div>
    <!--/.sidebar-->
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" id="div-id-name">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">BOLETA DE CALIFICACIONES</div>
                    <div class="panel-body">
                        <div class="panel-heading">Nombre del Alumno: <?php echo $nombre;?></div>
                        <div class="panel-heading">Matricula: <?php echo $num;?></div>
                        <?php
                        $Id_User;
                        include_once 'CalsseCalificaciones.php';
                        $periodos = new CalsseCalificaciones();
                        $perio=$periodos->get_periodos($id_alumnos);
                         while($pe = $perio->fetchObject()){
                            echo"Periodo: ".$pe->periodoescolar." año ".$pe->anio;
                            $idciclo=$pe->idperiodos;
                            $Calificacion_minima=$pe->Calificacion;  
                           ?>
                        <table class="table" border="1">
                            <tr>
                                <th>Grupos</th>
                                <th> Calificaciones</th>
                            </tr>
                            <?php
                             $grupo = new CalsseCalificaciones();
                             $grup=$grupo->get_grupo($filtro,$pe->idperiodos);
                             while($g = $grup->fetchObject()){
                             ?>
                            <tr>
                                <td><?php echo "$g->grupo"; echo"<br> ";echo "$g->tipodegrupo";  ?> </td>
                                <td>
                                    <table class="table">
                                        <?php
                                         include_once 'CalsseCalificaciones.php';
                                         $usu1 = new CalsseCalificaciones();
                                         $datos=$usu1->get_buscali($filtro,$g->idgrupos);
                                         ?>
                                        <tr>
                                            <th>Materias</th>
                                            <?php
                                             $parcial = new CalsseCalificaciones();
                                             $par=$parcial->get_parcial($Id_User);
                                              while($p = $par->fetchObject()){
                                             ?>
                                            <th><?php echo $p->parcialcol." ".$p->porcentage."%"; ?></th>
                                            <?php  } ?>
                                            <th>Final</th>
                                        </tr>
                                        <?php
                                        while($fila = $datos->fetchObject()){
		                                ?>
                                        <tr>
                                            <td><?php echo "$fila->materia";  ?></td>
                                             <?php 
                                             $valor_porcentual=0;
                                             $num_parciales=0; 
                                             
                                             $calificacion_final_porcentajes=0;
                                             $calificacion_final=0;

									         $parcia = new CalsseCalificaciones();
                                             $pa=$parcia->get_parcial($Id_User);
                                             while($pu = $pa->fetchObject()){
                                           
									         ?>
                                            <td>
                                                <?php								
									             $valor_porcentual=($pu->porcentage/100);
									             $valor_real_calificacion=0;

                                                $calificacion = new CalsseCalificaciones(); 
                                                $cali=$calificacion->get_calificacion( $fila->idmaterias,$pu->idparcial,$fila->alumnos_idalumnos,$idciclo);	 

                                                while($c = $cali->fetchObject()){
                                                echo"<a href='edit_cali.php?id=".$c->idcalificaciones."&calificacion=".$c->calificacion."'>
                                                    <span class='label label-info'>".$c->calificacion."</span>
                                                    </a>";    
    
                                                          if($valor_porcentual<>0){
                                                            $valor_real_calificacion=$c->calificacion*$valor_porcentual;
                                                          }else{
                                                            $valor_real_calificacion=$c->calificacion;
                                                          }    
                                                      } 

                                                      if($valor_real_calificacion<>0){
                                                          $num_parciales=$num_parciales + 1;
                                                      }

                                                       if($valor_porcentual<>0){
                                                        $calificacion_final_porcentajes=$calificacion_final_porcentajes+$valor_real_calificacion;
                                                       }else{
                                                        $calificacion_final=$calificacion_final+$valor_real_calificacion;
                                                       }

                                                    ?>
                                            </td>
                                            <?php
                                              } 
									         ?>
                                            <td>
                                                <?php
                                                        if($calificacion_final_porcentajes<>0){
                                                            if($Calificacion_minima>$calificacion_final_porcentajes){
                                                                echo "<span class='label label-danger'>".number_format($calificacion_final_porcentajes, 2, ",", ".")."</span>";  
                                                             }else{
                                                                echo "<span class='label label-primary'>".number_format($calificacion_final_porcentajes, 2, ",", ".")."</span>";  
                                                             }
                                                           
                                                        }else{

                                                            if($Calificacion_minima>($calificacion_final/$num_parciales)){
                                                                echo "<span class='label label-danger'>".number_format(($calificacion_final/$num_parciales), 2, ",", ".")."</span>";  
                                                             }else{
                                                                echo "<span class='label label-primary'>".number_format(($calificacion_final/$num_parciales), 2, ",", ".")."</span>";  
                                                             } 
                                                        }
                                                    

                                                ?>
                                            </td>
                                        </tr>
                                        <?php
									    }
									   ?>
                                    </table>

                                </td>
                            </tr>
                            <?php
                              }
                             ?>
                        </table>
                        <?php
                         }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!--/.row-->
    </div>
    <!--/.row-->

    <script src="../../js/jquery-1.11.1.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/chart.min.js"></script>
    <script src="../../js/bootstrap-table.js"></script>
</body>
</html>

