$(document).on("ready",inicio);
function inicio(){
       tablaresultadosarticulo();
}

/* Funcion que buscara articulos en la tabla articulo */
function buscararticulo(e) {
  tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
        tablaresultadosarticulo();
    }
}

//Tabla resultados de la busqueda en el index de articulo
function tablaresultadosarticulo(){
    var controlador = "";
    var parametro = "";
    var base_url = document.getElementById('base_url').value;
    
    controlador = base_url+'articulo/buscararticuloall/';
    parametro = document.getElementById('filtrar').value;
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    

    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro},
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
                        var colorbaja = "";
                        if(registros[i]["estado_id"] == 2){
                            colorbaja = "style='background-color:"+registros[i]["estado_color"]+"'";
                        }
                        html += "<tr "+colorbaja+">";
                        
                        html += "<td>"+(i+1)+"</td>";
                        
                        html += "<td>"+registros[i]["articulo_nombre"]+"</td>";
                        html += "<td>"+registros[i]["articulo_marca"]+"</td>";
                        html += "<td>"+registros[i]["articulo_industria"]+"</td>";
                        html += "<td>"+registros[i]["articulo_codigo"]+"</td>";
                        html += "<td>"+registros[i]["articulo_saldo"]+"</td>";
                        html += "<td>"+registros[i]["categoria_nombre"]+"</td>";
                        var umanejo = "";
                        if(registros[i]["umanejo_descripcion"] != null){
                            umanejo = registros[i]["umanejo_descripcion"];
                        }
                        html += "<td>"+umanejo+"</td>";
                        html += "<td style='background-color: "+registros[i]["estado_color"]+"'>"+registros[i]["estado_descripcion"]+"</td>";
                        html += "<td>";
                        html += "<a href='"+base_url+"articulo/edit/"+registros[i]["articulo_id"]+"' class='btn btn-info btn-xs' title='Editar' ><span class='fa fa-pencil'></span></a>";
                        html += "<a data-toggle='modal' data-target='#myModal"+registros[i]["articulo_id"]+"'  title='Eliminar' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span></a>";
                        html += "<a data-toggle='modal' data-target='#anularModal"+registros[i]["articulo_id"]+"'  title='Inactivar' class='btn btn-danger btn-xs'><span class='fa fa-ban'></span></a>";

                        html += "<!-- ---------------------- INICIO modal para confirmar eliminación ----------------- -->";
                        html += "<div class='modal fade' id='myModal"+registros[i]["articulo_id"]+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!-- --------------------------------------------------------------- -->";
                        html += "<h3><b> <span class='fa fa-trash'></span></b>";
                        html += "¿Desea eliminar el Artículo <b> "+registros[i]["articulo_nombre"]+"</b>?";
                        html += "</h3>";
                        html += "<!-- --------------------------------------------------------------- -->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<a onclick='eliminararticulo("+registros[i]['articulo_id']+")' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!-- ---------------------- FIN modal para confirmar eliminación ----------------- -->";
                        
                        html += "<!-- ---------------------- INICIO modal para confirmar anulación ----------------- -->";
                        html += "<div class='modal fade' id='anularModal"+registros[i]["articulo_id"]+"' tabindex='-1' role='dialog' aria-labelledby='anularModalLabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!-- --------------------------------------------------------------- -->";
                        html += "<h3><b> <span class='fa fa-trash'></span></b>";
                        html += "¿Desea anular el Artículo <b> "+registros[i]["articulo_nombre"]+"</b>?";
                        html += "</h3>";
                        html += "<!-- --------------------------------------------------------------- -->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<a onclick='anulararticulo("+registros[i]['articulo_id']+")' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!-- ---------------------- FIN modal para confirmar anulación ----------------- -->";
                        html += "</td>";
                        
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
/* ****************Eliminar un articulo*************** */
function eliminararticulo(articulo_id){
    //var nombremodal = "modalpagardetalle"+nummodal;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'articulo/remove/';
    $('#myModal'+articulo_id).modal('hide');
    $.ajax({url: controlador,
           type:"POST",
           data:{articulo_id:articulo_id},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                   if(registros == "no"){
                       alert("El Artículo que intentas eliminar no existe.");
                   }else if("ok"){
                       alert("Articulo Eliminado con Exito!");
                       
                        tablaresultadosarticulo();
                   }
               }
        }
        
    });
}
/* ****************Eliminar un articulo*************** */
function anulararticulo(articulo_id){
    //var nombremodal = "modalpagardetalle"+nummodal;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'articulo/inactivar/';
    $('#anularModal'+articulo_id).modal('hide');
    $.ajax({url: controlador,
           type:"POST",
           data:{articulo_id:articulo_id},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta);
               if (registros != null){
                   if(registros == "no"){
                       alert("El Artículo que intenta anular no existe.");
                   }else if("ok"){
                       alert("Articulo Anulado con Exito!");
                       
                        tablaresultadosarticulo();
                   }
               }
        }
        
    });
}
