<?php
include_once"header.php";
include_once '../Proyectos/Classe.php';

?> 
<div class="row" id="main" >
<div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Bordered Table</h3>
              </div>             
              <div class="card-body">
              <table class="table table-bordered">
               
               <?php
                $usu1 = new Classe();
                $datos = $usu1->get_Granja(null);
                while($fila = $datos->fetchObject()){
                ?>
               <tr>
                 <td>
                    <small> 
                      <!--?php echo $fila->Granja; ?><br-->
                     <h4><?php echo $fila->Nombre; ?></h4>                    
                    </small>
                 </td>
                 <td>
                            <!--INICIAMOS LOS MODULOS DE CADA GRANJA-->
                               <table class="table table-bordered" border="1" >
                                 <tr>
                                   <th><h4>Modulos</h4></th>                 
                                   <th><h4>Configuración Casetas</h4></th>                 
                                 </tr>
                                  <?php
                                  $modulo = new Classe();
                                  $mod = $modulo->get_Modulo($fila->Granja);
                                  while($m = $mod->fetchObject()){
                                  ?>
                                 <tr>
                                   <td>
                                       <small> 
                                       <h4> <?php echo $m->Modulo; ?><br> </h4>                             
                                       </small>
                                   </td>
                                   <td>
                                             <!--INICIAMOS LAS CASETAS DE CADA GRANJA Y MODULO-->
                                                   <table class="table table-bordered" >
                                                   
                                                     <tr >                                                  
                                                       <th ><small>Casetas</small></th>                                                      
                                                       <th><small>LlaveCart</small></th>                 
                                                       <th><small>CodRazon</small></th>
                                                       <th><small>AlmacenCas</small></th>                                                                         
                                                       <th><small>AlmacenGAS</small></th>
                                                       <th><small>Proyecto</small></th> 
                                                                       
                                                     </tr>
                                                 
                                                      <?php
                                                      $casetas = new Classe();
                                                      $cas = $casetas->get_Casetas($fila->Granja,$m->Modulo);
                                                      while($c = $cas->fetchObject()){
                                                      ?>
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
                                                            <?php echo $c->Proyecto; ?>                            
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
                                                                                    //AB;Caseta Abierta,EP;En Producción,EC;En Cierre,CC;Caseta Cerrada
                                                                                    $annio=date('Y');                                                                                     
                                                                                    $status='EP';
                                                                                    $carr = $carton->get_Cartones_default($c->NumIDCaseta,$annio,$status);
                                                                                  }                                                                                   
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
                                                                                        <?php echo $car->ProyectoVigente; ?>                              
                                                                                       </small>
                                                                                       <br> 
                                                                                       <?php if($c->Proyecto==$car->ProyectoVigente){
                                                                                          echo"  <span class='badge bg-success'>Correcto</span>";
                                                                                       }else{
                                                                                         echo"  <span class='badge bg-danger'>Error</span>";
                                                                                       }                                                                                        
                                                                                       ?> 
                 
                                                                                   </td>
                                                                                    
                                                                                     </tr>
                                                                                     <tr>
                                                                                   <td colspan="2">                                                                                                                                                                        
                                                                                   <casetas id="<?php echo trim($car->NumIDCaseta); ?>"
                                                                                            proyecto="<?php echo $car->ProyectoVigente; ?>"
                                                                                            :key="<?php echo trim($car->NumIDCaseta); ?>" >
                                                                                   </casetas>                                                                                                 
                                                                                    </td> 
                                                                                    <td colspan="4">                                                                                                                                                                                                                                                    
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