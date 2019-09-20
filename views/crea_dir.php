
<?
$url_descarga="http://localhost:8090/SQLSERVER_Visor_proyectos_PE/views/app-school.apk";
 
if (is_writeable("contador.txt"))
{
	$arrayfichero=file("contador.txt");
	$arrayfichero[0]++;
	$fichero=fopen("contador.txt","w+");
	$grabar=fwrite($fichero,$arrayfichero[0]);
	$cerrar=fclose($fichero);
}
header("location:$url_descarga");
?>


