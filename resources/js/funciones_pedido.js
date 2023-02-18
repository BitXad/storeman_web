$(document).on("ready",inicio);

function inicio(){
    tablaresultadospedido(1);
}

function imprimirpedido(){
    var estafh = new Date();
    $('#fhimpresion').html(formatofecha_hora_ampm(estafh));
    $("#cabeceraprint").css("display", "");
    window.print();
    $("#cabeceraprint").css("display", "none");
}
/*aumenta un cero a un digito; es para las horas*/
function aumentar_cero(num){
    if (num < 10) {
        num = "0" + num;
    }
    return num;
}
/* recibe Date y devuelve en formato dd/mm/YYYY hh:mm:ss ampm */
function formatofecha_hora_ampm(string){
    var mifh = new Date(string);
    var info = "";
    var am_pm = mifh.getHours() >= 12 ? "p.m." : "a.m.";
    var hours = mifh.getHours() > 12 ? mifh.getHours() - 12 : mifh.getHours();
    if(string != null){
       info = aumentar_cero(mifh.getDate())+"/"+aumentar_cero((mifh.getMonth()+1))+"/"+mifh.getFullYear()+" "+aumentar_cero(hours)+":"+aumentar_cero(mifh.getMinutes())+":"+aumentar_cero(mifh.getSeconds())+" "+am_pm;
   }
    return info;
}

/* Funcion que buscara articulos en la tabla articulo */
function buscarpedido(e) {
  tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
        tablaresultadospedido(2);
    }
}

//Tabla resultados de la busqueda en el index de articulo
function tablaresultadospedido(lim){
    var controlador = "";
    var parametro = "";
    var base_url = document.getElementById('base_url').value;
    var categoriaestado = "";
    
    
    if(lim == 1){
        controlador = base_url+'pedido/buscarpedidoall/';
    }else if(lim == 2){
        var unidad_id = document.getElementById('unidad_id').value;
        var programa_id = document.getElementById('programa_id').value;
        var estado_id    = document.getElementById('estado_id').value;
        if(unidad_id == 0){
           categoriaestado += "";
        }else{
           categoriaestado += " and p.unidad_id = u.unidad_id and p.unidad_id = "+unidad_id+" ";
           
        }
        if(programa_id == 0){
           categoriaestado += "";
        }else{
           categoriaestado += " and p.programa_id = pr.programa_id and p.programa_id = "+programa_id+" ";
           /*zonatext = $('select[name="zona_id"] option:selected').text();
           zonatext = "Zona: "+zonatext;*/
        }
        if(estado_id == 0){
           categoriaestado += "";
        }else{
           categoriaestado += " and p.estado_id = "+estado_id+" ";
           /*categoriatext = $('select[name="categoriaclie_id"] option:selected').text();
           categoriatext = "Categoria: "+categoriatext;*/
        }
    }
     parametro = document.getElementById('filtrar').value;   
    controlador = base_url+'pedido/buscarpedidosall/';
    
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
                        html += "<tr "+colorbaja+"  class='no-margin'>";
                        
                        html += "<td>"+(i+1)+"</td>";
                        
                        
                        html += "<td>";
                        html += "<font size='3'><b>"+registros[i]["unidad_nombre"]+"</b></font>";
                        var programa_nombre = "";
                        if(registros[i]["programa_nombre"] != null && registros[i]["programa_nombre"] != ""){
                            programa_nombre = registros[i]["programa_nombre"];
                        }
                        html += "<br>"+programa_nombre;
                        html += "</td>";
                        html += "<td style='text-align: center'>";
                        html += "<font size='3'><b>"+registros[i]["pedido_numero"]+"</b></font>";
                        html += "<br>"+moment(registros[i]["pedido_fechapedido"]).format("DD/MM/YYYY");
                        html += "</td>";
                        
                        html += "<td style='text-align: center'>";
                        html += moment(registros[i]["pedido_fecha"]).format("DD/MM/YYYY")+"<br>";
                        html += registros[i]["pedido_hora"];
                        html += "</td>";
                        
                        html += "<td class='no-print'>";
                        if(registros[i]["pedido_archivo"]){
                            html += "<a href='"+base_url+"resources/images/pedidos/archivos/"+registros[i]["pedido_archivo"]+"' target='_blank' class='no-print'>"+registros[i]["pedido_archivo"]+"</a>";
                        } 
                        html += "</td>";
                        
                        html += "<td class='no-print'>";                        
                        html += "<div id='contieneimg'>";
                        var mimagen = "thumb_"+registros[i]["pedido_imagen"];
                        if(registros[i]["pedido_imagen"]){
                        html += "<a class='btn  btn-xs' data-toggle='modal' data-target='#mostrarimagen"+i+"' style='padding: 0px;'>";
                        html += "<img src='"+base_url+"resources/images/pedidos/imagenes/"+mimagen+"' />";
                        html += "</a>";
                        }
                        html += "</div>";
                        html += "</td>";
                        html += "<td style='text-align: center'>";
                        html += registros[i]["gestion_nombre"]+"<br>";
                        html += registros[i]["estado_descripcion"];
                        html += "</td>";
                        html += "<td class='no-print'>";
                        //if(registros[i]["estado_id"] == 6){
                        html += "<a href='"+base_url+"pedido/edit/"+registros[i]["pedido_id"]+"' class='btn btn-info btn-xs' title='Editar'><span class='fa fa-pencil'></span></a>";
                        html += "<a data-toggle='modal' data-target='#myModal"+registros[i]["pedido_id"]+"'  title='Eliminar' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span></a>";
                        //}
                        html += "<!-- ---------------------- INICIO modal para confirmar eliminación ----------------- -->";
                        html += "<div class='modal fade' id='myModal"+registros[i]["pedido_id"]+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+registros[i]["pedido_id"]+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<h3><span class='fa fa-trash'></span>";
                        html += "¿Desea eliminar el Pedido "+registros[i]["pedido_numero"]+"?";
                        html += "</h3>";
                        html += "<!-- --------------------------------------------------------------- -->";
                        html += "</div>";
                        html += "<div class='modal-footer aligncenter'>";
                        html += "<a onclick='eliminarpedido("+registros[i]["pedido_id"]+")' class='btn btn-success'><span class='fa fa-check'></span> Si </a>";
                        html += "<a href='#' class='btn btn-danger' data-dismiss='modal'><span class='fa fa-times'></span> No </a>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!-- ---------------------- FIN modal para confirmar eliminación ----------------- -->";
                        html += "<!-- ---------------------- INICIO modal para MOSTRAR imagen REAL ----------------- -->";
                        html += "<div class='modal fade' id='mostrarimagen"+i+"' tabindex='-1' role='dialog' aria-labelledby='mostrarimagenlabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "<font size='3'><b>"+registros[i]["pedido_numero"]+"</b></font>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!-- --------------------------------------------------------------- -->";
                        html += "'<img style='max-height: 100%; max-width: 100%' src='"+base_url+"resources/images/pedidos/imagenes/"+registros[i]["pedido_imagen"]+"' />";
                        html += "<!-- --------------------------------------------------------------- -->";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!-- ---------------------- FIN modal para MOSTRAR imagen REAL ----------------- -->";
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
function eliminarpedido(pedido_id){
    //var nombremodal = "modalpagardetalle"+nummodal;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'pedido/remove/';
    $('#myModal'+pedido_id).modal('hide');
    $.ajax({url: controlador,
           type:"POST",
           data:{pedido_id:pedido_id},
           success:function(respuesta){
               var registros =  JSON.parse(respuesta);
               if(registros != null){
                   if(registros == "us"){
                       alert("Pedido no puede ser Eliminado, debido a que esta siendo usado!");
                   }else if(registros == "ok"){
                       alert("Pedido Eliminado con Exito!");
                        tablaresultadospedido(1);
                   }
               }
        }
        
    });
}

function generarexcel(){
    var controlador = "";
    var parametro = "";
    var base_url = document.getElementById('base_url').value;
    var categoriaestado = "";
    var unidad_id = document.getElementById('unidad_id').value;
    var programa_id = document.getElementById('programa_id').value;
    var estado_id    = document.getElementById('estado_id').value;
    
    if(unidad_id == 0){
       categoriaestado += "";
    }else{
       categoriaestado += " and p.unidad_id = u.unidad_id and p.unidad_id = "+unidad_id+" ";
    }
    if(programa_id == 0){
       categoriaestado += "";
    }else{
       categoriaestado += " and p.programa_id = pr.programa_id and p.programa_id = "+programa_id+" ";
    }
    if(estado_id == 0){
       categoriaestado += "";
    }else{
       categoriaestado += " and p.estado_id = "+estado_id+" ";
    }
    parametro = document.getElementById('filtrar').value;   
    controlador = base_url+'pedido/buscar_pedidoexcel/';
    
    document.getElementById('loader').style.display = 'block'; //muestra el bloque del loader
    var showLabel = true;
    
    var reportitle = moment(Date.now()).format("DD/MM/YYYY H_m_s");
    
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
                    /* **************INICIO Generar Excel JavaScript************** */
                     var CSV = '';    
                    //Set Report title in first row or line

                    CSV += "PEDIDOS" + '\r\n\n';
                    //var CSV = 'sep=,' + '\r\n\n';
                    //This condition will generate the Label/Header
                    if (showLabel) {
                        var row = "";

                        //This loop will extract the label from 1st index of on array
                        for (var index in registros[0]) {

                            //Now convert each value to string and comma-seprated
                            row += index + ',';
                        }

                        row = row.slice(0, -1);

                        //append Label row with line break
                        CSV += row + '\r\n';
                    }
                    
                    //1st loop is to extract each row
                    for (var i = 0; i < registros.length; i++) {
                        var row = "";
                        //2nd loop will extract each column and convert it in string comma-seprated
                        for (var index in registros[i]) {
                            row += '"' + registros[i][index] + '",';
                        }

                        row.slice(0, row.length - 1);

                        //add a line break after each row
                        CSV += row + '\r\n';
                    }
                    
                    if (CSV == '') {        
                        alert("Invalid data");
                        return;
                    }
                    
                    //Generate a file name
                    var fileName = "Pedido_";
                    //this will remove the blank-spaces from the title and replace it with an underscore
                    fileName += reportitle.replace(/ /g,"_");   

                    //Initialize file format you want csv or xls
                    var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);

                    // Now the little tricky part.
                    // you can use either>> window.open(uri);
                    // but this will not work in some browsers
                    // or you will not get the correct file extension    

                    //this trick will generate a temp <a /> tag
                    var link = document.createElement("a");    
                    link.href = uri;

                    //set the visibility hidden so it will not effect on your web-layout
                    link.style = "visibility:hidden";
                    link.download = fileName + ".csv";

                    //this part will append the anchor tag and remove it after automatic click
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    /* **************F I N  Generar Excel JavaScript************** */
                    
                   document.getElementById('loader').style.display = 'none';
            }
         document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader
        },
        error:function(respuesta){
           html = "";
        },
        complete: function (jqXHR, textStatus) {
            document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
        }
        
    });
    
}

