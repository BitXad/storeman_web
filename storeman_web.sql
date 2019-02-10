drop table if exists articulo;

drop table if exists cambio;

drop table if exists categoria;

drop table if exists detalle_ingreso;

drop table if exists detalle_pedido;

drop table if exists detalle_salida;

drop table if exists estado;

drop table if exists factura;

drop table if exists gestion;

drop table if exists ingreso;

drop table if exists institucion;

drop table if exists pedido;

drop table if exists programa;

drop table if exists proveedor;

drop table if exists salida;

drop table if exists tipo_usuario;

drop table if exists unidad;

drop table if exists usuario;

/*==============================================================*/
/* table: articulo                                              */
/*==============================================================*/
create table articulo
(
   articulo_id          int not null,
   categoria_id         int,
   articulo_nombre      varchar(50),
   articulo_marca       varchar(50),
   articulo_industria   varchar(50),
   articulo_codigo      varchar(20),
   articulo_saldo       varchar(20),
   primary key (articulo_id)
);

/*==============================================================*/
/* table: cambio                                                */
/*==============================================================*/
create table cambio
(
   cambio_id            int not null,
   gestion_id           int,
   cambio_fecha         date,
   cambio_ufv           varchar(20),
   primary key (cambio_id)
);

/*==============================================================*/
/* table: categoria                                             */
/*==============================================================*/
create table categoria
(
   categoria_id         int not null,
   categoria_nombre     varchar(50),
   categoria_descripcion varchar(250),
   primary key (categoria_id)
);

/*==============================================================*/
/* table: detalle_ingreso                                       */
/*==============================================================*/
create table detalle_ingreso
(
   detalleing_id        int not null,
   proveedor_id         int,
   factura_id           int,
   articulo_id          int,
   ingreso_id           int,
   programa_id          int,
   detalleing_cantidad  float,
   detalleing_precio    float,
   detalleing_total     float,
   primary key (detalleing_id)
);

/*==============================================================*/
/* table: detalle_pedido                                        */
/*==============================================================*/
create table detalle_pedido
(
   detalleped_id        int not null auto_increment,
   pedido_id            int,
   programa_id          int,
   unidad_id            int,
   primary key (detalleped_id)
);

/*==============================================================*/
/* table: detalle_salida                                        */
/*==============================================================*/
create table detalle_salida
(
   detallesal_id        int not null,
   salida_id            int,
   articulo_id          int,
   programa_id          int,
   detallesal_cantidad  float,
   detallesal_precio    varchar(30),
   detallesal_total     varchar(250),
   primary key (detallesal_id)
);

/*==============================================================*/
/* table: estado                                                */
/*==============================================================*/
create table estado
(
   estado_id            int not null,
   estado_descripcion   varchar(50),
   estado_tipo          int,
   estado_color         varchar(30),
   primary key (estado_id)
);

/*==============================================================*/
/* table: factura                                               */
/*==============================================================*/
create table factura
(
   factura_id           int not null,
   usuario_id           int,
   factura_numero       float,
   factura_fecha        date,
   factura_nit          bigint,
   factura_razon        varchar(150),
   factura_importe      varchar(50),
   factura_autorizacion varchar(50),
   factura_poliza       varchar(50),
   factura_ice          float,
   factura_exento       float,
   factura_neto         float,
   factura_creditofiscal float,
   factura_codigocontrol varchar(20),
   primary key (factura_id)
);

/*==============================================================*/
/* table: gestion                                               */
/*==============================================================*/
create table gestion
(
   gestion_id           int not null,
   institucion_id       int,
   gestion_nombre       varchar(20),
   gestion_descripcion  varchar(150),
   gestion_inicio       date,
   gestion_fin          date,
   primary key (gestion_id)
);

/*==============================================================*/
/* table: ingreso                                               */
/*==============================================================*/
create table ingreso
(
   ingreso_id           int not null,
   unidad_id            int,
   pedido_id            int,
   usuario_id           int,
   ingreso_numdoc       int,
   ingreso_fecha        date,
   ingreso_hora         time,
   primary key (ingreso_id)
);

/*==============================================================*/
/* table: institucion                                           */
/*==============================================================*/
create table institucion
(
   institucion_id       int not null,
   institucion_nombre   varchar(150),
   institucion_sucursal varchar(250),
   institucion_direccion varchar(250),
   institucion_ubicacion varchar(250),
   institucion_telef    varchar(30),
   institucion_nit      varchar(30),
   institucion_autorizacion varchar(30),
   institucion_eslogan  varchar(250),
   primary key (institucion_id)
);

/*==============================================================*/
/* table: pedido                                                */
/*==============================================================*/
create table pedido
(
   pedido_id            int not null,
   estado_id            int,
   gestion_id           int,
   pedido_fecha         date,
   pedido_hora          time,
   pedido_archivo       varchar(150),
   pedido_imagen        varchar(150),
   pedido_numero        varchar(20),
   pedido_fechapedido   date,
   primary key (pedido_id)
);

/*==============================================================*/
/* table: programa                                              */
/*==============================================================*/
create table programa
(
   programa_id          int not null,
   unidad_id            int,
   estado_id            int,
   programa_nombre      varchar(50),
   programa_codigo      varchar(20),
   programa_descripcion varchar(250),
   primary key (programa_id)
);

/*==============================================================*/
/* table: proveedor                                             */
/*==============================================================*/
create table proveedor
(
   proveedor_id         int not null,
   proveedor_nombre     varchar(50),
   proveedor_direccion  varchar(80),
   proveedor_telefono   varchar(50),
   proveedor_celular    varchar(50),
   proveedor_email      varchar(50),
   proveedor_contacto   varchar(100),
   proveedor_nit        varchar(30),
   proveedor_razon      varchar(150),
   proveedor_autorizacion varchar(30),
   primary key (proveedor_id)
);

/*==============================================================*/
/* table: salida                                                */
/*==============================================================*/
create table salida
(
   salida_id            int not null,
   unidad_id            int,
   gestion_id           int,
   usuario_id           int,
   salida_motivo        varchar(120),
   salida_fecha         date,
   salida_acta          varchar(150),
   salida_obs           varchar(250),
   salida_fechahora     datetime,
   salida_doc           varchar(250),
   primary key (salida_id)
);

/*==============================================================*/
/* table: tipo_usuario                                          */
/*==============================================================*/
create table tipo_usuario
(
   tipousuario_id       int not null,
   tipousuario_descripcion varchar(150),
   primary key (tipousuario_id)
);

/*==============================================================*/
/* table: unidad                                                */
/*==============================================================*/
create table unidad
(
   unidad_id            int not null,
   unidad_nombre        varchar(150),
   unidad_codigo        varchar(20),
   unidad_descripcion   varchar(250),
   primary key (unidad_id)
);

/*==============================================================*/
/* table: usuario                                               */
/*==============================================================*/
create table usuario
(
   usuario_id           int not null,
   tipousuario_id       int,
   estado_id            int,
   usuario_nombre       varchar(80),
   usuario_email        varchar(150),
   usuario_login        varchar(50),
   usuario_clave        varchar(50),
   usuario_imagen       varchar(250),
   primary key (usuario_id)
);

alter table articulo add constraint fk_categoria_articulo foreign key (categoria_id)
      references categoria (categoria_id) on delete restrict on update restrict;

alter table cambio add constraint fk_cambio_gestion foreign key (gestion_id)
      references gestion (gestion_id) on delete restrict on update restrict;

alter table detalle_ingreso add constraint fk_detalleing_articulo foreign key (ingreso_id)
      references ingreso (ingreso_id) on delete restrict on update restrict;

alter table detalle_ingreso add constraint fk_detalleing_factura foreign key (factura_id)
      references factura (factura_id) on delete restrict on update restrict;

alter table detalle_ingreso add constraint fk_detalleing_programa foreign key (programa_id)
      references programa (programa_id) on delete restrict on update restrict;

alter table detalle_ingreso add constraint fk_detalleing_proveedor foreign key (proveedor_id)
      references proveedor (proveedor_id) on delete restrict on update restrict;

alter table detalle_ingreso add constraint fk_detalle_articulo foreign key (articulo_id)
      references articulo (articulo_id) on delete restrict on update restrict;

alter table detalle_pedido add constraint fk_detalle_pedido foreign key (pedido_id)
      references pedido (pedido_id) on delete restrict on update restrict;

alter table detalle_pedido add constraint fk_detalle_programa foreign key (programa_id)
      references programa (programa_id) on delete restrict on update restrict;

alter table detalle_pedido add constraint fk_detalle_unidad foreign key (unidad_id)
      references unidad (unidad_id) on delete restrict on update restrict;

alter table detalle_salida add constraint fk_detallesal_articulo foreign key (articulo_id)
      references articulo (articulo_id) on delete restrict on update restrict;

alter table detalle_salida add constraint fk_detallesal_programa foreign key (programa_id)
      references programa (programa_id) on delete restrict on update restrict;

alter table detalle_salida add constraint fk_detalle_salida foreign key (salida_id)
      references salida (salida_id) on delete restrict on update restrict;

alter table factura add constraint fk_factura_usuario foreign key (usuario_id)
      references usuario (usuario_id) on delete restrict on update restrict;

alter table gestion add constraint fk_gestion_institucion foreign key (institucion_id)
      references institucion (institucion_id) on delete restrict on update restrict;

alter table ingreso add constraint fk_ingreso_pedido foreign key (pedido_id)
      references pedido (pedido_id) on delete restrict on update restrict;

alter table ingreso add constraint fk_ingreso_usuario foreign key (usuario_id)
      references usuario (usuario_id) on delete restrict on update restrict;

alter table ingreso add constraint fk_unidad_ingreso foreign key (unidad_id)
      references unidad (unidad_id) on delete restrict on update restrict;

alter table pedido add constraint fk_estado_pedido foreign key (estado_id)
      references estado (estado_id) on delete restrict on update restrict;

alter table pedido add constraint fk_pedido_gestion foreign key (gestion_id)
      references gestion (gestion_id) on delete restrict on update restrict;

alter table programa add constraint fk_estado_programa foreign key (estado_id)
      references estado (estado_id) on delete restrict on update restrict;

alter table programa add constraint fk_unidad_programa foreign key (unidad_id)
      references unidad (unidad_id) on delete restrict on update restrict;

alter table salida add constraint fk_salida_gestion foreign key (gestion_id)
      references gestion (gestion_id) on delete restrict on update restrict;

alter table salida add constraint fk_unidad_salida foreign key (unidad_id)
      references unidad (unidad_id) on delete restrict on update restrict;

alter table salida add constraint fk_usuario_salida foreign key (usuario_id)
      references usuario (usuario_id) on delete restrict on update restrict;

alter table usuario add constraint fk_estado_usuario foreign key (estado_id)
      references estado (estado_id) on delete restrict on update restrict;

alter table usuario add constraint fk_usuario_tipo foreign key (tipousuario_id)
      references tipo_usuario (tipousuario_id) on delete restrict on update restrict;
