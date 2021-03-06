<html>
<head>
<meta charset="utf-8">
<title>Prueba de progresoDownload</title>
<!--Se incorporan las librerias tanto de Jquery como la ajaxSetup.js-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script> window.jQuery || document.write('<script src="libs/js8/jquery-1.9.1.min.js"><\/script>') </script>
<script src="libs/js8/ajaxSetup.js" type="text/javascript"></script>
<!--Luego en el header se agrega el siguiente código básico
Este ejemplo de uso descargará un archivo pdf y una imágen de forma simultánea, una vez que los descargue en el caso del pdf forzará al explorador a presentar el cuadro de diálogo de descarga, en el caso de la imágen la presentará en la página web)-->

<script type="text/javascript">
var pruebaDescarga 
	$(document).ready(function(){
		$("#botonInicio").click(iniciaDescarga);
	})
  function iniciaDescarga(){
    pruebaDescarga = downQuery;
		var opciones = new Object();
		opciones.onCompletado = solicitudCompletada2;
		opciones.onSend = antesEnvioSolicitud2;
		opciones.onExito = exitoSolicitud2;
		opciones.onProgreso = muestraProgreso2;
		opciones.id="1";
		opciones.tipoResultado="binary";
		var datos = new Object();
		datos.archivo="APA.pdf";
		opciones.metodo = "POST";
		pruebaDescarga.dArchivo("http://pruebas.uanesi.net/descargaArchivoPOST.php",opciones);
		
		var opciones = new Object();
		opciones.onCompletado = solicitudCompletada2;
		opciones.onSend = antesEnvioSolicitud2;
		opciones.onExito = exitoSolicitud2;
		opciones.onProgreso = muestraProgreso2;
		opciones.tipoResultado="binary";
		opciones.id="2";
		opciones.metodo = "GET";
		pruebaDescarga.dArchivo("http://pruebas.uanesi.net/descargaArchivoGET.php?archivo=APA.pdf",opciones);
  }
	function muestraProgreso2(evt,xhr){
			$("#progresoTXT"+xhr.opciones.id).html(xhr.opciones.url);
			$("#progresoTXT"+xhr.opciones.id+"A").html(evt.lengthComputable+"<br>");
			if (evt.lengthComputable) {
				var percentComplete = evt.loaded / evt.total;
				$("#progresoTXT"+xhr.opciones.id).html(percentComplete+"<br>");
			}else{
				$("#progresoTXT"+xhr.opciones.id+"A").html("Progreso solo<br>");
			}
		}
		function errorSolicitud2(xhr, ajaxOptions, errorArrojado) {
			$("#progresoTXT"+xhr.opciones.id).append("Error al generar la vista previa 2");
			$("#progresoTXT"+xhr.opciones.id).append("<br>");
			$("#progresoTXT"+xhr.opciones.id).append(xhr.responseText);
			$("#progresoTXT"+xhr.opciones.id).append("<br>");
			$("#progresoTXT"+xhr.opciones.id).append(errorArrojado);
			$("#progresoTXT"+xhr.opciones.id).append("<br>");
			
		}
		function antesEnvioSolicitud2(evt,opciones) {
			console.log("antesEnvioSolicitud")
			console.log(opciones.id);
			$("#progresoTXTTest").html("antesEnvioSolicitud")
		}
		function solicitudCompletada2(evt,state) {
			console.log("solicitudCompletada");
			console.log(evt.opciones.id)
			$("#progresoTXTTest").html("solicitudCompletada");
		}
		function exitoSolicitud2(data, status, xhr) { 
			if(data){
				$("#progresoTXT"+xhr.opciones.id+"B").append("Objetivo: " + xhr.opciones.url + "<br>");
				var nombreArchivo = pruebaDescarga.obtieneNombre(xhr);
				$("#progresoTXT"+xhr.opciones.id+"B").append("Archivo: " + nombreArchivo + "<br>");
				var downloadUrl = URL.createObjectURL(data);
				if(xhr.opciones.id=="1"){
					var a = document.createElement("a");
					a.href = downloadUrl;
					a.download = nombreArchivo;
					document.body.appendChild(a);
					a.click();
				}else{
					var a = document.createElement("img");
					a.src = downloadUrl;
					document.body.appendChild(a);
				}
			}
			$("#progresoTXT"+xhr.opciones.id+"B").append("exitoSolicitud 2<br>");
		}
</script>
<body style="text-align:center">
<input type="button" id="botonInicio" name="botonInicio" value="Iniciar descarga">
<br>
<br>
<br>
<div id="progresoTXTTest" style="border:#000000 1px solid"></div>
<div id="progresoTXT1" style="border:#000000 1px solid"></div>
<div id="progresoTXT1A"></div>
<div id="progresoTXT1B"></div>
<div id="progresoTXT2" style="border:#000000 1px solid"></div>
<div id="progresoTXT2A"></div>
<div id="progresoTXT2B"></div>
</body>
</html>