$(document).on("ready",inicio);
function inicio(){
        
        
        tabladetalleingreso(); 
        //tablatotales();
        
}

function tabladetalleingreso(){
     var controlador = "";
     var limite = 500;
     var base_url = document.getElementById('base_url').value;
     var ingreso_id = document.getElementById('ingreso_idie').value;
     
     controlador = base_url+'ingreso/detalleingreso/';

     $.ajax({url: controlador,
           type:"POST",
           data:{ingreso_id:ingreso_id},
           success:function(respuesta){     
               
                                     
               
               var registros =  JSON.parse(respuesta);
                
               if (registros != null){                   
                   
                    var n = registros.length; //tamaÃ±o del arreglo de la consulta
                    var total_detalle = Number(0);
                    var suma = Number(0);
                    
                    html = "";
                   if (n <= limite) x = n; 
                   else x = limite;
                    
                    for (var i = 0; i < x ; i++){
                        
                        var suma = Number(registros[i]["detalleing_total"]);
                        //descuento += Number(registros[i]["detalleing_descuento"]);
                        //subtotal += Number(registros[i]["detalleing_subtotal"]);
                        total_detalle = Number(total_detalle+suma); 
                        html += "<tr>";
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td style='font-size:10px; width:200px;'><b>"+registros[i]["articulo_nombre"]+" /</b>";
                        
                        html += "<b> Cod: "+registros[i]["articulo_codigo"]+"</td>";                                            
                       
                        html += "<td style='width:200px;'><input id='ingreso_identi'  name='ingreso_id' type='hidden' class='form-control' value='"+ingreso_id+"'>";
                        html += "<input id='articulo_identi'  name='articulo_id' type='hidden' class='form-control' value='"+registros[i]["articulo_id"]+"'>" ;
                        
                        html += "<input  class='input-sm' style='font-size:13px; width:100%;' id='detalleing_precio"+registros[i]["articulo_id"]+"'  name='articulo_precio"+registros[i]["articulo_id"]+"' type='text'  class='form-control' onkeypress='return pulsar(event)' value='"+Number(registros[i]["detalleing_precio"]).toFixed(2)+"'  ></td>"; 
                        
                        html += "<td style='width:150px;'><input  class='input-sm' style='font-size:13px;width:100%;' id='detalleing_cantidad"+registros[i]["articulo_id"]+"'  name='cantidad' type='text' autocomplete='off' class='form-control' value='"+registros[i]["detalleing_cantidad"]+"' onkeypress='return pulsar(event)'>";
                        html += "<input id='detalleing_id'  name='detalleing_id' type='hidden' class='form-control' value='"+registros[i]["detalleing_id"]+"'></td>";
                       
                        html += "<td style='width:150px;'><center>";
                        html += "<span class='badge badge-success'>";
                        html += "<font size='2'> <b>"+Number(registros[i]["detalleing_total"]).toFixed(2)+"</b></font> <br>";
                        html += "</span></center></td>";
                        
                        html += "<td style='padding-left:4px; padding-right:4px;'><button type='button' title='MODIFICAR' onclick='editadetalle("+registros[i]["detalleing_id"]+","+registros[i]["articulo_id"]+","+ingreso_id+")' class='btn btn-success btn-sm'><span class='fa fa-save'></span></button>";

                        
                        html += "<td style='padding-left:4px; padding-right:4px;'><button type='button' title='ELIMINAR' onclick='quitardetalle("+registros[i]["detalleing_id"]+")' class='btn btn-danger btn-sm'><span class='fa fa-trash'></span></button>";
                        html += "</td>";
                    }
                   $("#tabladetalleingreso").html(html);
                  tablatotales(total_detalle);
                   
                }

        },
        error:function(respuesta){
          
        }
        
    });
}


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
    var ingreso_id = document.getElementById('ingreso_id').value;
    var limite = 200;
    var base_url = document.getElementById('base_url').value;
    //var bandera = document.getElementById('bandera').value;
    
    if (opcion == 1){
        controlador = base_url+'ingreso/buscaringreso/';
        parametro = document.getElementById('articulobus').value 
        
    }
   
       $.ajax({url: controlador,
           type:"POST",
           data:{parametro:parametro},
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
                    
                    for (var i = 0; i < x ; i++){
                       
                        html += "<tr>";
                       // "echo form_open('ingreso/insertararticulo/')"; 
                      
                        html += "<td>"+(i+1)+"</td>";
                        html += "<td>";
                        //html += "<form action='"+base_url+"ingreso/ingresararticulo/'  method='POST' class='form'>";
                        html += "<div clas='row'>";                                            
                        html += "<div class='container' hidden>";
                       // html += "<input id='ingreso_id1'  name='ingreso_id' type='text' class='form-control' value='"+ingreso_id+"'>";
                       //html += "<input id='articulo_iddetalle'  name='articulo_id' type='text' class='form-control' value='"+registros[i]["articulo_id"]+"'>";
                        //html += "<input id='descripcion'  name='descripcion' type='text' class='form-control' value='"+registros[i]["articulo_nombre"]+","+registros[i]["articulo_marca"]+","+registros[i]["articulo_industria"]+"'>";
                        //html += "<input id='detalle_costo'  name='detalle_costo' type='text' class='form-control' value='"+registros[i]["articulo_costo"]+"'>";
                        //html += "<input id='articulo_codigue'  name='articulo_codigo' type='hidden' class='form-control' value='"+registros[i]["articulo_codigo"]+"'>";
                        //html += "<input id='articulo_unidade'  name='articulo_unidad' type='hidden' class='form-control' value='"+registros[i]["articulo_unidad"]+"'>";
                        html += "</div>";
                            
                        html += "<div class='col-md-12' style='padding-left: 0px;'>";

                        html += "<b><font size=2>"+registros[i]["articulo_nombre"]+"</font>    ("+registros[i]["articulo_codigo"]+")</b>  <span class='btn btn-facebook btn-xs'>"+Number(registros[i]["articulo_saldo"]).toFixed(2)+"</span><br>";
                        html += "<div class='col-md-4' style='padding-left: 0px;' >";
                        html += "Precio: <input class='input-sm' id='articulo_preciodetalle"+registros[i]["articulo_id"]+"'  style='width: 80px;  autocomplete='off' name='articulo_precio' type='number' step='0.01' class='form-control' value='"+registros[i]["articulo_precio"]+"' ></div>";
                       // html += "<div class='col-md-2' style='padding-left: 0px;'>";
                       // html += "Costo: <input class='input-sm' id='articulo_costodetalle"+registros[i]["articulo_id"]+"'  style='width: 80px; background-color: lightgrey' autocomplete='off' name='articulo_costo' type='number' step='0.01' class='form-control' value='"+registros[i]["articulo_ultimocosto"]+"' > </div>";
                        //html += "<div class='col-md-2' style='padding-left: 0px;' >";
                        //html += "Desc.: <input class='input-sm' id='descuentodetalle"+registros[i]["articulo_id"]+"'  style='width: 60px; background-color: lightgrey' autocomplete='off' name='descuento' type='number' class='form-control' value='0.00' step='.01' required ></div>";
                        html += "<div class='col-md-4'style='padding-left: 0px;'  >";
                        html += "Cantidad: <input class='input-sm ' id='cantidaddetalle"+registros[i]["articulo_id"]+"' style='width: 80px;' name='cantidad' type='number' autocomplete='off' class='form-control' placeholder='cantidad' required value='1'> </div>";
                        //html += "<div class='col-md-2' style='padding-left: 0px;' >";
                       // html += "F.Venc.:<input class='input-sm ' type='date' id='detalleing_fechavencimiento"+registros[i]["articulo_id"]+"' style='width: 110px;padding-left: 0px;' name='detalleing_fechavencimiento'  class='form-control' ></div>";
                        html += "<div class='col-md-2'>";
                        html += "Ingresar:";

                        html += "<button type='button' onclick='detalleingreso("+ingreso_id+","+registros[i]["articulo_id"]+")' class='btn btn-success'><i class='fa fa-cart-plus'></i></button>";
                        //html += "<a href=''  onclick='submit()' class='btn btn-danger'><span class='fa fa-cart-arrow-down'></span></a>";
                        
                        html += "</div>";
                        html += "</div>";
                        html += "</div>";
                       // html += "</form>";
                        html += "</td>";
                      //  "echo form_close()";
                       
                        html += "</tr>";

                   }
                 
                   
                   $("#tablaresultados").html(html);
                   
            }
                
        },
        error:function(respuesta){
           // alert("Algo salio mal...!!!");
           html = "";
           $("#tablaresultados").html(html);
        }
        
    });   

}

function detalleingreso(ingreso_id,articulo_id){
       
        var controlador = "";
        var cantidad = document.getElementById('cantidaddetalle'+articulo_id).value; 
        var articulo_precio = document.getElementById('articulo_preciodetalle'+articulo_id).value;

    var limite = 500;
    var base_url = document.getElementById('base_url').value;
    controlador = base_url+'ingreso/ingresararticulo/';
   
    
    $.ajax({url: controlador,
           type:"POST",
           data:{ingreso_id:ingreso_id, articulo_id:articulo_id, cantidad:cantidad, articulo_precio:articulo_precio},
           success:function(respuesta){     
               
               tabladetalleingreso();                      
            
        }
        
    });
} 

function editadetalle(detalleing_id,articulo_id,ingreso_id){
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'ingreso/updateDetalle/';
    var precio = document.getElementById('detalleing_precio'+articulo_id).value;
    var cantidad = document.getElementById('detalleing_cantidad'+articulo_id).value;    
    
    $.ajax({url: controlador,
            type:"POST",
            data:{detalleing_id:detalleing_id,precio:precio,cantidad:cantidad,articulo_id:articulo_id,ingreso_id:ingreso_id},
            success:function(respuesta){
                tabladetalleingreso();
            }        
    });

} 
function quitardetalle(detalleing_id){

    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'ingreso/quitar/'+detalleing_id;

    $.ajax({url: controlador,
            type:"POST",
            data:{},
            success:function(respuesta){
                tabladetalleingreso();
            }        
    });

}
function tablatotales(total_detalle)
{

     var totalfinal = Number(total_detalle);
    
    $("#ingreso_totalfinal").val(totalfinal.toFixed(2));
   
     html = "";
     html += "<table><tr>";
     html += "<th><b>TOTAL FINAL Bs.:</b></th><td width='30px'></td>";
     html += "<th style='text-align: right;'><font size='3'><b>"+totalfinal.toFixed(2)+"</b></font></th>";
     html += "</tr></table>";
 
    $("#detalleco").html(html); 
}

function seleccionar(opcion) {
    
        if (opcion==1){             
        var proveedor=document.getElementById('proveedor_id').value;
        var ingreso_id = document.getElementById('ingreso_id').value;
           
            cambiarproveedores(ingreso_id,proveedor);
        }
}

function cambiarproveedores(ingreso_id,proveedor_id) {
     
    var base_url    = document.getElementById('base_url').value;
    var controlador = base_url+'ingreso/cambiarproveedor/';
    var limite = 500;
    //var nit = document.getElementById('proveedor_nit'+proveedor_id).value;
             //   var razon_social = document.getElementById('proveedor_razon'+proveedor_id).value;
                //var codigo_control = document.getElementById('proveedor_codigo'+proveedor_id).value;
                //var autorzacion = document.getElementById('proveedor_autorizacion'+proveedor_id).value;
     alert(proveedor_id);          
    $.ajax({url: controlador,
           type:"POST",
           data:{ingreso_id:ingreso_id,proveedor_id:proveedor_id},
           success:function(respuesta){ 
               var registros =  JSON.parse(respuesta);
              if (registros != null){
                var n = registros.length;
                var p = 0;
               
               html = "";   

                    html = registros[p]['proveedor_nombre'];
                     $("#provedordeingreso").html(html);

            
                        }
             },
            error:function(respuesta){
           html = "";
           $("#provedordeingreso").html(html);
          
} 
            });   

 

}