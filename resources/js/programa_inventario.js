//Tabla de resultados del programa seleccionado
function tablaresultadosprogramainv(){
    var controlador    = "";
    var base_url       = document.getElementById('base_url').value;
    var fecha_hasta    = document.getElementById('fecha_hasta').value;
    var programa_id    = document.getElementById('programa_id').value;
    var gestion_inicio = document.getElementById('gestion_inicio').value;
    var gestion_id     = document.getElementById('gestion_id').value;
    controlador        = base_url+'programa/inventariobuscar/';
    
       $.ajax({url: controlador,
           type:"POST",
           data:{fecha_hasta:fecha_hasta, programa_id:programa_id, gestion_inicio:gestion_inicio,
                 gestion_id:gestion_id},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta); 
               if (registros != null){
                    var cant_total = 0;
                    var n = registros.length;
                    html = "";
                    html += "<table style='width: 19.59cm' class='table table-striped' id='mitabla'>";
                    html += "<tr>";
                    html += "<th>#</th>";
                    html += "<th>DETALLE</th>";
                    html += "<th>UNIDAD</th>";
                    html += "<th>CODIGO</th>";
                    html += "<th>CANT.</th>";
                    html += " <th>PREC. UNIT. Bs.</th>";
                    html += "<th>PREC. TOTAL Bs.</th>";
                    html += "</tr>";
                    for(var i = 0; i < n ; i++){
                        html += "<tr>";
                        cant_total = Number(cant_total)+Number(Number(registros[i]["precio_unitario"]*Number(registros[i]["saldos"])))
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><b><font size=2>"+registros[i]["articulo_nombre"]+"</font></b></td>";
                       	html += "<td>"+registros[i]["articulo_unidad"]+"</td>";
                       	html += "<td>"+registros[i]["articulo_codigo"]+"</td>";
                       	html += "<td class='text-right'>"+Number(registros[i]["saldos"]).toFixed(2)+"</td>";
                       	html += "<td class='text-right'>"+Number(registros[i]["precio_unitario"]).toFixed(2)+"</td>";
                        
                       	html += "<td class='text-right'>"+Number(Number(registros[i]["precio_unitario"]*Number(registros[i]["saldos"]))).toFixed(2)+"</td>";
                     
                        html += "</tr>";
                        
                    }
                    convertiraliteral(Number(cant_total).toFixed(2));
                    
                    html += "</table>";
                    var titulo_prog = $("#programa_id option:selected").text();
                    
                    //$('select[name="programa_id"] option:selected').text());
                    $("#elprograma").html(titulo_prog);
                    $("#lafecha").html(fecha_hasta);
                    $("#elcodigo").html(fecha_hasta);
                    $("#tablaresultados").html(html);
                    var html1 ="";
                    html1 += "<table style='width: 19.59cm' class='text-bold'>";
                    html1 += "<tr>";
                    html1 += "<td class='text-right' colspan='2'> TOTAL:";
                    html1 += "</td>";
                    html1 += "<td class='text-right' colspan='5'>"+Number(cant_total).toFixed(2)+" Bs.";
                    html1 += "</td>";
                    html1 += "</tr>";
                    html1 += "<tr>";
                    html1 += "<td class='text-right' colspan='2'> LITERAL:";
                    html1 += "</td>";
                    html1 += "<td class='text-right' colspan='5'><span id='literal'></span>";
                    html1 += "</td>";
                    html1 += "</tr>";
                    html1 += "</table>";
                    $("#tablaresultados1").html(html1);
                   
            }
                
        },
        error:function(respuesta){
          
          alert('No existe kardex para un articulo de esas caracteristicas en el programa seleccionado dentro el rango de fechas.');
           html = "";
           $("#tablaresultados").html(html);
        }
        
    });   

}

function convertiraliteral(numero)
{
    var controlador = "";
    var base_url       = document.getElementById('base_url').value;
    controlador        = base_url+'programa/convertiraliteral/';
    
       $.ajax({url: controlador,
           type:"POST",
           data:{numero:numero},
           success:function(respuesta){
               var registros =  JSON.parse(respuesta); 
               if (registros != null){
                    //$('select[name="programa_id"] option:selected').text());
                    $("#literal").html(registros);
            }
        },
        error:function(respuesta){
          
          alert('No existe movimiento para este programa.');
           html = "";
           $("#literal").html(html);
        }
        
    });
}