<?php
include_once"header.php";
include_once '../Proyectos/Classe.php';
?> 
<div class="row" id="main" >
<div class="col-md-12">
            <div class="card">
              <div class="card-header">
              <form class="form-inline" action="." method="GET">
              <div class="form-group mx-sm-3 mb-2">
               <label>GRANJA</label>
               <select class="custom-select" name="GranJ" id="inputGroupSelect01">
                <option selected></option>
                <?php
                $usGraJa = new Classe();
                $G = $usGraJa->get_Granja(null);
                while($Gr = $G->fetchObject()){
                ?>
               <option value="<?php echo trim($Gr->Granja);?>"><?php echo $Gr->Nombre;?></option>
               <?php
                }
               ?>
              </select>
              </div>
              <div class="form-group mx-sm-3 mb-2">
               <label>Año</label>
               <input type="number" name="annio" class="form-control" >
               </div>
               <div class="form-group mx-sm-3 mb-2">
               <label>Ciclo</label>
               <input type="number" name="ciclo" class="form-control" >
               </div>
               <div class="form-group mx-sm-3 mb-2">
               <label>Status</label>
               <select class="custom-select" name="status" id="inputGroupSelect01">
                <option selected></option>
               <option value="AB">Caseta Abierta</option>
                <option value="EP">En Producción</option>
               <option value="EC">En Cierre</option>
               <option value="CC">Caseta Cerrada</option>
              </select>
              </div>
              <button type="submit" class="btn btn-primary mb-2">Mostrar </button>
              </form>
              </div>             
              <div class="card-body">
              <table class="table table-bordered">
               
               <?php
               $usu1 = new Classe();
               if(isset($_GET['GranJ'])){
                 $id=$_GET['GranJ'];
                $datos = $usu1->get_Granja($id);
               }else{
                $datos = $usu1->get_Granja(null);
              
              }               
                
                while($fila = $datos->fetchObject()){
                ?>
               <tr>              
                 <td>
                    <small> 
                      <!--?php echo $fila->Granja; ?><br-->
                     <h4><?php echo $fila->Granja."". $fila->Nombre; ?></h4>                    
                    </small>
                            <!--INICIAMOS LOS MODULOS DE CADA GRANJA-->
                               <table class="table table-bordered" border="1" >                                 
                                  <?php
                                  $modu="";
                                  $modulo = new Classe();
                                  $mod = $modulo->get_Modulo($fila->Granja);
                                  while($m = $mod->fetchObject()){
                                  $modu=$m->Modulo;
                                  ?>
                                 <tr>
                                   <td>
                                       <small> 
                                       <h4>Modulo: <?php echo $m->Modulo; ?><br> </h4>                             
                                       </small>
                                   </td>
                                   <td>
                                             <!--INICIAMOS LAS CASETAS DE CADA GRANJA Y MODULO-->
                                                   <table class="table table-bordered" >                                                 
                                                     
                                                 
                                                      <?php
                                                      $casetas = new Classe();
                                                      $cas = $casetas->get_Casetas($fila->Granja,$m->Modulo);
                                                      while($c = $cas->fetchObject()){
                                                      ?>
                                                      <tr style="background-color:lightblue" >                                                  
                                                       <th colspan="6"><h4>Configuración Casetas</h4></th>
                                                     </tr>
                                                      <tr style="background-color:lightblue" >                                                  
                                                       <th ><small>Casetas</small></th>                                                      
                                                       <th><small>LlaveCart</small></th>                 
                                                       <th><small>CodRazon</small></th>
                                                       <th><small>AlmacenCas</small></th>                                                                         
                                                       <th><small>AlmacenGAS</small></th>
                                                       <th><small>Proyecto</small></th> 
                                                                       
                                                     </tr>
                                                     <tr style="background-color:lightblue">
                                                       <td>
                                                           <small> 
                                                            <?php echo $c->NumIDCaseta; ?>                             
                                                           </small>
                                                       </td>
                                                        <td>
                                                           <small> 
                                                            <?php echo $c->LlaveAccCarton; ?>                          
                                                           </small>
                                                       </td>
                                                       <td>
                                                           <small> 
                                                            <?php echo $c->CodigoRazon; ?>                           
                                                           </small>
                                                       </td>
                                                       <td>
                                                           <small> 
                                                            <?php echo $c->AlmacenCas; ?>                          
                                                           </small>
                                                       </td>                                                       
                                                       <td>
                                                           <small> 
                                                            <?php echo $c->AlmacenGAS; ?>                              
                                                           </small>
                                                       </td>
                                                       <td>
                                                           <small> 
                                                            
                                                            <?php echo $c->Proyecto; ?><br> 
                                                            <?php  $modu;?>
                                                            <?php  $resultado = substr($c->Proyecto,10,2);


                                                            if((trim($fila->Granja)=="CNDL") && (trim($modu)==05)){                                                         
                                                                  $modu =01;                                                
                                                                  if(trim($modu)==trim($resultado)){
                                                                   echo"  <span class='badge bg-success'>Correcto</span>";
                                                                    }else{
                                                                   echo"  <span class='badge bg-danger'>Error</span>";
                                                                    }   
                                                                                                                 
                                                             }elseif((trim($fila->Granja)=="CNDL") && (trim($modu)==04)){
                                                
                                                                   $modu =02;
                                                
                                                                   if(trim($modu)==trim($resultado)){
                                                                      echo"  <span class='badge bg-success'>Correcto</span>";
                                                                   }else{
                                                                      echo"  <span class='badge bg-danger'>Error</span>";
                                                                   }
                                                
                                                             }elseif((trim($fila->Granja)=="ELEN") && (trim($modu)==02)){
                                                
                                                                    $modu=01;
                                                
                                                                    if(trim($modu)==trim($resultado)){
                                                                     echo"  <span class='badge bg-success'>Correcto</span>";
                                                                    }else{
                                                                     echo"  <span class='badge bg-danger'>Error</span>";
                                                                    }
                                                
                                                          }else{
                                                                  if(trim($modu)==trim($resultado)){
                                                                     echo"  <span class='badge bg-success'>Correcto</span>";
                                                                  }else{
                                                                     echo"  <span class='badge bg-danger'>Error</span>";
                                                                   }
                                                
                                                
                                                          }

                                                            ?>
                                                                                       
                                                           </small>
                                                       </td>
                                                      </tr>
                                                      <tr>
                                                       
                                                       <td colspan="6">
                                                       <b><h4>Datos del Carton</h4></b>
                                                                   <!--INICIAMOS DATOS DE CARTON-->
                                                                               <table class="table table-striped" border="1">
                                                                                 <tr>                                                  
                                                                                   <th><small>Casetas</small></th>                 
                                                                                   <th><small>Año</small></th>                                                                         
                                                                                   <th><small>Ciclo</small></th>
                                                                                   <th><small>CantPollos Ingr</small></th>                                                     
                                                                                   <th><small>LoteTrns</small></th>                                                                                   
                                                                                   <th><small>Almacen-Gas</small></th>                                                                                                    
                                                                                 </tr>
                                                                                  <?php
                                                                                                                                                                    
                                                                                  $carton = new Classe();
                                                                                
                                                                                  if(isset($_GET['annio']) && isset($_GET['ciclo']) && isset($_GET['status'])){
                                                                                   $c->NumIDCaseta;
                                                                                   $annio=$_GET['annio'];
                                                                                   $ciclo=$_GET['ciclo'];
                                                                                   $status=$_GET['status'];
                                                                                   $carr = $carton->get_Cartones($c->NumIDCaseta,$annio,$ciclo,$status);
                                                                                  }else{                                                                                   
                                                                                    $annio=date('Y');                                                                                     
                                                                                    $status='EP';
                                                                                    $carr = $carton->get_Cartones_default($c->NumIDCaseta,$annio,$status);
                                                                                  } 
                                                                                   $proyecto="";  
                                                                                   $idCasetas=0; 

                                                                                  while($car = $carr->fetchObject()){
                                                                                  ?>
                                                                                 <tr>
                                                                                   <td>
                                                                                       <small> 
                                                                                        <?php echo $car->NumIDCaseta; ?>                              
                                                                                       </small>
                                                                                   </td>
                                                                                   <td>
                                                                                       <small> 
                                                                                        <?php echo $car->Ano; ?>                            
                                                                                       </small>
                                                                                   </td>                                                       
                                                                                   <td>
                                                                                       <small> 
                                                                                        <?php echo $car->Ciclo; ?>                              
                                                                                       </small><br>                                                                                       
                                                                                       <?php
                                                                                       

                                                                                      
                                                                                       if( trim($car->Status)=='EP'){
                                                                                          echo"  <span class='badge bg-success'>En Producción</span>";                                                                                          
                                                                                       }elseif( trim($car->Status)=='AB'){
                                                                                         echo"  <span class='badge bg-info'>Caseta Abierta</span>";
                                                                                       }elseif( trim($car->Status)=='EC'){
                                                                                         echo"  <span class='badge bg-warning'>En Cierre</span>";
                                                                                       }elseif( trim($car->Status)=='CC'){
                                                                                         echo"  <span class='badge bg-danger'>Caseta Cerrada</span>";
                                                                                       }else{

                                                                                       }  
                                                                                                                                                                           
                                                                                       ?>
                                                                                   </td> 
                                                                                   <td>
                                                                                       <small> 
                                                                                        <?php echo $car->CantPolloIngreso; ?>                           
                                                                                       </small><br>
                                                                                       <small>
                                                                                         Mortalidad <br> 
                                                                                        <?php echo $car->MortalidadLlegada; ?>                              
                                                                                       </small>
                                                                                   </td>                                                                                  
                                                                                
                                                                                   <td>
                                                                                       <small> 
                                                                                        <?php echo $car->LoteTRPollito; ?>                              
                                                                                       </small><br>
                                                                                       <small> 
                                                                                         Almacen Caseta <br>
                                                                                        <?php echo $car->AlmacenCASETA; ?>                              
                                                                                       </small>
                                                                                       <br> 
                                                                                       <?php if( $c->AlmacenCas==$car->AlmacenCASETA){
                                                                                          echo"  <span class='badge bg-success'>Correcto</span>";
                                                                                       }else{
                                                                                         echo"  <span class='badge bg-danger'>Error</span>";
                                                                                       }                                                                                        
                                                                                       ?>
                                                                                   </td>                                                                       
                                                                                   <td>
                                                                                        <small> 
                                                                                        <?php echo $car->AlmacenGAS; ?>                              
                                                                                       </small>
                                                                                       <br> 
                                                                                       <?php if( $c->AlmacenGAS==$car->AlmacenGAS){
                                                                                          echo"  <span class='badge bg-success'>Correcto</span>";
                                                                                       }else{
                                                                                         echo"  <span class='badge bg-danger'>Error</span>";
                                                                                       }                                                                                        
                                                                                       ?><br>
                                                                                        <small> 
                                                                                          Proyecto
                                                                                        <?php                                                                                       
                                                                                        
                                                                                       echo $proyecto=$car->ProyectoVigente; 
                                                                                        
                                                                                        ?>                              
                                                                                       </small>
                                                                                       <br> 
                                                                                       <?php
                                                                                       if(trim($car->Status)=='CC'){
                                                                                        echo"  <span class='badge bg-warning'>Ciclo Cerrado</span>";
                                                                                      }elseif((trim($car->Status)=='EP')){
                                                                                        if($c->Proyecto==$car->ProyectoVigente){
                                                                                          echo"  <span class='badge bg-success'>Correcto</span>";
                                                                                       }else{
                                                                                         echo"  <span class='badge bg-danger'>Error</span>";
                                                                                       } 

                                                                                      }elseif((trim($car->Status)=='AB')){
                                                                                        echo"  <span class='badge bg-warning'>Abierta</span>";
                                                                                      }elseif(trim($car->Status)=='EC'){
                                                                                        echo"  <span class='badge bg-warning'>En Cierre</span>";
                                                                                      }
                                                                                                                                                                          
                                                                                       ?> 
                 
                                                                                   </td>
                                                                                    
                                                                                     </tr>
                                                                                     <tr>
                                                                                   <td colspan="1">                                                                                                                                                                        
                                                                                   <casetas id="<?php echo trim($car->NumIDCaseta); ?>"
                                                                                            proyecto="<?php echo $car->ProyectoVigente; ?>"
                                                                                            :key="<?php echo trim($car->NumIDCaseta); ?>" >
                                                                                   </casetas>                                                                                                 
                                                                                    </td> 
                                                                                  <td colspan="5">                                                                                                       
                                                                                
                                                                                     <carton idcaseta="<?php echo trim($car->NumIDCaseta); ?>" 
                                                                                           annio="<?php echo trim($car->Ano); ?>" 
                                                                                           ciclo="<?php echo trim($car->Ciclo); ?>" 
                                                                                           :key="<?php echo trim($car->NumIDCaseta); ?>" >
                                                                                     </carton> 
                                                                                    </td> 
                                                                                     </tr>                               
                                                                                 </tr>  
                                                                                 <?php
                                                                                   }
                                                                                  ?> 
                                                                                  <tr>
                                                                                    <td colspan="6"><?php if(($proyecto=="")&&( $idCasetas!=0)){
                                                                                      echo"  <span class='badge bg-danger'>Error Proyecto no agregado</span>";
                                                                                      }
                                                                                      ?>
                                                                                      </td>
                                                                                  </tr>            
                                                                               </table>
                                                                   <!--CIERRE DATOS DE CARTON-->
                 
                                                       </td>                                 
                                                     </tr>  
                                                     <?php
                                                       }
                                                      ?>             
                                                   </table>
                                          <!--CIERRE CASETAS-->
                 
                                   </td>                                 
                                 </tr>  
                                 <?php
                                   }
                                  ?>             
                               </table>
                           <!--CIERRE DE MODULOS-->
                 
                 </td>                                 
               </tr>  
               <?php
                 }
                ?>             
             </table>
              </div>
            
            </div>
  </div>
  </div>

              
       
<?php
include_once"footer.php";
?>