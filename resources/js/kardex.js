function buscaarticulo(e,opcion) {
  tecla = (document.all) ? e.keyCode : e.which;
  
    if (tecla==13){ 
    
       
        if (opcion==3){  
            tablaresultados(1);    

        } 
        
    } 

    
} 
//Tabla resultados de la busqueda de particulos
function tablaresultados(opcion)
{   
    var controlador = "";
    var parametro = "";
    var programa_id = document.getElementById('programa_id').value;
    var limite = 200;
    var base_url = document.getElementById('base_url').value;
     var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    alert(programa_id);
    if (opcion == 1){
        controlador = base_url+'programa/buscar/';
        parametro = document.getElementById('articulobus').value 
        
    }
   
       $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro,programa_id:programa_id,fecha_desde:fecha_desde,fecha_hasta:fecha_hasta},
           success:function(respuesta){     
               
                     
                $("#encontrados").val("- 0 -");
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                   
                   
                    var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0;
                    var n = registros.length; //tama«Ðo del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                    	html += " <table class='table table-striped' id='mitabla'>";
                       	 html += "<tr>";
                         html += "<th>#</th>";
                         html += "<th>Nombre</th>";
                         //html += "<th>Categoría</th>";
                         html += "<th>Unidad</th>";
                         html += "<th>Marca</th>";
                         html += "<th>Industria</th>";
                         html += " <th>Prec.</th>";
                         html += "<th>Saldo</th>";
                         html += "<th></th>";
                         
                       	 html += "</tr>";

                    for (var i = 0; i < x ; i++){
                       	 
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><b><font size=2>"+registros[i]["articulo_nombre"]+"</font>    ("+registros[i]["articulo_codigo"]+")</b></td>";
                      
                       
                       //	html += "<td>"+registros[i]["articulo_categoria"]+"</td>";
                       	html += "<td>"+registros[i]["articulo_unidad"]+"</td>";
                       	html += "<td>"+registros[i]["articulo_marca"]+"</td>";
                       	html += "<td>"+registros[i]["articulo_industria"]+"</td>";
                       	html += "<td>"+registros[i]["articulo_precio"]+"</td>";
                       	html += "<td>"+registros[i]["articulo_saldo"]+"</td>";
                        html += "<td><a href='"+base_url+"detalle_ingreso/kardex/"+programa_id+"/"+registros[i]["articulo_id"]+"/"+fecha_desde+"/"+fecha_hasta+"' type='button'  target='_blank' class='btn btn-success'><span class='fa fa-list'> Ver Kardex</span></a></td>";
                     
                        html += "</tr>";
                        

                   }
                 		html += "</table>";
                   
                   $("#tablaresultados").html(html);
                   
            }
                
        },
        error:function(respuesta){
          
           html = "";
           $("#tablaresultados").html(html);
        }
        
    });   

}

function kardex(programa_id,articulo_id)
{

}