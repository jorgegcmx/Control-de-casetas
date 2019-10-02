<?php
require_once '../conexion/Conexion.php';
class Classe
{
    private static $instancia;
    private $con;
    private $Granja;
    private $Nombre;

    
    
    public function __construct()
    {
     $this->con = Conexion::singleton_conexion();   
    } 

    public function set_gru($id,$nombregrupo){
    $this->idgrupos = $id;
    $this->nombregrupo = $nombregrupo;  
    }


   public function get_Granja($id)
    {
        try
        {
            $sql=""; 
        if($id != null){
            $sql = " SELECT Granja,Nombre FROM nuICCapdeCas 
            WHERE Granja=?
            GROUP BY Granja,Nombre  order by Granja DESC";            
        }else{
            $sql = "SELECT Granja,Nombre FROM nuICCapdeCas 
            GROUP BY Granja,Nombre  order by Granja DESC";
        }        
        $consulta = $this->con->prepare($sql);        
        if($id != null){
        $consulta->bindParam(1,$id);
        }
        $consulta->execute();
        $this->con = null;        
        if($consulta->rowCount() > 0){
         return $consulta;   
        }else{
            return $consulta;
        }//fin else
        }catch(PDOExeption $e){
            print "Error:" . $e->getmessage();
        }
  }

  public function get_Modulo($Granja)
  {
      try
      {
      $sql = "SELECT Granja,Modulo FROM nuiccapdecas";
      $sql .= " WHERE Granja=?  GROUP BY Granja,Modulo ORDER BY Granja DESC ";            
              
      $consulta = $this->con->prepare($sql);      
      $consulta->bindParam(1,$Granja);     
      $consulta->execute();
      $this->con = null;        
      if($consulta->rowCount() > 0){
       return $consulta;   
      }else{
          return $consulta;
      }//fin else
      }catch(PDOExeption $e){
          print "Error:" . $e->getmessage();
      }
}

public function get_Casetas($Granja,$Modulo)
  {
      try
      {
      $sql = "SELECT Granja,Modulo,NumIDCaseta,AlmacenCas,Proyecto,AlmacenGAS,LlaveAccCarton,CodigoRazon,S.User5 
              FROM nuiccapdecas inner join Site S on S.SiteId=AlmacenCas WHERE Granja=? AND Modulo=? AND Proyecto<>'PE000000CG00'
              ORDER BY Granja DESC";
             
      $consulta = $this->con->prepare($sql);      
      $consulta->bindParam(1,$Granja); 
      $consulta->bindParam(2,$Modulo);      
      $consulta->execute();
      $this->con = null;        
      if($consulta->rowCount() > 0){
          return $consulta;   
      }else{
          return $consulta;
      }//fin else
      }catch(PDOExeption $e){
          print "Error:" . $e->getmessage();
      }
}

            

public function get_Cartones($caseta,$annio,$ciclo,$status)
  {
      try
      {
      $sql = "SELECT NumIDCaseta,Ano,Ciclo,Sexo,CantPolloIngreso,
      MortalidadLlegada,PesoPromLlegada,MortalidadLlegada,
      LoteTRPollito,Status,AlmacenGAS,AlmacenCASETA,ProyectoVigente 
      FROM nupecontcashdr WHERE NumIDCaseta=? and Ano=? and Ciclo=? and status=?";
             
      $consulta = $this->con->prepare($sql);      
      $consulta->bindParam(1,$caseta); 
      $consulta->bindParam(2,$annio);
      $consulta->bindParam(3,$ciclo); 
      $consulta->bindParam(4,$status);     
      $consulta->execute();
      $this->con = null;        
      if($consulta->rowCount() > 0){
          return $consulta;   
      }else{
          return $consulta;
      }//fin else
      }catch(PDOExeption $e){
          print "Error:" . $e->getmessage();
      }
}


public function get_Cartones_default($caseta,$annio,$status)
  {
      try
      {
      $sql = "SELECT NumIDCaseta,Ano,Ciclo,Sexo,CantPolloIngreso,
      MortalidadLlegada,PesoPromLlegada,MortalidadLlegada,
      LoteTRPollito,Status,AlmacenGAS,AlmacenCASETA,ProyectoVigente 
      FROM nupecontcashdr WHERE NumIDCaseta=? and Ano=? and status=?";
             
      $consulta = $this->con->prepare($sql);      
      $consulta->bindParam(1,$caseta); 
      $consulta->bindParam(2,$annio);     
      $consulta->bindParam(3,$status);     
      $consulta->execute();
      $this->con = null;        
      if($consulta->rowCount() > 0){
          return $consulta;   
      }else{
          return $consulta;
      }//fin else
      }catch(PDOExeption $e){
          print "Error:" . $e->getmessage();
      }
}



public function get_transferencia_pollito($proyecto)
  {
      try
      {
      $sql = "select Loteid,LotSalInc,
      LoteEntGran,LotAjxMermaEnt,
      LoteSalpvIni,TotalCantSal,
      TotalCantEnt,TotMermaEnt,
      Status 
      from NuPeTranPol1DHdr  
      where Proyecto=? and Status in ('TG','PA','PS')";     

      $consulta = $this->con->prepare($sql);      
      $consulta->bindParam(1,$proyecto);        
      $consulta->execute();
      $this->con = null;        
      if($consulta->rowCount() > 0){
          return $consulta;   
      }else{
          return $consulta;
      }//fin else
      }catch(PDOExeption $e){
          print "Error:" . $e->getmessage();
      }
}

public function get_merma($loteID)
  {
      try
      {
      $sql = "select SUM(Merma)as merma from NuPeTranPol1DEnt where Loteid=?";     

      $consulta = $this->con->prepare($sql);      
      $consulta->bindParam(1,$loteID);        
      $consulta->execute();
      $this->con = null;        
      if($consulta->rowCount() > 0){
          return $consulta;   
      }else{
          return $consulta;
      }//fin else
      }catch(PDOExeption $e){
          print "Error:" . $e->getmessage();
      }
}



public function get_Cartones_detalle($caseta,$annio,$ciclo)
  {
      try
      {
      $sql = "SELECT  NumIDCaseta,Ano,Ciclo,Edad,LoteConsAlimGas,LoteAjusteMerma FROM nupecontcasdet WHERE NumIDCaseta=? and Ano= ? and Ciclo= ? and LoteConsAlimGas is not null order by Edad ";     

      $consulta = $this->con->prepare($sql);      
      $consulta->bindParam(1,$caseta); 
      $consulta->bindParam(2,$annio);     
      $consulta->bindParam(3,$ciclo);     
      $consulta->execute();
      $this->con = null;        
      if($consulta->rowCount() > 0){
          return $consulta;   
      }else{
          return $consulta;
      }//fin else
      }catch(PDOExeption $e){
          print "Error:" . $e->getmessage();
      }
}




























    
    public function add_gru(){
        try{
             if($this->idgrupos == null){
                 
        $sql= "INSERT INTO grupos VALUES(0,?)";
                 
    }else{
        $sql = "UPDATE  grupos"
		. " SET nombregrupo = ?"
			
		." WHERE idgrupos =?";
    }
	        
            $consulta = $this->con->prepare($sql);
            
            $consulta->bindparam(1,$this->nombregrupo);

    
                        
            if($this->idgrupos !=null){
                $consulta->bindparam(2, $this->idgrupos);
            }
            $consulta->execute();
			return $sql;
            $this->con = null;
            
        } catch (PDOEception $ex){
        print "Error:" . $e->getMessage();
        }
    }
	
	
	public function del_gru($id){
      try{
          $sql = "DELETE FROM grupos WHERE idgrupos = ?";
          $consulta = $this->con->prepare($sql);
          $consulta->bindParam(1, $id);
          $consulta->execute();
          $this->con = null;
      } catch (PDOException $e) {
          print "Error: " . $e->getMessage();
      }
  }
  
}//cierra clase