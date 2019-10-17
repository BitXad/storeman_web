$(document).on("ready",inicio);
function inicio(){
        
        //tablaresultados(1);
        tablaproductos(); 

        document.getElementById('filtrar').focus();
        //document.getElementById('nit').select();
}

function validar(e,opcion) {
    
  tecla = (document.all) ? e.keyCode : e.which;
  
  
    if (tecla==13){ 
    
    
        if (opcion==0){   //si la pulsacion proviene del telefono
             document.getElementById('tipocliente_id').focus();
        }
        
        if (opcion==1){   //si la pulsacion proviene del nit          
            buscarcliente();            
        }

        if (opcion==2){
            var codigo = document.getElementById('razon_social').value;
            
            codigo = codigo[0]+codigo[1] + Math.floor((Math.random()*100000)+50);
                    
            $("#cliente_nombre").val(document.getElementById('razon_social').value);
            $("#telefono").val(''); //si la tecla proviene del input razon social
            
            $("#cliente_codigo").val(codigo);
           document.getElementById('telefono').focus();
        } 
        
        if (opcion==3){   //si la tecla proviene del input codigo de barras
            buscarporcodigo();           
        } 
        
        if (opcion==4){   //si la tecla proviene del input buscar por parametro
            tablaresultados(1);           
        }        
        
        if (opcion==5){   //si la tecla proviene del buscador de pedido abierto
            tablaresultadospedido(1);           
        }        
        
        if (opcion==6){   //si la tecla proviene del buscador de pedido abierto
            tablaresultadospedido(1);              
        }        
        
        if (opcion==7){   //si la tecla proviene del buscador de pedido abierto
           document.getElementById('filtrar').focus();               
        }
        
        if (opcion==9){   //si la tecla proviene del buscador de pedido abierto
           buscar_clientes();      
           
        }        
    } 
 
}



//muestra la tabla de productos disponibles para la venta
function tablaproductos()
{   
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'salida/detallesalida';
    var salida_id = document.getElementById('salida_id').value;
    
    $.ajax({url: controlador,
           type:"POST",
           data:{salida_id:salida_id},
           success:function(respuesta){     
               
               var registros = JSON.parse(respuesta);
               if (registros != null){

                       var subtotal = 0;
                       var descuento = 0;
                       var descgral = 0;
                       var totalfinal = 0;
                        html = "";
                        html += "<table class='table table-striped table-condensed' id='mitablaventas'>";
                        html += "                    <tr>";
                        html += "                            <th>#</th>";
                        html += "                            <th>Descripción</th>";                            
//                        html += "                            <th>Código</th>";
                        html += "                            <th>Cant</th>";
                        html += "                            <th>Precio</th>";
//                        html += "                            <th>Sub <br> Total</th>";
//                        html += "                            <th>Moneda</th>";
//                        html += "                            <th>Foto</th>";
                        html += "                            <th>Precio<br>Total</th>";
                        html += "                            <th> </th>";
                        html += "                    </tr>";                
                        html += "                    <tbody class='buscar2'>";

                    var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0;
                    var x = registros.length; //tamaño del arreglo de la consulta
                      
                    //alert(x);
                    for (var i = 0; i < x ; i++){

                           cont = cont+1;
                           cant_total+= parseFloat(registros[i]["detallesal_cantidad"]);
                           total_detalle+= parseFloat(registros[i]["detallesal_total"]);
                           
                            if (i == 0) color = "style='background-color: GoldenRod'"
                            else color = '';
                            
                        html += "                    <tr>";
                        html += "			<td "+color+">"+cont+"</td>";
                        html += "                       <td "+color+"><b><font size=1>"+registros[i]["articulo_nombre"]+"</font></b>";
                        html += "                           <small><br>"+registros[i]["articulo_unidad"]+" | "+registros[i]["articulo_marca"]+" | "+registros[i]["articulo_codigo"]+"</small>";
                       
                        html += "                       </td>";
                        
                        html += "			<td align='center' width='120' "+color+"> ";
                        html += "			<button onclick='reducir(1,"+registros[i]["detallesal_id"]+")' class='btn btn-facebook btn-xs'><span class='fa fa-minus'></span></a></button>";
                        html += "                       <input size='1' name='cantidad' id='cantidad"+registros[i]["detallesal_id"]+"' value='"+registros[i]["detallesal_cantidad"]+"' onKeyUp ='actualizarprecios(event,"+registros[i]["detallesal_id"]+" class='btn btn-warning')'>";
                        html += "                       <input size='1' name='productodet_id' id='productodet_"+registros[i]["detallesal_id"]+"' value='"+registros[i]["articulo_id"]+"' hidden>";
                        html += "                       <button onclick='incrementar(1,"+registros[i]["detallesal_id"]+")' class='btn btn-facebook btn-xs'><span class='fa fa-plus'></span></a></button>";

                        html += "                       </td>";
                        html += "			<td align='right' "+color+"><input size='5' name='precio' id='precio"+registros[i]["detallesal_id"]+"' value='"+parseFloat(registros[i]["detallesal_precio"]).toFixed(2)+"' onKeyUp ='actualizarprecios(event,"+registros[i]["detallesal_id"]+")'></td>";
                        html += "                       <td align='right' "+color+"><font size='3' ><b>"+parseFloat(registros[i]["detallesal_total"]).toFixed(2)+"</b></font></td>";

                        html += "			<td "+color+">";
                        html += "                            <button onclick='quitarproducto("+registros[i]["detallesal_id"]+")' class='btn btn-danger btn-xs'><span class='fa fa-times'></span></a></button> ";
                        html += "                        </td>";
                        html += "                    </tr>";  

                   }
                 
                   html += "                    </tbody>";
                   html += "                    <tr>";
                   html += "                            <th></th>";
                   html += "                            <th></th>";
                   html += "                            <th><font size='3'>"+cant_total.toFixed(2)+"</font></th>";
                   html += "                            <th></th>"; 
                   html += "                            <th><font size='3'>"+total_detalle.toFixed(2)+"</font></th>";
                   html += "                            <th></th> ";                                       
                   html += "                    </tr>   ";                 
                   html += "                </table>";
                   html += "                            <input type='text' value='"+total_detalle.toFixed(2)+"' id='salida_total' hidden>";

                   $("#tablaproductos").html(html);                 
                   
            }
            
                
        },
        error:function(respuesta){

        }
        
    });
}

//muestra la tabla detalle de venta auxiliar
function tabladetalle_espera()
{

    var base_url = document.getElementById('base_url').value; 
    var spiner = base_url+"resources/images/loader.gif"; 
            
        html = "<!-- Modal -->";
        html = "<div class='modal fade' id='myModal' role='dialog'>";
        html = "	<div class='modal-dialog'>";
        html = "";
        html = "	<!-- Modal content-->";
        html = "	<div class='modal-content'>";
        html = "	<div class='modal-body'>";
        html = "		<p>Some text in the modal.</p>";
        html = "	</div>";
        html = "	</div>";
        html = "	</div>";
        html = "</div>";
        html = "";
        html = " <!-- Modal -->";


    $("#modalespera").html(html); 
}

//esta funcion busca un producto en el inventario mediante su codigo de barras
// y la ingresa a la tabla detalle de venta
//function buscarporcodigo()
//{
//   var base_url = document.getElementById('base_url').value;
//   var controlador = base_url+'salida/buscarcodigo';
//   var codigo = document.getElementById('codigo').value;
//    
//    document.getElementById('oculto').style.display = 'block'; //mostrar el bloque del loader
//    
//    
//    $.ajax({url: controlador,
//           type:"POST",
//           data:{codigo:codigo},
//           success:function(respuesta){     
//    
//               tablaproductos(); 
//               $("#codigo").select();
//               
//               var resultado = JSON.parse(respuesta);                
//
//
//                if(resultado[0]["resultado"] == 0) alert('La cantidad excede la cantidad en inventario...!');
//                if(resultado[0]["resultado"] == -1) alert('El producto no se encuentra registrado con el código especificado...!!');
//
//                 
//           },
//           error:function(respuesta){
//               alert('ERROR: no existe el producto con el codigo seleccionado o no tiene existencia en inventario...!!');
//               
//               $("#codigo").select();
//
//           },
//            complete: function (respuesta) {
//               if (respuesta==null){
//                    alert('El producto no se encuentra registrado o se encuentra agostado en inventario..!!!');
//                }              
//             document.getElementById('oculto').style.display = 'none'; //ocultar el bloque del loader
//              $("#codigo").select();
//              
//            }
//        });
//           
//        
//    document.getElementById('oculto').style.display = 'none'; //ocultar el bloque del loader
//
//}

function cantidad_en_detalle(detalleing_id){
    
   var base_url = document.getElementById('base_url').value;
   var controlador = base_url+'salida/cantidad_en_detalle';
   var res = 0;

   $.ajax({url: controlador,
           type:"POST",
           data:{detalleing_id:detalleing_id},
           async: false, 
           success:function(respuesta){
               
               var resultado = eval(respuesta);
               
                res = resultado[0]["cantidad"];
           },
           error:function(respuesta){
               
             res = 0;
           }
    });     
    
    return res;
}

function existencia(articulo_id){
    
   var base_url = document.getElementById('base_url').value;
   var controlador = base_url+'salida/existencia';
   var res = 0;

   $.ajax({url: controlador,
           type:"POST",
           data:{articulo_id:articulo_id},
           async: false, 
           success:function(respuesta){
               
               var resultado = eval(respuesta);
               
                res = resultado[0]["existencia"];
           },
           error:function(respuesta){
               
             res = 0;
           }
    });     
    
    return res;
}

//esta funcion elimina un item de la tabla detalle de venta
function quitarproducto(articulo_id)
{

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"salida/eliminaritem/"+articulo_id;

    $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                tablaproductos();
            }        
    });
}

function quitartodo()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"salida/eliminartodo/";
    $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                tablaproductos();
            }
    });
}

//esta funcion incrementar una cantidad determinada de productos
function incrementar(cantidad,detallesal_id)
{    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"salida/incrementar/";
    var articulo_id = document.getElementById('productodet_'+detallesal_id).value;
    var cantidad_detalle = cantidad_en_detalle(articulo_id)+1;
    var cantidad_disponible =  existencia(articulo_id);
    
   if (cantidad_detalle <= cantidad_disponible){
       
        $.ajax({url: controlador,
                type:"POST",
                data:{cantidad:cantidad,detalleven_id:detalleven_id},
                success:function(respuesta){
                    
                    tablaproductos();
                    tabladetalle();
                    
                }

        });
   }
   else { alert('ADVERTENCIA: La cantidad excede la existencia en inventario...!!\n'+'Cantidad Disponible: '+cantidad_disponible);}
       
    
}

//esta funcion incrementar una cantidad determinada de productos
function reducir(cantidad,detalleven_id)
{    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"salida/reducir/";
   
    $.ajax({url: controlador,
            type:"POST",
            data:{cantidad:cantidad,detalleven_id:detalleven_id},
            success:function(respuesta){
                tablaproductos();
                tabladetalle();                
            }
        
    });
}

function actualizar_producto_inventario(articulo_id)
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"inventario/actualizar_producto";

    $.ajax({url: controlador,
        type:"POST",
        data:{articulo_id:articulo_id},
        success:function(respuesta){     
           
            //redirect('inventario/index');
        }
    });        
}

//se encarga de ingresar una cantidad determinada de productos al detalle de la venta en base de id de producto
// la cantidad debe estar registrada en el modal asignada para esta operacion
function ingresardetalle(articulo_id, detalleing_id)
{

   var base_url = document.getElementById('base_url').value;
   var controlador = base_url+'salida/insertar_producto';
   var cantidad = parseFloat(document.getElementById('cantidad'+detalleing_id).value);
   var existencia = document.getElementById('existencia'+detalleing_id).value;
   var salida_id = document.getElementById('salida_id').value;
   var detalleing_id = document.getElementById('detalleing_id'+detalleing_id).value;
   
   var cantidad_total = parseFloat(cantidad_en_detalle(detalleing_id)) + cantidad; 
   //alert(detalleing_id);
 
   if(cantidad_total <= existencia){
//   alert(cantidad_total+" - "+ existencia);
//   alert(controlador);
        $.ajax({url: controlador,
               type:"POST",
               data:{cantidadx:cantidad, articulo_idx:articulo_id, existenciax:existencia,salida_id:salida_id, detalleing_id:detalleing_id},
               success:function(respuesta){
                   var resultado = JSON.parse(respuesta);
                  // alert(resultado[0]["resultado"]);
                   tablaproductos();

                  // alert(resultado[0]['resultado']);

               },
               error:function(respuesta){
                   alert('ERROR: no existe el producto con el código seleccionado o no tiene existencia en inventario...!!');
                   tablaproductos();
                   $("#codigo").select();
               }
        });

   }
   else alert("ADVERTENCIA: La cantidad excede la existencia del inventario...!!");

}


function ingresorapido(articulo_id, cantidad, detalleing_id)
{

    
    $("#cantidad"+detalleing_id).val(cantidad); //establece la cantidad requerida en el modal
    ingresardetalle(articulo_id, detalleing_id); //llama a la funcion para consolidar la cantidad
    
}

//Tabla resultados de la busqueda
function tablaresultados(opcion)
{   
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'salida/buscar_unidad_programa/';
    var parametro = "";
    //var limite = 50;
    var precio_unidad = 0;
    var precio_factor = 0;
    var precio_factorcant = 0;
    var existencia = 0;
    var programa_id = 0;
    var unidad_id = 0;
    
    
    programa_id = document.getElementById('programa_id').value;
    //unidad_id = document.getElementById('unidad_id').value;        
    parametro = document.getElementById('filtrar').value;

    
    document.getElementById('oculto').style.display = 'block'; //mostrar el bloque del loader
    
   
    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro, programa_id:programa_id},
           success:function(respuesta){     

                $("#encontrados").val("- 0 -");
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                   
                   
                    var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0;
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";

                    for (var i = 0; i < n ; i++){
                        
                        var mimagen = "";

                        html += "<input type='text' value='"+registros[i]["detalleing_saldo"]+"' id='existencia"+registros[i]["detalleing_id"]+"' hidden>";
                        html += "<input type='text' value='"+registros[i]["detalleing_id"]+"' id='detalleing_id"+registros[i]["detalleing_id"]+"' hidden>";
                        html += "<tr>";
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><font size='3' face='arial narrow'><b>"+registros[i]["articulo_nombre"]+"</b></font><sub>["+registros[i]["articulo_id"]+"]</sub> ";
                        html += mimagen;   
                        html += "<br>"+registros[i]["articulo_unidad"]+" | "+registros[i]["articulo_marca"]+" | "+registros[i]["articulo_industria"]+" | "+registros[i]["articulo_codigo"]+" | <b>Ing. #"+registros[i]["ingreso_numdoc"]+"</b>";
                        html += "<input type='text' id='input_unidad"+registros[i]["detalleing_id"]+"' value='"+registros[i]["articulo_unidad"]+"' hidden>";
                        html += "</td>";
                                                
                        html += "<td><center> ";                        
                        html += " <select style='font-size:10px; face=arial narrow;' id='select_factor"+registros[i]["detalleing_id"]+"' onchange='mostrar_saldo("+registros[i]["detalleing_saldo"]+","+registros[i]["articulo_id"]+")'>";
                        html += "       <option value='1'>";
                        var precio_unidad = Number(registros[i]["detalleing_precio"]);
                        html += "         "+registros[i]["articulo_unidad"]+" Bs : "+precio_unidad+"";
                        html += "       </option>";
                        html += "   </select> <br>";
                        existencia = parseFloat(registros[i]["detalleing_saldo"]);
                        
                            if (parseFloat(registros[i]["detalleing_saldo"])>0){
                                html +=     "<font size='3'><button class='btn btn-default btn-xs' id='"+registros[i]['detalleing_id']+"' onclick='ingresorapido("+registros[i]['articulo_id']+","+Number(existencia).toFixed(2)+", "+registros[i]['detalleing_id']+")'><b> DISP: "+existencia+" "+registros[i]["articulo_unidad"]+"</b></button></font>";

                                  html += "<br>";
                                  html += "<div class='btn-group'>";
                                  html +=     "<button class='btn btn-success btn-xs' onclick='ingresorapido("+registros[i]['articulo_id']+", 1, "+registros[i]['detalleing_id']+")'><b>- 1 -</b></button>";
                                  html +=     "<button class='btn btn-info btn-xs' onclick='ingresorapido("+registros[i]['articulo_id']+", 2, "+registros[i]['detalleing_id']+")'><b>- 2 -</b></button>";
                                  html +=     "<button class='btn btn-primary btn-xs' onclick='ingresorapido("+registros[i]['articulo_id']+", 5, "+registros[i]['detalleing_id']+")'><b>- 5 -</b></button>";
                                  html +=     "<button class='btn btn-warning btn-xs' onclick='ingresorapido("+registros[i]['articulo_id']+", 10, "+registros[i]['detalleing_id']+")'><b>- 10 -</b></button> ";
                                  html += "</div>";   
                            }            
                        html += "</center>";
                        html += "</td>";
                        
                        html += "<td>";
                        if (parseFloat(registros[i]["detalleing_saldo"])>0){
                             html += "<button type='button' class='btn btn-warning btn-xl' data-toggle='modal' data-target='#myModal"+registros[i]["detalleing_id"]+"'  title='vender' ><em class='fa fa-cart-arrow-down'></em></button>";                             
                       }
                        
                        html += "<!------------------------ INICIO modal para MOSTRAR imagen REAL ------------------->";
                        html += "<div class='modal fade' id='mostrarimagen"+i+"' tabindex='-1' role='dialog' aria-labelledby='mostrarimagenlabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "<font size='3'><b>"+registros[i]["articulo_nombre"]+"</b></font>";
                        html += "</div>";

                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para MOSTRAR imagen REAL ------------------->";                       

                        html += "<!---------------------- modal cantidad producto ------------------->";
                        
                        html += "<div class='modal fade' id='myModal"+registros[i]["detalleing_id"]+"' tabindex='-1' role='dialog' aria-labelledby='myModal"+registros[i]["detalleing_id"]+"'>";
                        html += "  <div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "  <div class='modal-header'>";
                        html += "       <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "  </div>";                        
                        html += "  <div class='modal-body'>";
                        
                        html += "  <!----------------------------------------------------------------->";

                        html += "       <table style='space-white: nowrap;'>";
                        html += "           <tr>";
                        html += "               <td>";
                            
                        html += "               <font size='3'><b>"+registros[i]["articulo_nombre"]+"</b></font>";
                        html += "               <br>"+registros[i]["articulo_unidad"]+" | "+registros[i]["articulo_marca"]+" | "+registros[i]["articulo_industria"];
                        html += "               <br><b>  <input type='number' id='cantidad"+registros[i]["detalleing_id"]+"' name='cantidad"+registros[i]["detalleing_id"]+"'  value='1' style='font-size:20pt; width:100pt' autofocus='true' min='0' step='1' max='"+registros[i]["detalleing_saldo"]+"'></b>";
                        
                        html += "               </td>";
                        html += "          </tr>";
                        html += "       </table>";

                        html += "       <!------------------------------------------------------------------->";
                        html += "  </div>";
                        
                        html += "  <div class='modal-footer aligncenter'>";
                        html += "    <input type='text' id='articulo_id' name='articulo_id' value='"+registros[i]["articulo_id"]+"' hidden>";
                        html += "    <input type='text' id='producto_precio' name='producto_precio' value='"+registros[i]["articulo_precio"]+"' hidden>";

                        html += "     <!-- button class='btn btn-success btn-foursquarexs' type='submit'><font size='5'><span class='fa fa-cart-arrow-down'></span></font><br><small>Agregar</small></button-->";

                        html += "     <a href='#' data-toggle='modal' data-dismiss='modal' onclick='ingresardetalle("+registros[i]["articulo_id"]+", "+registros[i]['detalleing_id']+")' class='btn btn-success btn-foursquarexs'><font size='5'><span class='fa fa-cart-arrow-down'></span></font><br><small>Agregar</small></a>";

                        html += "     <a href='#' data-toggle='modal' data-dismiss='modal' class='btn btn-danger btn-foursquarexs'><font size='5'><span class='fa fa-search'></span></font><br><small>Cancelar</small></a>";
                        html += "  </div>";                        
                        html += "</div>";
                        
                        html += "  </div>";
                        html += "</div>";

                        html += "<!---------------------- fin modal cantidad ---------------------------------> ";

                        html += "</td>";
                        
                        html += "</tr>";

                   }
                                    
                   $("#tablaresultados").html(html);                
            }
            
                
        },
        error:function(respuesta){
           html = "";
           $("#tablaresultados").html(html);            
        },
        complete: function (jqXHR, textStatus) {
   
            document.getElementById('oculto').style.display = 'none'; //ocultar el bloque del loader
             
            $("#filtrar").focus();
            $("#filtrar").select();
        }
        
    });  
    
 //   $("#encontrados").focus(); //Quita el foco del buscador para que desparezca el teclado android
} 

function eliminardetalleventa()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"salida/eliminardetalle/";
    borrar_datos_cliente();
    
    $.ajax({url: controlador,
        type:"POST",
        data:{},
        success:function(respuesta){         
            tablaproductos();
        },
        error: function(respuesta){         
        }        
    });
}

function addZero(i) {
    if (i < 10) {
        i = '0' + i;
    }
    return i;
}

function fecha(){
    var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1;
        var yyyy = hoy.getFullYear();
        
        dd = addZero(dd);
        mm = addZero(mm);
 
       // return dd+'/'+mm+'/'+yyyy;
        return yyyy+'-'+mm+'-'+dd;
}

function fecha_actual(){
    
    var cuotas = document.getElementById('cuotas').value;
    var modalidad = document.getElementById('modalidad').value;
    var dia_pago = document.getElementById('dia_pago').value;
    var fecha_inicio = document.getElementById('fecha_inicio').value;
    var dias = 0;
    
    if (modalidad == "MENSUAL") dias = cuotas * 30;
    
    
    var hoy = new Date();
    hoy.setDate(hoy.getDate()+10);
    var dd = hoy.getDate();
    var mm = hoy.getMonth()+1;
    var yyyy = hoy.getFullYear();
        
        dd = addZero(dd);
        mm = addZero(mm);
        
   return dd+'/'+mm+'/'+yyyy;
        //return yyyy+'-'+mm+'-'+dd;
}


function mostrar_ocultar_buscador(parametro){
       
    if (parametro == "mostrar"){
        document.getElementById('buscador_oculto').style.display = 'block';}
    else{
        document.getElementById('buscador_oculto').style.display = 'none';}
    
}

//function buscar_por_fecha()
//{
//    var base_url    = document.getElementById('base_url').value;
//    var controlador = base_url+"pedido";
//    var fecha_desde = document.getElementById('fecha_desde').value;
//    var fecha_hasta = document.getElementById('fecha_hasta').value;
//    var estado_id = document.getElementById('estado_id').value;
//    
//    filtro = " and date(pedido_fecha) >= '"+fecha_desde+"'  and  date(pedido_fecha) <='"+fecha_hasta+
//            "' and p.estado_id = "+estado_id;
//    tabla_pedidos(filtro);
//
//}

function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}


//function montrar_ocultar_fila(parametro)
//{
//           
//    if (parametro == "mostrar"){
//        document.getElementById('fila_producto').style.display = 'block';}
//    else{
//        document.getElementById('fila_producto').style.display = 'none';}
//    
//}

function formato_numerico(numer){
    var partdecimal = "";
    var numero = "";
    var num = numer.toString();
    var signonegativo = "";
    var resultado = "";
    
    /*quitamos el signo al numero, si es que lo tubiera*/
    if(num[0]=="-"){
        signonegativo="-";
        numero = num.substring(1, num.length);
    }else{
        numero = num;
    }
    /*guardamos la parte decimal*/
    if(num.indexOf(".")>=0){
        partdecimal = num.substring(num.indexOf("."), num.length);
        numero = numero.substring(0,num.indexOf(".")-1);
    }else{
        numero = num;
    }
    for (var j, i = numero.length - 1, j = 0; i >= 0; i--, j++){
        resultado = numero.charAt(i) + ((j > 0) && (j % 3 == 0)? ",": "") + resultado;
    }
 
    resultado = signonegativo+resultado+partdecimal;
    return resultado;
}


function existeFecha(fecha){
      var fechaf = fecha.split("/");
      var day = fechaf[0];
      var month = fechaf[1];
      var year = fechaf[2];
      var date = new Date(year,month,'0');
      if((day-0)>(date.getDate()-0)){
            return false;
      }
      return true;
}

function finalizar_salida(){
    
    var base_url    = document.getElementById('base_url').value;
    var controlador =  base_url+"salida/finalizar_salida";

    var salida_id = document.getElementById('salida_id').value;
    var programa_id = document.getElementById('programa_id').value;
    var unidad_id = document.getElementById('unidad_id').value;
    var salida_motivo = "";//document.getElementById('salida_motivo').value;
    var salida_fechasal = document.getElementById('salida_fechasal').value;
    var salida_acta = document.getElementById('salida_acta').value;
    var salida_obs = ""; //document.getElementById('salida_obs').value;
    var salida_doc = document.getElementById('salida_doc').value;
    var salida_total = document.getElementById('salida_total').value;
    var bandera = document.getElementById('bandera').value;
    var error = 0;
    var mensaje = "";

    if (programa_id<1){ mensaje += " NO ha seleccionado el PROGRAMA,"; error = 1; }
    if (unidad_id<1){ mensaje  += " NO ha seleccionado la UNIDAD,"; error = 1; }
//    if (existeFecha(salida_fechasal)>0) error = 3;
    if ((salida_doc=='')  || (salida_doc=='-')){ mensaje  += " NO ha seleccionado el Nº de SALIDA";  error = 1; }
    
    if (salida_total<1){ mensaje  += " NO ha ingresado ARTICULOS al DETALLE";  error = 1; }

    
    if (error == 0){

        $.ajax({url: controlador,
            type:"POST",
            data:{salida_id:salida_id, programa_id:programa_id, unidad_id:unidad_id, salida_motivo:salida_motivo,salida_fechasal:salida_fechasal, salida_acta:salida_acta,salida_obs:salida_obs,salida_doc:salida_doc,salida_total:salida_total,bandera:bandera},
            success:function(respuesta){
                if(bandera == 1){
                  //  alert('ADVERTENCIA: Debe actualizar el inventario..!!');
                }
            },
            error: function(respuesta){
                cliente_id = 0;            
            }
        });    
    }else{
        alert(mensaje);
    }
    
    tablaproductos();
    tablaresultados(3);
}
