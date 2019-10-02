<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">Establece tu Zona Horaria</div>
                <div class="panel-body">
                    

                        <form class="form-horizontal" action="../Zonashorarias/agregar.php" method="post">
                            <input type="hidden" name="admin_idadmin" class="form-control" required  value="<?php echo $ID;?>">
                            <div class="form-group mx-sm-3 mb-2">
                                    <label>Status</label>
                                    <select class="custom-select" required name="zonahoraria" id="inputGroupSelect01">
                                     <option selected></option>
                                     <?php
                                     foreach(timezone_abbreviations_list() as $abbr => $timezone){
                                     foreach($timezone as $val){
                                     if(isset($val['timezone_id'])){					
                                      echo"<option value=".$val['timezone_id'].">".$val['timezone_id']."</option>";
                                       }
                                      }
                                    }
                                     ?>
                                   </select>
                          
                             <button type="submit" class="btn btn-primary mb-2">Guardar </button>
                        </form>

                        
    
                </div>
            </div>
        </div>
    </div>

