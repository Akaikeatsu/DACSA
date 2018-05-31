/*Para rehacer la base de datos ejecuta el script desde drop schema hasta...*/
drop schema public cascade;
create schema public;

CREATE TABLE info_cliente (id_info SERIAL NOT NULL, dom_fiscal varchar(255) NOT NULL, rfc varchar(13) NOT NULL, id_usuario int4 NOT NULL, PRIMARY KEY (id_info));
CREATE TABLE porducto (codigo SERIAL NOT NULL, nombre varchar(255) NOT NULL, unidad_medida varchar(20) NOT NULL, precio_u float4 NOT NULL, descuento float4 NOT NULL, ieps float4 NOT NULL, iva float4 NOT NULL, existencia int4 NOT NULL, PRIMARY KEY (codigo));
CREATE TABLE porducto_venta (porductocodigo int4 NOT NULL, ventafolio varchar(255) NOT NULL, cantidad int4 NOT NULL, PRIMARY KEY (porductocodigo, ventafolio));
CREATE TABLE tipo_usuario (id_tipo SERIAL NOT NULL, tipo varchar(15) NOT NULL, PRIMARY KEY (id_tipo));
CREATE TABLE usuario (id_usuario SERIAL NOT NULL, nombre_usuario varchar(255) NOT NULL UNIQUE, contrasenia varchar(15) NOT NULL, nombre varchar(255) NOT NULL, telefono numeric(10, 0) NOT NULL, correo varchar(255) NOT NULL, tipo int4 NOT NULL, PRIMARY KEY (id_usuario));
CREATE TABLE venta (folio varchar(255) NOT NULL, subtotal float4 NOT NULL, descuento float4 NOT NULL, neto float4 NOT NULL, ieps_total float4 NOT NULL, iva_total float4 NOT NULL, monto_total float4 NOT NULL, factura bool NOT NULL, envio_dom bool NOT NULL, usuario int4 NOT NULL, PRIMARY KEY (folio));
ALTER TABLE usuario ADD CONSTRAINT FKusuario321915 FOREIGN KEY (tipo) REFERENCES tipo_usuario (id_tipo);
ALTER TABLE porducto_venta ADD CONSTRAINT FKporducto_v424723 FOREIGN KEY (porductocodigo) REFERENCES porducto (codigo);
ALTER TABLE porducto_venta ADD CONSTRAINT FKporducto_v348272 FOREIGN KEY (ventafolio) REFERENCES venta (folio);
ALTER TABLE venta ADD CONSTRAINT FKventa86361 FOREIGN KEY (usuario) REFERENCES usuario (id_usuario);
ALTER TABLE info_cliente ADD CONSTRAINT FKinfo_clien872649 FOREIGN KEY (id_usuario) REFERENCES usuario (id_usuario);
/*... Aqui*/

/*DACSA v2*/
CREATE TABLE info_cliente (id_info SERIAL NOT NULL, dom_fiscal varchar(255) NOT NULL, rfc varchar(13) NOT NULL, id_usuario int4 NOT NULL, PRIMARY KEY (id_info));
CREATE TABLE porducto (codigo SERIAL NOT NULL, nombre varchar(255) NOT NULL, unidad_medida varchar(20) NOT NULL, precio_u float4 NOT NULL, descuento float4 NOT NULL, ieps float4 NOT NULL, iva float4 NOT NULL, existencia int4 NOT NULL, PRIMARY KEY (codigo));
CREATE TABLE porducto_venta (porductocodigo int4 NOT NULL, ventafolio varchar(255) NOT NULL, cantidad int4 NOT NULL, desc_cant float4, ieps_cant float4, iva_cant float4, total_cant float4 NOT NULL, PRIMARY KEY (porductocodigo, ventafolio));
CREATE TABLE tipo_usuario (id_tipo SERIAL NOT NULL, tipo varchar(15) NOT NULL, PRIMARY KEY (id_tipo));
CREATE TABLE usuario (id_usuario SERIAL NOT NULL, nombre_usuario varchar(255) NOT NULL UNIQUE, contrasenia varchar(15) NOT NULL, nombre varchar(255) NOT NULL, telefono numeric(10, 0) NOT NULL, correo varchar(255) NOT NULL, tipo int4 NOT NULL, PRIMARY KEY (id_usuario));
CREATE TABLE venta (folio varchar(255) NOT NULL, subtotal float4, descuento float4, neto float4, ieps_total float4, iva_total float4, monto_total float4, factura bool, envio_dom bool, usuario int4 NOT NULL, PRIMARY KEY (folio));
ALTER TABLE usuario ADD CONSTRAINT FKusuario321915 FOREIGN KEY (tipo) REFERENCES tipo_usuario (id_tipo);
ALTER TABLE porducto_venta ADD CONSTRAINT FKporducto_v424723 FOREIGN KEY (porductocodigo) REFERENCES porducto (codigo);
ALTER TABLE porducto_venta ADD CONSTRAINT FKporducto_v348272 FOREIGN KEY (ventafolio) REFERENCES venta (folio);
ALTER TABLE venta ADD CONSTRAINT FKventa86361 FOREIGN KEY (usuario) REFERENCES usuario (id_usuario);
ALTER TABLE info_cliente ADD CONSTRAINT FKinfo_clien872649 FOREIGN KEY (id_usuario) REFERENCES usuario (id_usuario);


/*Regsitros para cmprobar el inicio de sesion*/
INSERT INTO public.tipo_usuario(id_tipo, tipo)
			VALUES (1, 'Cliente');
INSERT INTO public.tipo_usuario(id_tipo, tipo)
			VALUES (2, 'Encargado');

INSERT INTO public.usuario(id_usuario, nombre_usuario, contrasenia, nombre, telefono, correo, tipo)
	VALUES (1, 'adolf', 'abc123', 'Adolfo Meza Romero', 2717092233, 'adolfo@hotmail.com', 1);
INSERT INTO public.usuario(id_usuario, nombre_usuario, contrasenia, nombre, telefono, correo, tipo)
	VALUES (2, 'ana', 'abc124', 'Ana Moreno Soto', 2727093322, 'ana@hotmail.com', 2);

INSERT INTO public.info_cliente(dom_fiscal, rfc, id_usuario)
	VALUES ('Calle 17', 'MERA970607ABC', 1);

INSERT INTO public.porducto(nombre, unidad_medida, precio_u, descuento, ieps, iva, existencia)
	VALUES ('CHOCOLATE CARLOS V 50PZ/100G', 'Caja', 50.00, 0.00, 0.00, 11.50, 30);
INSERT INTO public.porducto(nombre, unidad_medida, precio_u, descuento, ieps, iva, existencia)
	VALUES ('NESCAFE 20PZ/25G', 'Exhibidor', 90.00, 0.00, 0.00, 0.00, 30);
INSERT INTO public.porducto(nombre, unidad_medida, precio_u, descuento, ieps, iva, existencia)
	VALUES ('LACTEO NUTRILECHE 12PZ/1L', 'Caja', 112.00, 0.00, 0.00, 20.00, 30);
INSERT INTO public.porducto(nombre, unidad_medida, precio_u, descuento, ieps, iva, existencia)
	VALUES ('CLORO PINOL 12PZ/500ML', 'Caja', 200.50, 0.00, 0.00, 0.00, 30);
INSERT INTO public.porducto(nombre, unidad_medida, precio_u, descuento, ieps, iva, existencia)
	VALUES ('CIGARRO BALBORO CLASICO 12 CAJETILLAS', 'Paquete', 250.00, 0.00, 0.00, 50.00, 30);
INSERT INTO public.porducto(nombre, unidad_medida, precio_u, descuento, ieps, iva, existencia)
	VALUES ('MAYONESA McCORMIC 10PZ/500GR', 'Caja', 150.00, 30.00, 10.00, 0.00, 30);

INSERT INTO public.venta(folio, subtotal, descuento, neto, ieps_total, iva_total, monto_total, factura, envio_dom, usuario)
	VALUES (1, 190.00, 0.00, 190.00, 0.00, 23.00, 213.00, true, false, 1);

	INSERT INTO public.porducto_venta(porductocodigo, ventafolio, cantidad, desc_cant, ieps_cant, iva_cant, total_cant)
		VALUES (1, 1, 2, 0.00, 0.00, 23.00, 100.00);
	INSERT INTO public.porducto_venta(porductocodigo, ventafolio, cantidad, desc_cant, ieps_cant, iva_cant, total_cant)
		VALUES (2, 1, 1, 0.00, 0.00, 0.00, 90);

INSERT INTO public.venta(folio, subtotal, descuento, neto, ieps_total, iva_total, monto_total, factura, envio_dom, usuario)
	VALUES (2, 190.00, 0.00, 190.00, 0.00, 23.00, 213.00, true, true, 1);

	INSERT INTO public.porducto_venta(porductocodigo, ventafolio, cantidad, desc_cant, ieps_cant, iva_cant, total_cant)
		VALUES (1, 2, 2, 0.00, 0.00, 23.00, 100.00);
	INSERT INTO public.porducto_venta(porductocodigo, ventafolio, cantidad, desc_cant, ieps_cant, iva_cant, total_cant)
		VALUES (2, 2, 1, 0.00, 0.00, 0.00, 90);