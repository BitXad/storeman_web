$(document).on("ready",inicio);
function inicio(){
        
        tablaresultados(1);
        tablaproductos(); 

        document.getElementById('programa_nombre').focus();
        //document.getElementById('nit').select();
}

function calculardesc(){

   var venta_subtotal = document.getElementById('venta_subtotal').value;
   var venta_descuento = document.getElementById('venta_descuento').value;      
   var subtotal = Number(venta_subtotal) - Number(venta_descuento);

   $("#venta_totalfinal").val(subtotal);
   $("#venta_efectivo").val(subtotal);
   
}

function calcularcambio(){
   
   var venta_efectivo = document.getElementById('venta_efectivo').value;
   var venta_totalfinal = document.getElementById('venta_totalfinal').value;
   
   var venta_cambio = Number(venta_efectivo) - Number(venta_totalfinal);
   //alert(venta_cambio);
   $("#venta_cambio").val(venta_cambio);
    
}

//esta funcion verifica 2 parametros: la tecla presionada y otro parametro que le indica que hacer
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
        
        if (opcion==4){   //si la tecla proviene del input codigo de barras
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

//Selecciona los datos del nit
function seleccionar(opcion) {
    
        if (opcion==1){             
            document.getElementById('nit').select();
        }
        
        if (opcion==2){
            document.getElementById('razon_social').select();
        }
        
        if (opcion==3){
            document.getElementById('telefono').select();
        }
        
        if (opcion==4){
            document.getElementById('venta_descuento').select();
        }
        
        if (opcion==5){
            document.getElementById('venta_efectivo').select();
        }
}
// esta funcion busca la cliente mediante su nit e inserta los datos 
// en cada input corresponiente si es que existe
// sino existe.. deja abierta la posibilidad de ingresar datos de nuevos de clientes
function buscarcliente(){

   var base_url = document.getElementById('base_url').value;
   var nit = document.getElementById('nit').value;
   var controlador = base_url+'venta/buscarcliente';
 
    $.ajax({url:controlador,
            type:"POST",
            data:{nit:nit},
            success:function(respuesta){
                
                var registros = eval(respuesta);
                
                
                if (registros[0]!=null){ //Si el cliente es nuevo o no existe
                    
                    $("#razon_social").val(registros[0]["cliente_razon"]);
                    document.getElementById('telefono').focus();
                    $("#cliente_id").val(registros[0]["cliente_id"]);
                    $("#cliente_nombre").val(registros[0]["cliente_nombre"]);
                    $("#cliente_ci").val(registros[0]["cliente_ci"]);
                    $("#cliente_nombrenegocio").val(registros[0]["cliente_nombrenegocio"]);
                    $("#cliente_codigo").val(registros[0]["cliente_nit"]);
                    
                }
                else 
                {
                    //$("#razon_social").val('SIN NOMBRECILLO');
                    document.getElementById('razon_social').focus();
                    $("#razon_social").val("");
                    $("#cliente_id").val(0);
                    $("#cliente_nombre").val("-");
                    $("#cliente_ci").val(nit);
                    $("#cliente_nombrenegocio").val("-");
                    $("#cliente_codigo").val("-");
                }

            },
            error:function(respuesta){			
                $("#razon_social").val('SIN NOMBRE');
                document.getElementById('telefono').focus();
                
                $("#cliente_id").val(0);
            }                
    }); 

}

//muestra la tabla de productos disponibles para la venta
function tablaproductos()
{   
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'venta/detalleventa';
    
    $.ajax({url: controlador,
           type:"POST",
           data:{datos:1},
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
                      
                    for (var i = 0; i < x ; i++){


                           cont = cont+1;
                           cant_total+= parseFloat(registros[i]["detalleven_cantidad"]);
                           total_detalle+= parseFloat(registros[i]["detalleven_total"]);
                           
                            if (i == 0) color = "style='background-color: GoldenRod'"
                            else color = '';
                            
                        html += "                    <tr>";
                        html += "			<td "+color+">"+cont+"</td>";
                        html += "                       <td "+color+"><b><font size=1>"+registros[i]["producto_nombre"]+"</font></b>";
                        html += "                           <small><br>"+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_codigobarra"]+"</small>";

//************************ INICIO CARACTERISTICAS ***************************

html += "  <button class='btn btn-primary btn-xs' type='button' data-toggle='collapse' data-target='#caracteristicas"+registros[i]["detalleven_id"]+"' aria-expanded='false' aria-controls='caracteristicas"+registros[i]["detalleven_id"]+"'><i class='fa fa-edit'></i></button>";


html += "<div class='row'>";
html += "  <div class='col'>";
html += "    <div class='collapse multi-collapse' id='caracteristicas"+registros[i]["detalleven_id"]+"'>";
html += "      <div class='card card-body'>";

html += "        <div class='row clearfix'> ";
html += "           <div class='col-md-12'>";
html += "               <label for='estado_descripcion' class='control-label  text-uppercase'>Preferencias/Características</label>";
html += "               <div class='form-group'>"
html += "               <input type='text' name='detalleven_preferencia' value='"+registros[i]['detalleven_preferencia']+"' class='form-control text-uppercase' id='detalleven_preferencia"+registros[i]["detalleven_id"]+"' />";
html += "               </div>";
html += "           </div>";
html += "           <div class='col-md-12'>";
//html += "               <label for='estado_descripcion' class='control-label'>Descripcion</label>";
html += "               <div class='form-group'>";
html += "               <textarea name='detalleven_caracteristicas' class='form-control' id='detalleven_caracteristicas"+registros[i]["detalleven_id"]+"'>"+registros[i]['detalleven_caracteristicas'];

html += "               </textarea>";

html += "               <button class='btn btn-primary btn-xs' onclick='actualizar_caracteristicas("+registros[i]["detalleven_id"]+")' type='button' data-toggle='collapse' data-target='#caracteristicas"+registros[i]["detalleven_id"]+"' aria-expanded='false' aria-controls='caracteristicas"+registros[i]["detalleven_id"]+"'><i class='fa fa-save'></i> Guardar</button>";

html += "               </div>";
html += "           </div>";

html += "           </div>";
html += "      </div>";
html += "    </div>";
html += "  </div>";

//************************ FIN INICIO CARACTERISTICAS ***************************
                       
                       html += "                       </td>";
                        
//                        html += "                       <td align='center' "+color+">";
//                        html += "                           <b><font size=1>"+registros[i]["producto_codigo"]+"</font></b><br>";
//                        html += "                           <small> "+registros[i]["producto_codigobarra"]+"</small>";
//                        html += "                       </td>";
                        
                        html += "			<td align='center' width='120' "+color+"> ";
                        html += "			<button onclick='reducir(1,"+registros[i]["detalleven_id"]+")' class='btn btn-facebook btn-xs'><span class='fa fa-minus'></span></a></button>";
                        html += "                       <input size='1' name='cantidad' id='cantidad"+registros[i]["detalleven_id"]+"' value='"+registros[i]["detalleven_cantidad"]+"' onKeyUp ='actualizarprecios(event,"+registros[i]["detalleven_id"]+" class='btn btn-warning')'>";
                        html += "                       <input size='1' name='productodet_id' id='productodet_"+registros[i]["detalleven_id"]+"' value='"+registros[i]["producto_id"]+"' hidden>";
                        html += "                       <button onclick='incrementar(1,"+registros[i]["detalleven_id"]+")' class='btn btn-facebook btn-xs'><span class='fa fa-plus'></span></a></button>";

                        html += "                       </td>";
                        html += "			<td align='right' "+color+"><input size='5' name='precio' id='precio"+registros[i]["detalleven_id"]+"' value='"+parseFloat(registros[i]["detalleven_precio"]).toFixed(2)+"' onKeyUp ='actualizarprecios(event,"+registros[i]["detalleven_id"]+")'></td>";
                        html += "                       <td align='right' "+color+"><font size='3' ><b>"+parseFloat(registros[i]["detalleven_total"]).toFixed(2)+"</b></font></td>";
//                        html += "			<td>"+registros[i]["producto_foto"]+"</td>";
//                        html += "			<td>"+registros[i]["detalleven_comision"]+"</td>";
//                        html += "			<td>"+registros[i]["detalleven_tipocambio"]+"</td>";
                        html += "			<td "+color+">";
//                        html += "                            <a href='"+base_url+"producto/edit"+registros[i]["producto_id"]+"' class='btn btn-info btn-xs'><span class='fa fa-pencil'></span></a> ";
//                        html += "                            <a href='"+base_url+"venta/eliminaritem/"+registros[i]["detalleven_id"]+"' class='btn btn-danger btn-xs'><span class='fa fa-times'></span></a>";
//                        html += "                            <a href='"+base_url+"producto/edit"+registros[i]["producto_id"]+"' class='btn btn-info btn-xs'><span class='fa fa-pencil'></span></a> ";
                        html += "                            <button onclick='quitarproducto("+registros[i]["detalleven_id"]+")' class='btn btn-danger btn-xs'><span class='fa fa-times'></span></a></button> ";
                        html += "                        </td>";
                        html += "                    </tr>";  

                   }
                 
                   html += "                    </tbody>";
                   html += "                    <tr>";
                   html += "                            <th></th>";
                   html += "                            <th></th>";
                   //html += "                            <th></th>";
                   html += "                            <th><font size='3'>"+cant_total.toFixed(2)+"</font></th>";
                   html += "                            <th></th>"; 
                   html += "                            <th><font size='3'>"+total_detalle.toFixed(2)+"</font></th>";
                   html += "                            <th></th> ";                                       
                   html += "                    </tr>   ";                 
                   html += "                </table>";

                   $("#tablaproductos").html(html);                 
                   tabladetalle(total_detalle,0,total_detalle);
            }
            
                
        },
        error:function(respuesta){

        }
        
    });
}

//muestra la tabla detalle de venta auxiliar
function tabladetalle(subtotal,descuento,totalfinal)
{
    $("#venta_total").val(subtotal.toFixed(2));
    $("#venta_descuento").val(descuento.toFixed(2));
    $("#venta_subtotal").val(subtotal.toFixed(2));
    var venta_totalfinal = parseFloat(totalfinal - descuento);
    $("#venta_totalfinal").val(venta_totalfinal.toFixed(2));
    
    html = "";
    html += "<div class='box'>";
    html += "        <div class='box-body table-responsive table-condensed'>";
    html += "            <table class='table table-striped table-condensed' id='miotratabla'>";
    html += "<tr>";
    html += "    <th> Descripción</th>";
    html += "    <th> Total </th> "; 
    html += "</tr>";
    html += "<tr>";
    html += "    <td>Sub Total Bs</td>";
    html += "    <td align='right'>"+subtotal.toFixed(2)+"</td>";
    html += "</tr> ";
    html += "<tr>";
    html += "    <td>Descuento</td>";
    html += "    <td align='right'>"+descuento.toFixed(2)+"</td>  ";  
    html += "</tr>";
    html += "<tr>";
    html += "    <th><b>TOTAL FINAL</b></th>";
    html += "    <th align='right'><font size='5'> "+totalfinal.toFixed(2)+"</font></th>";
    html += "</tr>";
    html += "           </table>";
    html += "   </div>";
    html += "   </div>";


    $("#detallecuenta").html(html); 
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
function buscarporcodigo()
{
   var base_url = document.getElementById('base_url').value;
   var controlador = base_url+'venta/buscarcodigo';
   var codigo = document.getElementById('codigo').value;
    
    document.getElementById('oculto').style.display = 'block'; //mostrar el bloque del loader
    
    //alert('por aqui');
    
    $.ajax({url: controlador,
           type:"POST",
           data:{codigo:codigo},
           success:function(respuesta){     
    
               tablaproductos(); 
               $("#codigo").select();
               
               var resultado = JSON.parse(respuesta);                

                //if(resultado[0]["resultado"] == 1) alert('Todo positivo choco...!');
                if(resultado[0]["detalleing_saldo"] == 0) alert('La cantidad excede la cantidad en inventario...!');
                if(resultado[0]["detalleing_saldo"] == -1) alert('El producto no se encuentra registrado con el código especificado...!!');

                 
           },
           error:function(respuesta){
               alert('ERROR: no existe el producto con el codigo seleccionado o no tiene existencia en inventario...!!');
               
               $("#codigo").select();

           },
            complete: function (respuesta) {
               if (respuesta==null){
                    alert('El producto no se encuentra registrado o se encuentra agostado en inventario..!!!');
                }              
             document.getElementById('oculto').style.display = 'none'; //ocultar el bloque del loader
              $("#codigo").select();
              
            }
        });
           
        
    document.getElementById('oculto').style.display = 'none'; //ocultar el bloque del loader

}

function cantidad_en_detalle(producto_id){
    
   var base_url = document.getElementById('base_url').value;
   var controlador = base_url+'venta/cantidad_en_detalle';
   var res = 0;
   
   $.ajax({url: controlador,
           type:"POST",
           data:{producto_id:producto_id},
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

function existencia(producto_id){
    
   var base_url = document.getElementById('base_url').value;
   var controlador = base_url+'venta/existencia';
   var res = 0;
   
   $.ajax({url: controlador,
           type:"POST",
           data:{producto_id:producto_id},
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

//se encarga de ingresar una cantidad determinada de productos al detalle de la venta en base de id de producto
// la cantidad debe estar registrada en el modal asignada para esta operacion
function ingresardetalle(producto_id)
{

   var base_url = document.getElementById('base_url').value;
   var controlador = base_url+'venta/insertarProducto';
   var cantidad = parseFloat(document.getElementById('cantidad'+producto_id).value);
   var existencia = document.getElementById('existencia'+producto_id).value;
   
   var cantidad_total = parseFloat(cantidad_en_detalle(producto_id)) + cantidad; 
   
   if(cantidad_total <= existencia){
   
        $.ajax({url: controlador,
               type:"POST",
               data:{cantidad:cantidad, producto_id:producto_id, existencia:existencia},
               success:function(respuesta){
                   var resultado = JSON.parse(respuesta);
                  // alert(resultado[0]["resultado"]);
                   tablaproductos();

                  // alert(resultado[0]['resultado']);

               },
               error:function(respuesta){
                   alert('ERROR: no existe el producto con el codigo seleccionado o no tiene existencia en inventario...!!');
                   tablaproductos();
                   $("#codigo").select();
               }
        });

   }
   else alert("ADVERTENCIA: La cantidad excede la existencia del inventario...!!");

}


//esta funcion elimina un item de la tabla detalle de venta
function quitarproducto(producto_id)
{

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/eliminaritem/"+producto_id;

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
    var controlador = base_url+"venta/eliminartodo/";
    $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                tablaproductos();
            }
        
    });
}

//esta funcion incrementar una cantidad determinada de productos
function incrementar(cantidad,detalleven_id)
{    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/incrementar/";
    var producto_id = document.getElementById('productodet_'+detalleven_id).value;
    var cantidad_detalle = cantidad_en_detalle(producto_id)+1;
    var cantidad_disponible =  existencia(producto_id);
    
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

//incrementa productos al detalle de la nota de venta
function incrementar_detalle(cantidad,detalleven_id,venta_id)
{    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/incrementar_detalle/";
   
    $.ajax({url: controlador,
            type:"POST",
            data:{cantidad:cantidad,detalleven_id:detalleven_id,venta_id:venta_id},
            success:function(respuesta){
                tablaproductos();
                tabladetalle();                
            }
        
    });
    location.reload();
}

//esta funcion incrementar una cantidad determinada de productos
function reducir(cantidad,detalleven_id)
{    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/reducir/";
   
    $.ajax({url: controlador,
            type:"POST",
            data:{cantidad:cantidad,detalleven_id:detalleven_id},
            success:function(respuesta){
                tablaproductos();
                tabladetalle();                
            }
        
    });
}

//reduce la cantidad de productos del detalle de venta
function reducir_detalle(cantidad,detalleven_id,venta_id)
{    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/reducir_detalle/";
   
    $.ajax({url: controlador,
            type:"POST",
            data:{cantidad:cantidad,detalleven_id:detalleven_id,venta_id:venta_id},
            success:function(respuesta){
//                tablaproductos();
//                tabladetalle();                
            }
        
    });
   location.reload();    
}


function actualizarprecios(e,detalleven_id)
{
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
    
        var base_url =  document.getElementById('base_url').value;
        var precio = document.getElementById('precio'+detalleven_id).value;
        var cantidad = document.getElementById('cantidad'+detalleven_id).value; 
        var controlador =  base_url+"venta/actualizarprecio";
        $.ajax({url: controlador,
                type:"POST",
                data:{precio:precio, cantidad:cantidad,detalleven_id:detalleven_id},
                success:function(respuesta){
                    tablaproductos();
                    tabladetalle();

                }        
        });
    }
}

function actualizar_cantidad_inventario()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"inventario/actualizar_cantidad_inventario/";

    $.ajax({url: controlador,
        type:"POST",
        data:{},
        success:function(respuesta){     
            alert('El inventario se actualizo exitosamente...! ');
            redirect('inventario/index');
        }
    });        
}

function actualizar_producto_inventario(producto_id)
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"inventario/actualizar_producto";

    $.ajax({url: controlador,
        type:"POST",
        data:{producto_id:producto_id},
        success:function(respuesta){     
           
            //redirect('inventario/index');
        }
    });        
}


function ingresorapido(producto_id,cantidad)
{
    var factor = document.getElementById('select_factor'+producto_id).value;
    
    $("#cantidad"+producto_id).val(cantidad * factor); //establece la cantidad requerida en el modal
    ingresardetalle(producto_id); //llama a la funcion para consolidar la cantidad
    
}

function mostrar_saldo(existencia, producto_id)
{
    var factor_seleccionado = parseInt(document.getElementById('select_factor'+producto_id).value);
    //alert(existencia+" "+producto_id+" "+factor);
    var unidad =document.getElementById('input_unidad'+producto_id).value;
    var unidadfactor = document.getElementById('input_unidadfactor'+producto_id).value;
    var entero = 0;
    var saldo = 0;
  
    
    if (factor_seleccionado == 1)
    {
          
        $("#input_existencia"+producto_id).val(existencia+" "+unidad); //establece la cantidad requerida en el modal

    }
    else
    {
        
                
        var entero = parseInt(existencia / factor_seleccionado);
        var saldo = parseInt(existencia) - parseInt(entero*factor_seleccionado);
        
        $("#input_existencia"+producto_id).val(entero+" "+unidadfactor+"+"+saldo+" "+unidad); //establece la cantidad requerida en el modal
    }
}

//Tabla resultados de la busqueda
function tablaresultados(opcion)
{   
    
    var controlador = "";
    var parametro = "";
    var limite = 50;
    var precio_unidad = 0;
    var precio_factor = 0;
    var precio_factorcant = 0;
    var existencia = 0;
    
    var base_url = document.getElementById('base_url').value;
    
    
    if (opcion == 1){
        controlador = base_url+'salida/buscarproductos/';
        parametro = document.getElementById('filtrar').value        
    }
    
    if (opcion == 2){
        controlador = base_url+'salida/buscarcategorias/';
        parametro = document.getElementById('categoria_prod').value;
    }
    
    document.getElementById('oculto').style.display = 'block'; //mostrar el bloque del loader
    
    $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro},
           success:function(respuesta){     
               
                            alert('sadadsa');         
                $("#encontrados").val("- 0 -");
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){
                   
                   
                    var cont = 0;
                    var cant_total = 0;
                    var total_detalle = 0;
                    var n = registros.length; //tamaño del arreglo de la consulta
                    $("#encontrados").val("- "+n+" -");
                    html = "";
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                    for (var i = 0; i < x ; i++){
                        
                        var mimagen = "";
                        if(registros[i]["producto_foto"] != null && registros[i]["producto_foto"] !=""){
                            mimagen += "<a class='btn  btn-xs' data-toggle='modal' data-target='#mostrarimagen"+i+"' style='padding: 0px;'>";
                            mimagen += "<img src='"+base_url+"resources/images/productos/thumb_"+registros[i]["producto_foto"]+"' class='img img-circle' width='30' height='30' />";
                            mimagen += "</a>";
                            //mimagen = nomfoto.split(".").join("_thumb.");77
                        }else{
                            mimagen = "<img src='"+base_url+"resources/images/productos/thumb_image.png' class='img img-circle' width='30' height='30' />";
                        }
                                             
                        
                        
                        
                        html += "<input type='text' value='"+registros[i]["existencia"]+"' id='existencia"+registros[i]["producto_id"]+"' hidden>";
                        html += "<tr>";
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td><font size='3' face='arial narrow'><b>"+registros[i]["producto_nombre"]+"</b></font>";
                        html += mimagen;   
                        html += "<br>"+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"]+" | "+registros[i]["producto_codigobarra"];
                        html += "<input type='text' id='input_unidad"+registros[i]["producto_id"]+"' value='"+registros[i]["producto_unidad"]+"' hidden>";
                        html += "<input type='text' id='input_unidadfactor"+registros[i]["producto_id"]+"' value='"+registros[i]["producto_unidadfactor"]+"' hidden>";
                        html += "</td>";
                                                
                        html += "<td style='space-white:nowarp'><center> ";                        
                        html += "   <select style='font-size:10px; face=arial narrow;' id='select_factor"+registros[i]["producto_id"]+"' onchange='mostrar_saldo("+registros[i]["existencia"]+","+registros[i]["producto_id"]+")'>";
                        html += "       <option value='1'>";
                        precio_unidad = registros[i]["producto_precio"];
                        html += "           "+registros[i]["producto_unidad"]+" Bs : "+precio_unidad.fixed(2)+"";
                        html += "       </option>";
                        
                        if(registros[i]["producto_factor"]>0){
                            precio_factor = parseFloat(registros[i]["producto_preciofactor"]);
                            precio_factorcant = parseFloat(registros[i]["producto_preciofactor"]) * parseFloat(registros[i]["producto_factor"]);

                            html += "       <option value='"+registros[i]["producto_factor"]+"'>";
                            html += "           "+registros[i]["producto_unidadfactor"]+" Bs: "+precio_factor+"/"+precio_factorcant;
                            html += "       </option>";
                        }
                        
                        
                        html += "   </select>";
                        //html += "<br><font size='3'><b>"+registros[i]["producto_codigobarra"]+"</b></font>";                        
                        existencia = parseFloat(registros[i]["existencia"]);
                        html += "<br><font size='3'><b><input type='text' class='btn btn-default btn-xs' id='input_existencia"+registros[i]["producto_id"]+"' value='DISP: "+existencia+" "+registros[i]["producto_unidad"]+"' readonly='true'></b></font>";
                            if (parseFloat(registros[i]["existencia"])>0){

                                  html += "<br>";
                                  html += "<div class='btn-group'>";
                                  html +=     "<button class='btn btn-success btn-xs' onclick='ingresorapido("+registros[i]['producto_id']+",1)'><b>- 1 -</b></button>";
                                  html +=     "<button class='btn btn-info btn-xs' onclick='ingresorapido("+registros[i]['producto_id']+",2)'><b>- 2 -</b></button>";
                                  html +=     "<button class='btn btn-primary btn-xs' onclick='ingresorapido("+registros[i]['producto_id']+",5)'><b>- 5 -</b></button>";
                                  html +=     "<button class='btn btn-warning btn-xs' onclick='ingresorapido("+registros[i]['producto_id']+",10)'><b>- 10 -</b></button> ";
                                  html += "</div>";   
                            }            
                        html += "</center>";
                        html += "</td>";
                        
//                        html += "<td> ";
//                        html += "<center>";
//
//                       
//                        html += "</center>";
//                        html += "</td>";
                        
                        
                        html += "<td>";
                        if (parseFloat(registros[i]["existencia"])>0){
                             html += "<button type='button' class='btn btn-warning btn-xl' data-toggle='modal' data-target='#myModal"+registros[i]["producto_id"]+"'  title='vender' ><em class='fa fa-cart-arrow-down'></em></button>";                             
                       }
                        
                        //html += "<button class='btn btn-success'><i class='fa fa-picture-o'></i></button>";

                        
                        html += "<!------------------------ INICIO modal para MOSTRAR imagen REAL ------------------->";
                        html += "<div class='modal fade' id='mostrarimagen"+i+"' tabindex='-1' role='dialog' aria-labelledby='mostrarimagenlabel"+i+"'>";
                        html += "<div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "<div class='modal-header'>";
                        html += "<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "<font size='3'><b>"+registros[i]["producto_nombre"]+"</b></font>";
                        html += "</div>";
                        html += "<div class='modal-body'>";
                        html += "<!------------------------------------------------------------------->";
                        html += "<img style='max-height: 100%; max-width: 100%' src='"+base_url+"resources/images/productos/"+registros[i]["producto_foto"]+"' />";
                        html += "<!------------------------------------------------------------------->";
                        html += "</div>";

                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                        html += "<!------------------------ FIN modal para MOSTRAR imagen REAL ------------------->";                       
                       
                       
                       
                        html += "<!---------------------- modal cantidad producto ------------------->";
                        
                        html += "<div class='modal fade' id='myModal"+registros[i]["producto_id"]+"' tabindex='-1' role='dialog' aria-labelledby='myModal"+registros[i]["producto_id"]+"'>";
                        html += "  <div class='modal-dialog' role='document'>";
                        html += "<br><br>";
                        html += "<div class='modal-content'>";
                        html += "  <div class='modal-header'>";
                        html += "       <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>x</span></button>";
                        html += "  </div>";                        
                        html += "  <div class='modal-body'>";
                        
                        html += "  <!----------------------------------------------------------------->";
//                        html += "       <div class='col-md-3'>";
//                        html += "           <img  src='"+base_url+"/"+registros[i]["producto_foto"]+" width='50' heigth='50'>";  
//                        html += "       </div>";
//                        html += "       <div class='col-md-9'>";
                        html += "       <table style='space-white: nowrap;'>";
                        html += "           <tr>";
                        html += "               <td>";
                            
                        html += "               <font size='3'><b>"+registros[i]["producto_nombre"]+"</b></font>";
                        html += "               <br>"+registros[i]["producto_unidad"]+" | "+registros[i]["producto_marca"]+" | "+registros[i]["producto_industria"];
                        html += "               <br><b>  <input type='number' id='cantidad"+registros[i]["producto_id"]+"' name='cantidad"+registros[i]["producto_id"]+"'  value='1' style='font-size:20pt; width:100pt' autofocus='true' min='0' step='1' max='"+registros[i]["existencia"]+"'></b>";
                        
                        html += "               </td>";
                        html += "          </tr>";
                        html += "       </table>";
                        
//                        html += "       </div>";
                        html += "       <!------------------------------------------------------------------->";
                        html += "  </div>";
                        
                        html += "  <div class='modal-footer aligncenter'>";
                        html += "    <input type='text' id='producto_id' name='producto_id' value='"+registros[i]["producto_id"]+"' hidden>";
                        html += "    <input type='text' id='producto_precio' name='producto_precio' value='"+registros[i]["producto_precio"]+"' hidden>";

                        html += "     <!-- button class='btn btn-success btn-foursquarexs' type='submit'><font size='5'><span class='fa fa-cart-arrow-down'></span></font><br><small>Agregar</small></button-->";

                        html += "     <a href='#' data-toggle='modal' data-dismiss='modal' onclick='ingresardetalle("+registros[i]["producto_id"]+")' class='btn btn-success btn-foursquarexs'><font size='5'><span class='fa fa-cart-arrow-down'></span></font><br><small>Agregar</small></a>";

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
    var controlador = base_url+"venta/eliminardetalle/";
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

function registrarcliente()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'venta/registrarcliente';
    var nit = document.getElementById('nit').value;
    var razon = document.getElementById('razon_social').value;
    var telefono = document.getElementById('telefono').value;
    var cliente_nombre = document.getElementById('cliente_nombre').value; 
    var cliente_id = document.getElementById('cliente_id').value; 
   
   
    if (cliente_id > 0 || nit==0){ //si el cliente existe debe actualizar sus datos 
        
        // alert(cliente_id+" * "+nit);
        var controlador = base_url+'venta/modificarcliente';
        $.ajax({url: controlador,
                    type:"POST",
                    data:{nit:nit,razon:razon,telefono:telefono,cliente_id:cliente_id, cliente_nombre:cliente_nombre},
                    success:function(respuesta){ 
                        var datos = JSON.parse(respuesta)
                        cliente_id = datos[0]["cliente_id"];
                        
                        //console.log(datos);
                        
                        if(cliente_id>0){
                            registrarventa(cliente_id);                            
                        }
                        else{
                            registrarventa(respuesta);                            
                        }
                    },
                    error: function(respuesta){
                        cliente_id = 0;            
                    }
        });
        
    }
    else{ //Si el cliente es nuevo debe primero registrar al cliente
    
    
    $.ajax({url: controlador,
            type:"POST",
            data:{nit:nit,razon:razon,telefono:telefono},
            success:function(respuesta){  
            
                var registro = JSON.parse(respuesta);
                
                cliente_id = registro[0]["cliente_id"];
                registrarventa(cliente_id);
                
            },
            error: function(respuesta){
                cliente_id = 0;            
            }
        });
    }
    
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

function registrarventa(cliente_id)
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/registrarventa";    
    
    var forma_id = document.getElementById('forma_pago').value; 
    var tipotrans_id = document.getElementById('tipo_transaccion').value; 
    var usuario_id = document.getElementById('usuario_id').value; 
    var pedido_id = document.getElementById('pedido_id').value; 
    var nit = document.getElementById('nit').value;
    var razon = document.getElementById('razon_social').value;
    
    var moneda_id = 1; 
    var estado_id = 1; 
    
    var venta_fecha = fecha();//retorna la fecha actual  //"date(now())";
    var hora = new Date();
    
    
    var venta_hora = hora.getHours()+":"+hora.getMinutes()+":"+hora.getMinutes();

    
    var venta_subtotal = document.getElementById('venta_subtotal').value;     
    var venta_descuento = document.getElementById('venta_descuento').value; 
    var venta_total = document.getElementById('venta_totalfinal').value; 
    var venta_efectivo = document.getElementById('venta_efectivo').value; 
    var venta_cambio = document.getElementById('venta_cambio').value; 
    var venta_glosa = "'"+document.getElementById('venta_glosa').value+"'"; 
    var venta_comision = document.getElementById('venta_comision').value; 
    var venta_tipocambio = document.getElementById('venta_tipocambio').value; 
    var detalleserv_id = document.getElementById('detalleserv_id').value;
    var tipo_transaccion = document.getElementById('tipo_transaccion').value;
    var cuotas = document.getElementById('cuotas').value;   
    var cuota_inicial = document.getElementById('cuota_inicial').value;
    var credito_interes = document.getElementById('credito_interes').value;
    var facturado = document.getElementById('facturado').checked;
    var venta_tipodoc = 0;

    document.getElementById('boton_finalizar').style.display = 'none'; //mostrar el bloque del loader
   
    if( facturado == 1){     
        venta_tipodoc = 1;}
    else{
        venta_tipodoc = 0;}
    
    var sql =  "insert into venta(forma_id,tipotrans_id,usuario_id,cliente_id,moneda_id,"+
                "estado_id,venta_fecha,venta_hora,venta_subtotal,venta_descuento,venta_total,"+
                "venta_efectivo,venta_cambio,venta_glosa,venta_comision,venta_tipocambio,detalleserv_id,venta_tipodoc) value("+
                forma_id+","+tipotrans_id+","+usuario_id+","+cliente_id
                +","+moneda_id+","+estado_id+",'"+venta_fecha+"','"+venta_hora+"',"+venta_subtotal
                +","+venta_descuento+","+venta_total+","+venta_efectivo+","+venta_cambio+","+venta_glosa
                +","+venta_comision+","+venta_tipocambio+","+detalleserv_id+","+venta_tipodoc+")";
        
       // alert(sql);
    if (tipo_transaccion==2){
        var cuotas = document.getElementById('cuotas').value;
        var modalidad = document.getElementById('modalidad').value;
        var dia_pago = document.getElementById('dia_pago').value;
        var fecha_inicio = document.getElementById('fecha_inicio').value;
        
        $.ajax({url: controlador,
            type:"POST",
            data:{sql:sql, tipo_transaccion:tipo_transaccion, cuotas:cuotas, cuota_inicial:cuota_inicial, 
                venta_total:venta_total, credito_interes:credito_interes, pedido_id:pedido_id,
                facturado:facturado,venta_fecha:venta_fecha, razon:razon, nit:nit,
                cuotas:cuotas, modalidad:modalidad, dia_pago:dia_pago, fecha_inicio: fecha_inicio,
                venta_descuento:venta_descuento },
            success:function(respuesta){ 
                eliminardetalleventa();

            },
            error: function(respuesta){
                alert("Revise los datos de la venta por favor...!");   
            }        
        });   
    
    }
    else
    {
        $.ajax({url: controlador,
            type:"POST",
            data:{sql:sql, tipo_transaccion:tipo_transaccion, cuotas:cuotas, cuota_inicial:cuota_inicial, 
                venta_total:venta_total, credito_interes:credito_interes, pedido_id:pedido_id,
                facturado:facturado,venta_fecha:venta_fecha, razon:razon, nit:nit, venta_descuento:venta_descuento},
            success:function(respuesta){ 
                eliminardetalleventa();

            },
            error: function(respuesta){
                alert("Revise los datos de la venta por favor...!");   
            }
        });          
    }
        
}

function finalizarventa()
{
    
    var monto = document.getElementById('venta_totalfinal').value;
    
    
    if (monto>0)
    {
       document.getElementById('divventas0').style.display = 'none'; //ocultar el vid de ventas 
       document.getElementById('divventas1').style.display = 'block'; // mostrar el div de loader
        registrarcliente();
    }
    else
    {
        
        //alert('ADVERTENCIA: No tiene registrado ningun producto en el detalle...!!');
        
        var txt;
        var r = confirm("La venta no tiene ningun detalle o los precios estan en Bs 0.00. \n ¿Desea Continuar?");
        if (r == true) {
            document.getElementById('divventas0').style.display = 'none'; //ocultar el vid de ventas 
            document.getElementById('divventas1').style.display = 'block'; // mostrar el div de loader   
          registrarcliente();
        } 
        //document.getElementById("demo").innerHTML = txt;
      }

}

function mostrar_ocultar_buscador(parametro){
       
    if (parametro == "mostrar"){
        document.getElementById('buscador_oculto').style.display = 'block';}
    else{
        document.getElementById('buscador_oculto').style.display = 'none';}
    
}

function buscar_ventas()
{
    var base_url    = document.getElementById('base_url').value;
    //var controlador = base_url+"venta";
    var opcion      = document.getElementById('select_ventas').value;
 
    
    if (opcion == 1)
    {
        filtro = " and v.venta_fecha = date(now())";
        mostrar_ocultar_buscador("ocultar");
        
        
    }//pedidos de hoy
    
    if (opcion == 2)
    {
        filtro = " and v.venta_fecha = date_add(date(now()), INTERVAL -1 DAY)";
        mostrar_ocultar_buscador("ocultar");
    }//pedidos de ayer
    
    if (opcion == 3) 
    {
        filtro = " and v.venta_fecha >= date_add(date(now()), INTERVAL -1 WEEK)";//pedidos de la semana
        mostrar_ocultar_buscador("ocultar");
    }
    
    if (opcion == 4) 
    {   filtro = " ";//todos los pedidos
        mostrar_ocultar_buscador("ocultar");
    }
    
    if (opcion == 5) {

        mostrar_ocultar_buscador("mostrar");
        filtro = null;
    }

    tabla_ventas(filtro);
    //tabla_pedidos(filtro);
}

function buscar_por_fecha()
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"pedido";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var estado_id = document.getElementById('estado_id').value;
    
    filtro = " and date(pedido_fecha) >= '"+fecha_desde+"'  and  date(pedido_fecha) <='"+fecha_hasta+
            "' and p.estado_id = "+estado_id;
    tabla_pedidos(filtro);

}

function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}

function ventas_por_fecha()
{
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"venta/mostrar_ventas";
    var fecha_desde = document.getElementById('fecha_desde').value;
    var fecha_hasta = document.getElementById('fecha_hasta').value;
    var estado_id = document.getElementById('estado_id').value;
    var usuario_id = document.getElementById('usuario_id').value;
    
    filtro = " and v.venta_fecha >= '"+fecha_desde+"'  and  v.venta_fecha <='"+fecha_hasta+
            "' and v.estado_id = "+estado_id;
    
    if (usuario_id > 0){
        filtro += " and v.usuario_id = "+usuario_id;
    } 
    
   // alert(filtro)
    tabla_ventas(filtro);

}

function tabla_ventas(filtro)
{   
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+"venta/mostrar_ventas";
    
    document.getElementById('oculto').style.display = 'block'; //mostrar el bloque del loader
    
    $.ajax({url:controlador,
        type:"POST",
        data:{filtro:filtro},
        success: function(response){
            //alert("llega hasta aqui...!");
            //console.log(response);
            
            var cont =  0;
            var cantidad_pedidos = 0;
            var total_pedido = 0;
            var v = JSON.parse(response);
                
                $("#parametro").val(filtro); // se enviar el parametro a un text para usarlo desde otro metodo despues
                
            
                html = "";

                    var cont = 0;
                    var total_final = 0;
                    
                    
                for (var i=0; i< v.length; i++){    

                    cont = cont + 1; 
                    total_final += parseFloat(v[i]['venta_total']);

                    html += "                       <tr>";
                    html += "                       <td>"+cont+"</td>";
                    
                    html += "                       <td style='max-width: 5cm'><font size='3'><b> "+v[i]['cliente_nombre']+"</b></font><sub>  ["+v[i]['cliente_id']+"]</sub>";
                    html += "                           <br>Razón Soc.: "+v[i]['cliente_razon'];
                    html += "                           <br>NIT: "+v[i]['cliente_nit'];
                    html += "                           <br>Telefono(s): "+v[i]['cliente_telefono'];
                    html += "                           <br>Nota: "+v[i]['venta_glosa'];
                    html += "                       </td>";

                    html += "                       <td style='withe-space:nowrap' align='right' >";
                    html += "                           Sub Total "+v[i]['moneda_descripcion']+': '+v[i]['venta_subtotal']+"<br>";
                    html += "                           Desc. "+v[i]['moneda_descripcion']+': '+v[i]['venta_descuento']+"<br>";
                    html += "                           <!--<span class='btn btn-facebook'>-->";
                    html += "                           <font size='3' face='Arial narrow'> <b>Total "+v[i]['moneda_descripcion']+': '+v[i]['venta_total']+"</b></font><br>";
                    html += "                           <!--</span>-->";
                    html += "                               Efectivo "+v[i]['moneda_descripcion']+": "+v[i]['venta_efectivo']+"<br>";
                    html += "                               Cambio "+v[i]['moneda_descripcion']+": "+v[i]['venta_cambio'];
                    html += "                       </td>";

                    html += "                       <td align='center'><font size='3'><b> 00"+v[i]['venta_id']+"</b></font>";
                    html += "                           <br><img src='"+base_url+"resources/images/usuarios/thumb_"+v[i]['usuario_imagen']+"' class='img-circle' width='50' height='50'>";
                    html += "                           <br>"+v[i]['usuario_nombre'];
                    html += "                        </td>   ";
                    
                    html += "                       <td align='center'  bgcolor='"+v[i]['estado_color']+"'>"+v[i]['forma_nombre'];
                    html += "                           <br> "+v[i]['tipotrans_nombre'];
                    html += "                           <br><br><span class='btn btn-facebook btn-xs' ><b>"+v[i]['estado_descripcion']+"</b></span> ";
                    html += "                       </td>";

                    html += "                       <td><center>"+formato_fecha(v[i]['venta_fecha']);
                    html += "                           <br> "+v[i]['venta_hora'];
                    html += "                           <br><input type='button' class='btn btn-warning btn-xs' id='boton"+v[i]['venta_id']+"' value='--' style='display:block'>";
                    
                    html += "                       </center>";
                    html += "                       </td>";

//                    html += "                       <td align='center'>";
//                    html += "                           <img src='"+base_url+"resources/images/usuarios/thumb_"+v[i]['usuario_imagen']+"' class='img-circle' width='50' height='50'>";
//                    html += "                           <br>"+v[i]['usuario_nombre'];
//                    html += "                       </td>";

                    html += "                       <td class='no-print'>";
                    html += "                           <a href='"+base_url+"venta/edit/"+v[i]['venta_id']+"' class='btn btn-info btn-xs no-print'><span class='fa fa-pencil'></span></a>";
                    html += "                           <a href='"+base_url+"venta/nota_venta/"+v[i]['venta_id']+"' class='btn btn-success btn-xs'><span class='fa fa-print'></span></a> ";
                    html += "                           <!--<a href='<?php echo site_url('venta/eliminar_venta/'.$v[i]['venta_id']); ?>' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span></a>-->";
                    html += "                           <br><br><button type='button' class='btn btn-danger btn-xs' data-toggle='modal' data-target='#myModal"+v[i]['venta_id']+"'  title='Eliminar'><em class='fa fa-trash'></em></button>";
                    html += "                       <!------------------------ modal para eliminar el producto ------------------->";
                    html += "                               <div class='modal fade' id='myModal"+v[i]['venta_id']+"' tabindex='-1' role='dialog' aria-labelledby='myModalLabel"+v[i]['venta_id']+"'>";
                    html += "                                 <div class='modal-dialog' role='document'>";
                    html += "                                       <br><br>";
                    html += "                                   <div class='modal-content'>";
                    html += "                                     <div class='modal-header'>";
                    html += "                                       <h1 class='modal-title' id='myModalLabel'>ADVERTENCIA</h1>";
                    html += "                                     </div>";
                    html += "                                     <div class='modal-body'>";
                    html += "                                         <div class='panel panel-primary'>";
                    html += "                                             ";
                    html += "                                         <center>";
                    html += "                                      <!------------------------------------------------------------------->";
                    html += "                                      <h1 style='font-size: 80px'> <b> <em class='fa fa-trash'></em></b></h1> ";
                    html += "                                      <h4>";
                    html += "                                          ";
                    html += "                                          ¿Desea anular la venta? <b> <br>";
                    html += "                                          Trans.: "+v[i]['venta_id']+"<br>";
//                    html += "                                          -----------------------------<br>";
//                    html += "                                          La venta tiene una FACTURA ASOCIADA<br>";
//                    html += "                                          <input type='checkbox' name='anular_factura' value='1'> Anular factura<br>";
                    html += "                                      </h4>";
                    html += "                                      <!------------------------------------------------------------------->";
                    html += "                                             ";
                    html += "                                         </center>";
                    html += "                                         </div>";
                    html += "                                     </div>";
                    html += "                                     <div class='modal-footer aligncenter'>";
                    html += "                                         <center>";                                        
                    html += "                                           <a href='"+base_url+"venta/anular_venta/"+v[i]['venta_id']+"' class='btn btn-danger  btn-sm'><em class='fa fa-pencil'></em> Si </a>";

                    html += "                                           <a href='#' class='btn btn-success btn-sm' data-dismiss='modal'><em class='fa fa-times'></em> No </a>";
                    html += "                                         </center>";

                    html += "                                     </div>";
                    html += "                                   </div>";
                    html += "                                 </div>";
                    html += "                               </div>";

                    html += " <!------------------------ fin modal --------------------------------->   ";                       

                    html += "                           ";
//                    html += "                           <?php if ($parametro[0]['parametro_tipoimpresora']=='FACTURADORA'){ ?>";
//                    html += "                                       <?php if($v[i]['venta_tipodoc']){ $formato_boton = 'btn btn-warning btn-xs'; $mensaje_title = 'Ver factura';} ";
//                    html += "                                           else { $formato_boton = 'btn btn-facebook btn-xs';  $mensaje_title = 'Ver nota de venta'; }";
//                    html += "                                       ?>";
//                    html += "                                   ";
                    if (v[i]['venta_tipodoc']==1)
                        html += "                                   <a href='"+base_url+"factura/factura_boucher/"+v[i]['venta_id']+"' class='btn btn-warning btn-xs' title='Ver factura/Nota de venta'><span class='fa fa-list-alt'></span></a> ";
//                    html += "                           ";
//                    html += "                           <?php } else{ ?>";
//                    html += "                                   ";
//                    html += "                                   <a href='<?php echo site_url('factura/factura_carta/'.$v[i]['venta_id']); ?>' class='<?php echo $formato_boton; ?>' title='<?php echo $mensaje_title; ?>'><span class='fa fa-list-alt'></span></a>";
//                    html += "                           ";
//                    html += "                           <?php } ?>";
                    html += "                       </td>";
                    html += "                    </tr>";
//                    html += "                    <?php } ?>";
                }
                    html += "                   <tr>";
                    html += "                        <th></th>";
                    html += "                        <th>Totales</th>";
                    html += "                        <th><font size='3'> Bs: "+total_final.toFixed(2)+"</font></th>	";
                    html += "                        <th></th>";
                    html += "                        <th></th>";
                    html += "                        <th></th>";
                    html += "                        <th></th>";
                  
                    html += "                    </tr> ";
            $("#tabla_ventas").html(html);
            document.getElementById('oculto').style.display = 'none'; //mostrar el bloque del loader
        }        
    });
    
}

function montrar_ocultar_fila(parametro)
{
           
    if (parametro == "mostrar"){
        document.getElementById('fila_producto').style.display = 'block';}
    else{
        document.getElementById('fila_producto').style.display = 'none';}
    
}

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

function eliminar_producto_vendido(detalleven_id)
{
    var base_url    = document.getElementById('base_url').value;
    var controlador =  base_url+"venta/eliminar_producto_vendido/"+detalleven_id;
    
    $.ajax({url:controlador,
        type:"POST",
        data:{},
        success: function(response){ 
            
                
                }
            });
            
    location.reload();
}

function borrar_datos_cliente()
{
    $("#nit").val(0);
    $("#razon_social").val("SIN NOMBRE");
    $("#cliente_id").val("0");
    $("#cliente_nombre").val("SIN NOMBRE");
    $("#cliente_ci").val("0");
    $("#cliente_nombrenegocio").val("-");
    $("#cliente_codigo").val("0");
    $("#venta_efectivo").val("0");
    $("#venta_cambio").val("0");
    
    document.getElementById("forma_pago").selectedIndex = 0
    document.getElementById("tipo_transaccion").selectedIndex = 0
    document.getElementById("tipo_transaccion").selectedIndex = 0
    
    
    $("#filtrar").focus();
    
    
    
    var facturado = document.getElementById('facturado').checked;      

    //Imprimir la factura
    if (facturado == 1){
        var boton = document.getElementById("imprimir");
        boton.click();                    
    } 
    
    document.getElementById('boton_finalizar').style.display = 'block'; //mostrar el bloque del loader
    tablaproductos();
    
    tablaresultados(1); //redibuja la tabla de busqueda de productos      
    
    document.getElementById('divventas0').style.display = 'block'; //ocultar el vid de ventas 
    document.getElementById('divventas1').style.display = 'none'; // mostrar el div de loader
}


function verificar_ventas()
{
    var base_url = document.getElementById('base_url').value;    
    var parametro = document.getElementById('parametro').value;
    var controlador = base_url+'venta/verificar_ventas';        
            
//            var res = JSON.parse(parametro = document.getElementById('ventas').value);
//            var max = res.length;
//            
//            for (var i = 0; i<max; i++){
//                
//                
//                
//                if (res[i]["resultado"] == 1){
//                    
//                    botoncito = "#boton"+res[i]["venta_id"];
//                    document.getElementById(botoncito).style.display = 'block'; 
//                    $(botoncito).val("CONFLICTO");
//                    
//                }
//                else{
//                    
//                    botoncito = "#boton"+res[i]["venta_id"];
//                    document.getElementById(botoncito).style.display = 'block'; 
//                    $(botoncito).val("CONRRECTO");
//                    
//                }
//            }
            
            
    $.ajax({url: controlador,
        type:"POST",
        data:{filtro: filtro},
        success:function(respuesta){
            
            var res = JSON.parse(respuesta);
            var max = res.length;
            var precio_anterior = 0;
            var precio_nuevo = 0;
            var duplicado = 0;
            
            for (var i = 0; i<max; i++){
                
                precio_nuevo = res[i]["venta"];
                
                if(precio_nuevo == precio_anterior)
                    duplicado = "DUPLICADO";
                else
                    duplicado = "";
                
                if (res[i]["resultado"] == 1){
                    
                    botoncito = "#boton"+res[i]["venta_id"];                    
//                    nombreboton = "boton"+res[i]["venta_id"];                    
                   //botoncito2 = "boton"+res[i]["venta_id"];
                    
                    $(botoncito).val("CONFLICTO | Items: "+res[i]["items"]+"\n"+duplicado);
//                    document.getElementById(nombreboton).style.display = 'block';                                        
                    
                }
                else{
                    
                    botoncito = "#boton"+res[i]["venta_id"];
                    
//                    document.getElementById(botoncito).style.display = 'block'; 
                    $(botoncito).val(" - OK - | Items: "+res[i]["items"]+"\n"+duplicado);
                   
                    
                }
                precio_anterior = precio_nuevo;                                
            }
          
           // document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader

        },
        complete: function (jqXHR, textStatus) {
        //    document.getElementById('loader').style.display = 'none'; //ocultar el bloque del loader 
        }
    });   
      
}

function costo_cero()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/costo_cero";
    var txt;
    var r = confirm("Los precios y costos serán cambiados a 0 (cero).\n Esta operación no será reversible.\n¿Desea Continuar?");
    if (r == true) {
    
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
}

function precio_costo()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/precio_costo";
    var txt;
    var r = confirm("Los precios de venta serán igualados al costo. \n Esta operación no será reversible.\n¿Desea Continuar?");
    if (r == true) {
    
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
}

function buscar_clientes()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/buscar_clientes";
    var parametro = document.getElementById('razon_social').value;
    
        $.ajax({url: controlador,
            type:"POST",
            data:{parametro:parametro},
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                fin = resultado.length;
                html = "";
                
                for(var i = 0; i<fin; i++)
                {
                    html += "<option value='" +resultado[i]["cliente_id"]+"' label='"+resultado[i]["cliente_nombre"];
                    if (resultado[i]["cliente_nombrenegocio"]!=null)
                    {    html += " ("+resultado[i]["cliente_nombrenegocio"]+")"; }
                    html += "'>"+resultado[i]["cliente_razon"]+"</option>";
                }    
                $("#listaclientes").html(html);

            },
            error: function(respuesta){
            }
        });
}

function seleccionar_cliente(){
    var cliente_id = document.getElementById('razon_social').value;
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/seleccionar_cliente/"+cliente_id;
    //alert(controlador);
        $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                
                resultado = JSON.parse(respuesta);
                tam = resultado.length;
                
//                alert(resultado[0]["cliente_nit"]);
                
                if (tam>=1){
                    $("#cliente_id").val(resultado[0]["cliente_id"]);
                    $("#nit").val(resultado[0]["cliente_nit"]);
                    $("#razon_social").val(resultado[0]["cliente_razon"]);
                    $("#cliente_nombrenegocio").val(resultado[0]["cliente_nombrenegocio"]);
                    $("#cliente_nombre").val(resultado[0]["cliente_nombre"]);
                    $("#telefono").val(resultado[0]["cliente_telefono"]);
                    $("#cliente_ci").val(resultado[0]["cliente_ci"]);     
                    $("#cliente_codigo").val(resultado[0]["cliente_codigo"]);  
                    $("#tipocliente_id").val(resultado[0]["tipocliente_id"]);  
                    $("#codigo").select();
                    
                }
       

            },
            error: function(respuesta){
            }
        });    
    
}
function pasaraventas(pedido_id,usuariopedido_id,cliente_id)
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"pedido/pasaraventas/"+pedido_id+"/"+cliente_id;
   
    $.ajax({url: controlador,
        type:"POST",
        data:{},
        success:function(respuesta){  
            
            $("#pedido_id").val(pedido_id);
            $("#usuariopedido_id").val(usuariopedido_id);
            tablaproductos();
            datoscliente(cliente_id);           
        },
        error: function(respuesta){
            tablaproductos();
            datoscliente(cliente_id);
        }
    });
   
}


function datoscliente(cliente_id)
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"pedido/datoscliente";

    $.ajax({url: controlador,
        type:"POST",
        data:{cliente_id:cliente_id},
        success:function(result){          
            var datos = JSON.parse(result);            
            //console.log(datos);            
            $("#cliente_id").val(datos[0]["cliente_id"]);
            $("#nit").val(datos[0]["cliente_nit"]);
            $("#razon_social").val(datos[0]["cliente_razon"]);
            $("#telefono").val(datos[0]["cliente_telefono"]);
        }
        
    });
   
}   

function actualizar_caracteristicas(detalleven_id)
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"venta/registrar_caracteristicas";
    var preferencia = document.getElementById('detalleven_preferencia'+detalleven_id).value;
    //alert(preferencia);
    var caracteristicas = document.getElementById('detalleven_caracteristicas'+detalleven_id).value;
    
    //alert(preferencia+" "+caracteristicas);
    
    $.ajax({url: controlador,
        type:"POST",
        data:{detalleven_id:detalleven_id, preferencia:preferencia, caracteristicas:caracteristicas},
        success:function(result){
            tablaproductos();
        }

    });
   
}   

function verificador()
{
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+"factura/codigocontrol";
    
    var llave = document.getElementById('factura_llave').value;
    var autorizacion = document.getElementById('factura_autorizacion').value;
    var numero = document.getElementById('factura_numero').value;
    var nit = document.getElementById('factura_nit').value;
    var fecha = document.getElementById('factura_fecha').value;
    var monto = document.getElementById('factura_total').value;
    var bandera = 1;
    
    
    //alert(llave+" | "+autorizacion+" | "+numero+" | "+nit+" | "+fecha+" | "+monto);
    
    
    $.ajax({url: controlador,
        type:"POST",
        data:{llave:llave,autorizacion:autorizacion,numero:numero,nit:nit,fecha:fecha,monto:monto, bandera:bandera},
        success:function(result){
            var codigo = eval(result);
           // alert(codigo);
            $('#factura_codigocontrol').val(codigo[0]['codigocontrol']);
            
        }

    });
   
}   
