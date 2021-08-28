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
               if (registros == "no"){
                   alert('No existe Inventario para este programa hasta esta fecha.');
               }else{
                    var cant_total = 0;
                    var n = registros.length;
                    var estilo =  "style='font-size:12px'";
                    html = "";
                    html += "<table style='width: 19.59cm' class='table table-striped' id='mitabla'>";
                    html += "<tr>";
                    html += "<th "+estilo+">#</th>";
                    html += "<th "+estilo+">DETALLE</th>";
                    html += "<th "+estilo+">UNIDAD</th>";
                    html += "<th "+estilo+">CODIGO</th>";
                    html += "<th "+estilo+">CANT.</th>";
                    html += " <th "+estilo+">PREC. UNIT.<br>Bs.</th>";
                    html += "<th "+estilo+">PREC. TOTAL<br>Bs.</th>";
                    html += "</tr>";
                    var num = 0;
                    
                    html += "<tbody class='buscar' id='tablaresultados'>";
                    
                    for(var i = 0; i < n ; i++){
                        if(registros[i]["saldos"]>0){
                            html += "<tr>";
                            cant_total = Number(cant_total)+Number(Number(registros[i]["precio_unitario"]*Number(registros[i]["saldos"])))
                            html += "<td "+estilo+">"+(num+1)+"</td>";
                            html += "<td "+estilo+">"+registros[i]["articulo_nombre"]+"<sub class='no-print'><small>["+registros[i]["articulo_id"]+"]</small></sub>  </td>";
                            html += "<td class='text-center' "+estilo+">"+registros[i]["articulo_unidad"]+"</td>";
                            html += "<td class='text-center' "+estilo+">"+registros[i]["articulo_codigo"]+"</td>";
                            html += "<td class='text-center' "+estilo+">"+numberFormat(Number(registros[i]["saldos"]).toFixed(2))+"</td>";
                            html += "<td class='text-right' "+estilo+">"+numberFormat(Number(registros[i]["precio_unitario"]).toFixed(3))+"</td>";

                            html += "<td class='text-right' "+estilo+">"+numberFormat(Number(Number(registros[i]["precio_unitario"]*Number(registros[i]["saldos"]))).toFixed(2))+"</td>";

                            
                            html += "<td class='no-print' style='padding: 0;'>";     
                            
                            html += "<button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target='#modalingresos' title='Ver ingresos' onclick='buscar_ingresos("+registros[i]["programa_id"]+","+registros[i]["articulo_id"]+")'>";
                            html += "<fa class='fa fa-cubes'></fa> </button>";
                            html += "</td>";
                            
                            html += "<td class='no-print' style='padding: 0;'>";     
                            html += "<button type='button' class='btn btn-warning btn-xs' title='Rectificar kardex' onclick='reajustar_kardex("+registros[i]["articulo_id"]+")'>";
                            html += "<fa class='fa fa-list-alt'></fa> </button>";
                            
                            html += "</td>";

                            html += "</tr>";
                            num++;
                        }
                        
                    }
                    
                    convertiraliteral(Number(cant_total).toFixed(2));
                    obtenercodigo(programa_id);
                    html += "</tbody>";
                    html += "</table>";
                    var titulo_prog = $("#programa_id option:selected").text();
                    
                    $("#elprograma").html(titulo_prog);
                    
                    $("#lafecha").html(moment(fecha_hasta).format('DD/MM/YYYY'));
                    $("#elmantenimiento").html($('input:radio[name=mantenimiento]:checked').val());
                    
                    $("#tablaresultados").html(html);
                    var html1 ="";
                    html1 += "<table style='width: 19.59cm; font-size: 12px' class='text-bold' id='mitabla'>";
                    html1 += "<tr>";
                    html1 += "<th style='text-align: right; font-size: 12px' class='estdline' colspan='2'> TOTAL:";
                    html1 += "</th>";
                    html1 += "<th style='text-align: right; font-size: 12px' class='estdline' colspan='5'>"+numberFormat(Number(cant_total).toFixed(2))+" Bs.";
                    html1 += "</th>";
                    html1 += "</tr>";
                    html1 += "<tr>";
                    html1 += "<th style='text-align: right; font-size: 12px' class='estdline' colspan='2'> LITERAL:";
                    html1 += "</th>";
                    html1 += "<th style='text-align: right; font-size: 12px' class='estdline' colspan='5'><span id='literal'></span>";
                    html1 += "</th>";
                    html1 += "</tr>";
                    html1 += "</table>";
                    
                    html1 += "<input type='hidden' id='total_inventario' value='"+cant_total.toFixed(2)+"' readonly/>";
                    
                    html1 += "<button type='button' class='btn btn-primary btn-xs no-print' data-toggle='modal' data-target='#modalinventario'>";
                    html1 += "<fa class='fa fa-cubes'></fa>";
                    html1 += "  Generar inventario inicial";
                    html1 += "</button>";
                    
                    $("#tablaresultados1").html(html1);
                   
            }
                
        },
        error:function(respuesta){
          
          alert('No existe Inventario para este programa hasta esta fecha.');
           html = "";
           $("#tablaresultados").html(html);
        }
        
    });   

}

//Generar inventario inicial
function inventario_inicial(){
    
    var controlador    = "";
    var base_url       = document.getElementById('base_url').value;
    var fecha_hasta    = document.getElementById('fecha_hasta').value;
    var programa_id    = document.getElementById('programa_id').value;
    var gestion_inicio = document.getElementById('gestion_inicio').value;
    var gestion_id     = document.getElementById('gestion_id').value;
    var total_inventario     = document.getElementById('total_inventario').value;
    var gestion_descripcion    = document.getElementById('gestion_descripcion').value;
    var gestion_fecha     = document.getElementById('gestion_fecha').value;
    var html = ""
    
    controlador        = base_url+'programa/inventarioinicial/';
    
    document.getElementById("modalgenerar").style = "display:none";
    document.getElementById("modalloader").style = "display:block";

    
       $.ajax({url: controlador,
           type:"POST",
           data:{fecha_hasta:fecha_hasta, programa_id:programa_id, gestion_inicio:gestion_inicio, total_inventario:total_inventario,
                 gestion_id:gestion_id, gestion_descripcion: gestion_descripcion, gestion_fecha: gestion_fecha},
           success:function(respuesta){
               
               var registros =  JSON.parse(respuesta); 
 
                
        },
//        error:function(respuesta){
//          
//          alert('No existe Inventario para este programa hasta esta fecha.');
//           html = "";
//           $("#tablaresultados").html(html);
//        }
        
    });   
    
    document.getElementById("modalloader").style = "display:none";    
    document.getElementById("modalgenerar").style = "display:block";
    
    alert("Operación finalizada correctamente...!");
    document.getElementById("boton_cerrarmodal").click();
    

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

function obtenercodigo(programa_id)
{
    var controlador = "";
    var base_url       = document.getElementById('base_url').value;
    controlador        = base_url+'programa/obtenercodigo/';
    
       $.ajax({url: controlador,
           type:"POST",
           data:{programa_id:programa_id},
           success:function(respuesta){
               var registros =  JSON.parse(respuesta); 
               if (registros != null){
                    //$('select[name="programa_id"] option:selected').text());
                    $("#elcodigo").html(registros);
            }
        },
        error:function(respuesta){
          
          alert('No el programa.');
           html = "";
           $("#elcodigo").html(html);
        }
        
    });
}

function numberFormat(numero){
        // Variable que contendra el resultado final
        var resultado = "";
 
        // Si el numero empieza por el valor "-" (numero negativo)
        if(numero[0]=="-")
        {
            // Cogemos el numero eliminando los posibles puntos que tenga, y sin
            // el signo negativo
            nuevoNumero=numero.replace(/\,/g,'').substring(1);
        }else{
            // Cogemos el numero eliminando los posibles puntos que tenga
            nuevoNumero=numero.replace(/\,/g,'');
        }
 
        // Si tiene decimales, se los quitamos al numero
        if(numero.indexOf(".")>=0)
            nuevoNumero=nuevoNumero.substring(0,nuevoNumero.indexOf("."));
 
        // Ponemos un punto cada 3 caracteres
        for (var j, i = nuevoNumero.length - 1, j = 0; i >= 0; i--, j++)
            resultado = nuevoNumero.charAt(i) + ((j > 0) && (j % 3 == 0)? ",": "") + resultado;
 
        // Si tiene decimales, se lo añadimos al numero una vez forateado con 
        // los separadores de miles
        if(numero.indexOf(".")>=0)
            resultado+=numero.substring(numero.indexOf("."));
 
        if(numero[0]=="-")
        {
            // Devolvemos el valor añadiendo al inicio el signo negativo
            return "-"+resultado;
        }else{
            return resultado;
        }
    }
    
    
function buscar_ingresos(programa_id, articulo_id){
    
    
    var base_url       = document.getElementById('base_url').value;
    var controlador        = base_url+'programa/buscar_ingresos/';
    var gestion_id     = document.getElementById('gestion_id').value;
    
    //alert(programa_id+" "+articulo_id+" "+gestion_id);
       $.ajax({url: controlador,
           type:"POST",
           data:{programa_id:programa_id, articulo_id:articulo_id, gestion_id:gestion_id},
           success:function(respuesta){
              
               var registros =  JSON.parse(respuesta); 
               
                if (registros != null){
                    //$('select[name="programa_id"] option:selected').text());
                    
                   html ="";
                   var enlace = "";
                    tam = registros.length;
                    //alert(tam);
                    html += "<b>"+registros[0]["articulo_nombre"]+"</b>";
                    html +="<table class='table table-striped' id='mitabla'>";
                    html +="<tr>";
                        html +="<th>#</th>";
                        html +="<th>INGRESO</th>";
                        html +="<th>FECHA</th>";
                    html +="</tr>";
                    
                    for (i=0;i<tam;i++){
                        numero = i+1;
                        
                       html +="<tr>";
                       html +="<td>"+numero+"</td>";
                       html +="<td>"+registros[i]["ingreso_numdoc"]+"</td>";
                       html +="<td>"+formato_fecha(registros[i]["ingreso_fecha_ing"])+"</td>";
                       enlace = base_url+"ingreso/pdf/"+registros[i]["ingreso_id"];
                       html +="<td><a href='"+enlace+"' class='btn btn-xs btn-success' target='_BLANK'><fa class='fa fa-print'></fa> </a></td>";
                       
                       html +="</tr>";
                        
                    } 
                    html +="</table>";
                    
                    $("#ingreso_articulos").html(html);
            }
        },
        error:function(respuesta){
          
          alert('No existe el programa.');
           html = "";
           $("#elcodigo").html(html);
        }
        
    });    
    
}

function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}

function reajustar_inventario(){
    
    
    var base_url       = document.getElementById('base_url').value;
    var controlador        = base_url+'programa/reajustar_inventario/';
    var gestion_id     = document.getElementById('gestion_id').value;
    var programa_id    = document.getElementById('programa_id').value;
    
    //alert(controlador);
    if (programa_id>0){
        
            var opcion = confirm("Esta operación afectará de forma permanente a la Base de Datos. ¿Desea Continuar?");
            if (opcion == true) {

                    $.ajax({url: controlador,
                        type:"POST",
                        data:{programa_id:programa_id, gestion_id:gestion_id},
                        success:function(respuesta){

                             tablaresultadosprogramainv();
                             alert('Proceso finalizado con éxito..!!');
                         },
                         error:function(respuesta){

                         alert('No existe el programa.');

                     }

                 });    

            }
        
    }
    else{
        alert("ERROR: Debe seleccionar un Programa...!");
    }
            
}

function reajustar_kardex(articulo_id){
    
    
    var base_url       = document.getElementById('base_url').value;
    var controlador        = base_url+'programa/reajustar_kardex/';
    var gestion_id     = document.getElementById('gestion_id').value;
    var programa_id    = document.getElementById('programa_id').value;
    
    //alert(controlador);

    //alert(controlador);
    if (programa_id>0){
        
            var opcion = confirm("Esta operación afectará de forma permanente a la Base de Datos y los registros de salida. ¿Desea Continuar?");
            if (opcion == true) {    
    
                $.ajax({url: controlador,
                    type:"POST",
                    data:{programa_id:programa_id, gestion_id:gestion_id, articulo_id: articulo_id},
                    success:function(respuesta){
                        
                        var x =  JSON.parse(respuesta);
                        
                        if (x=='error'){
                            alert('Proceso de reajuste de Kardex Finalizado: SE DETECTO UNA INCOSISTENCIA EN LAS SALIDAS, que no sigue el principio PEPS. Debe ser revisada..!!');                            
                        }else{
                            alert('Proceso de reajuste de Kardex, finalizado con exito..!!');
                        }

                     },
                     error:function(respuesta){

                     alert('No existe el programa.');

                 }

             });    
    
            }
        
    }
    else{
        alert("ERROR: Debe seleccionar un Programa...!");
    }
            
}