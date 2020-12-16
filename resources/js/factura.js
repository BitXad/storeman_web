/**
 * Comment
 */
function imprimir(){
    window.print();
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

function formato_fecha(string){
    var info = "";
    if(string != null){
       info = string.split('-').reverse().join('/');
   }
    return info;
}

function mostrar_facturas() {
    var base_url = document.getElementById('base_url').value;
    var desde = document.getElementById('fecha_desde').value;
    var hasta = document.getElementById('fecha_hasta').value;
    var proveedor = document.getElementById('proveedor').value;
    var gestion_id = document.getElementById('gestion_id').value;
    
    //alert(gestion_id);
    var condicion_gestion = " and i.gestion_id = "+gestion_id;
    
    
    
    if ( desde =='' && hasta =='' && proveedor==0) {
        var opcion = " i.gestion_id = "+gestion_id;

    } else if (desde =='' && hasta =='' && proveedor!=0){
        var opcion = " p.proveedor_nombre='"+proveedor+"' "+condicion_gestion;
    }
    else if (desde !='' && hasta !='' && proveedor==0) {
     var opcion = "  date(f.factura_fecha) >= '"+desde+"'  and  date(f.factura_fecha) <='"+hasta+"' "+condicion_gestion;

    }else{

     var opcion = "  date(f.factura_fecha) >= '"+desde+"'  and  date(f.factura_fecha) <='"+hasta+"' and p.proveedor_nombre='"+proveedor+"' "+condicion_gestion;
    }
    var controlador = base_url+'factura/mostrar_facturas';   
   
   
   
    $.ajax({url:controlador,
            type:"POST",
            data:{opcion:opcion},
            success:function(result){
                var factura = JSON.parse(result);
                var tam = factura.length;
                var totalfinal = 0;
                
                html = "";
                    
                    html += "<table class='table table-striped' id='mitabla' >";
                    html += "<th>N°</th>";
                    html += "<th>FECHA DE LA FACTURA</th>";
                    html += "<th>N° DE LA FACTURA</th>";
                    html += "<th>N° DE AUTORIZACION</th>";
                    html += "<th>NIT PROVEEDOR</th>";
                    html += "<th>RAZON SOCIAL</th>";
                    html += "<th>IMPORTE ICE</th>";
                    html += "<th>/IEHD/TASAS    EXPORTACIONES Y OPERACIONES EXENTAS</th>";          
                    html += "<th>IMPORTE</th>";   
                    html += "<th>CODIGO DE CONTROL</th>";    
                    html += "<th>INGRESO</th>";
                    html += "</tr>";
                    html += "<tbody class='buscar'>";
                    
                    
                    
                    for(var i = 0; i < tam; i++ ){                        
                        if (factura[i]['estado_id']==2)
                            color = "style = 'background-color:gray'";
                        else
                            color = "";
                        html += "<tr  "+color+">";
                        html += "   <td>"+i+1+"</td>";
                        html += "   <td>"+formato_fecha(factura[i]["factura_fecha"])+"</td>";
                        html += "   <td>"+factura[i]["factura_numero"]+"</td>";
                        html += "   <td>"+factura[i]["factura_autorizacion"]+"</td>";
                        html += "   <td>"+factura[i]["factura_nit"]+"</td>";
                        html += "   <td>"+factura[i]["factura_razon"]+"</td>";
                        html += "   <td>"+Number(factura[i]["factura_ice"]).toFixed(2)+"</td>";
                        html += "   <td>"+Number(factura[i]["factura_exento"]).toFixed(2)+"</td>";
                        html += "   <td>"+Number(factura[i]["factura_importe"]).toFixed(2)+"</td>";
                        //html += "   <td>"+Number(factura[i]["factura_total"]*0.13).toFixed(2)+"</td>";
                        html += "   <td>"+factura[i]["factura_codigocontrol"]+"</td>";
                        html += "   <td>"+factura[i]["ingreso_numdoc"]+"</td>";
                        html += "   <td>"+factura[i]["gestion_descripcion"]+"</td>";
//                        html += "   <td><button class='btn btn-danger btn-xs' onclick='anular_factura("+factura[i]["factura_id"]+","+factura[i]["venta_id"]+","+factura[i]["factura_numero"]+","+'"'+factura[i]["factura_razonsocial"]+'"'+","+factura[i]["factura_total"]+","+'"'+factura[i]["factura_fecha"]+'"'+")'><i class='fa fa-trash'></i> Anular</button></td>";
                        html += "   <td><a href='"+base_url+"factura/edit/"+factura[i]["factura_id"]+"' class='btn btn-info btn-xs' target='_BLANK'><i class='fa fa-edit'></i> Modificar</button></td>";
                        html += "</tr>";
                        
                        totalfinal += Number(factura[i]["factura_importe"]);
                        
                        
                    }
                        //var debitofiscal =  totalfinal * 0.13;
                        
                        
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th></th> ";
                        //html += "<th>"+formato_numerico(Number(debitofiscal).toFixed(2))+"</th> ";
                        html += "<th> </th> ";
                        html += "<th> </th> ";
                        html += "<th>"+formato_numerico(Number(totalfinal).toFixed(2))+"</th> ";
                   html += "<tbody>";
                    html += "</table>";
                    $("#tabla_factura").html(html);
                
            },
            error:function(result){alert("Ocurrio un error en la consulta. Revise los parametros por favor...!")},
                   
        
            
            })

    
}

function anular_factura(factura_id, venta_id, factura_numero, factura_razon, factura_total, factura_fecha)
{
    
    var base_url = document.getElementById('base_url').value;
    var controlador = base_url+'factura/anular_factura/'+factura_id+"/"+venta_id;    

        var txt;
        var r = confirm("Esta a punto de anular una factura.\n"+"Factura Nº: "+factura_numero+"\n"+
                                  "Monto Bs: "+factura_total+"\n"+
                                  "Cliente: "+factura_razon+"\n"+
                                  "Fecha: "+formato_fecha(factura_fecha)+ "\n Esta operación es irreversible, ¿Desea Continuar?");
        if (r == true) {
   
            $.ajax({url:controlador,
                    type:"POST",
                    data:{},
                    success:function(result){
                        mostrar_facturas();
                        alert('Factura anulada con éxito..!!')
                    },
            });
        }


}
