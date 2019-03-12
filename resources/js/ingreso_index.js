$(document).on("ready",inicio);
function inicio(){
    tablaresultadosingreso(1);

}
function imprimiringreso(){
    var estafh = new Date();
    fecha=moment(estafh).format("DD/MM/YYYY H:m:s");
    $('#fhimpresion').html(fecha);
    $("#cabeceraprint").css("display", "");
    window.print();
    $("#cabeceraprint").css("display", "none");
}
function buscarnumero(e) {
  tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
        tablaresultadosingreso(2);
    }
}

function tablaresultadosingreso(lim){
    var controlador = "";
    var parametro = "";
    var base_url = document.getElementById('base_url').value;
    var categoriaestado = "";
    
    
    if(lim == 1){
        controlador = base_url+'ingreso/buscar50ingreso/';

    }else if(lim == 2){
        var unidad_id = document.getElementById('unidad_id').value;
        var programa_id = document.getElementById('programa_id').value;
        var estado_id    = document.getElementById('estado_id').value;
        if(unidad_id == 0){
           categoriaestado += "";
        }else{
           categoriaestado += "and p.unidad_id = u.unidad_id and u.unidad_id = "+unidad_id+" ";
           
        }
        if(programa_id == 0){
           categoriaestado += "";
        }else{
           categoriaestado += "and  p.programa_id = prog.programa_id and prog.programa_id = "+programa_id+" ";
          
        }
         if(estado_id == 0){
           categoriaestado += "";
        }else{
           categoriaestado += " and i.estado_id = "+estado_id+" ";
           
        }
        parametro = document.getElementById('filtrar').value;
        controlador = base_url+'ingreso/buscarporingreso/';

    }
     //parametro = document.getElementById('filtrar').value;   
     //controlador = base_url+'ingreso/buscarallingreso/';
    
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader

    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro, categoria:categoriaestado},
           success:function(respuesta){
                                   
                $("#encontrados").val("- 0 -");
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                   
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                   /*if (n <= limite) x = n; 
                   else x = limite;*/
                    
                    for (var i = 0; i < n ; i++){
                            var colorbaja = "style='background-color:"+registros[i]["estado_color"]+"'";
                        html += "<tr "+colorbaja+">";
                        
                        html += "<td>"+(i+1)+"</td>";
                        if(registros[i]["pedido_id"]==0){
                        html += "<td><font size='2'><span class='btn-danger'>SIN PEDIDO</span></font></td>";
                        }else{
                        
                        html += "<td>";
                        html += "<font size='3'><b>"+registros[i]["unidad_nombre"]+"</b></font> No. Pedido["+registros[i]["pedido_numero"]+"]<br>";
                        html += ""+registros[i]["programa_nombre"];
                        html += "</td>";
                        }
                        html += "<td style='text-align: center'>";
                        html += "<font size='3'><b>"+registros[i]["ingreso_id"]+"</b></font><br> ";
                        html += moment(registros[i]["ingreso_fecha"]).format("DD/MM/YYYY");
                        html += " "+registros[i]["ingreso_hora"];
                        html += "</td>";
                       
                        
                      
                        html += "<td style='text-align: center'><font size='3'><b>";
                        html += registros[i]["ingreso_numdoc"]+"</b></font><br>";
                        html += moment(registros[i]["ingreso_fecha_ing"]).format("DD/MM/YYYY");
                        html += "</td>";
                        if(registros[i]["proveedor_id"]==0){
                        html += "<td><font size='2'><span class='btn-danger'>SIN PROVEEDOR</span></font></td>";
                        }else{
                        html += "<td style='text-align: center'>"+registros[i]["proveedor_nombre"]+"</td>";  
                        }
                        html += "<td style='text-align: right'>BS. "+registros[i]["ingreso_total"]+"</td>";
                        html += "<td style='text-align: center'>"+registros[i]["estado_descripcion"]+"</td>";

                        html += "<td class='no-print'>";
                       
                        html += "<a href='"+base_url+"ingreso/edit/"+registros[i]["ingreso_id"]+"' class='btn btn-info btn-xs' title='EDITAR'><span class='fa fa-pencil'></span></a>";
                        html += "<a href='"+base_url+"ingreso/pdf/"+registros[i]["ingreso_id"]+"' class='btn btn-success btn-xs' title='IMPRIMIR'><span class='fa fa-print'></span></a></td>";
                        
                        //html += "<a data-toggle='modal' data-target='#myModal"+registros[i]["pedido_id"]+"'  title='Eliminar' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span></a>";
                        //}
                        
                        
                        html += "</tr>";

                   }
                   
                   
                   $("#tablaresultados").html(html);
                   document.getElementById('loader').style.display = 'none';
            }
         document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablaresultados").html(html);
        },
        complete: function (jqXHR, textStatus) {
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
            //tabla_inventario();
        }
        
    });   

}