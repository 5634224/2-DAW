<html>
  <body>
    <h1>Listado de propietarios al corriente de pago</h1>
    <table border="1">
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Viviendas</th>
        <th>Garajes</th>
      </tr>
      {
for $propietario in /comunidad/propietarios/propietario
  let $propietario_id := $propietario/@id/data()
  let $propietario_apellidos := $propietario/@apellidos/data()
  let $propietario_nombre := $propietario/@nombre/data()
  let $propietario_nombre_completo := concat($propietario_apellidos,", ",$propietario_nombre)
  let $conteo_viviendas := count(/comunidad/propiedades/propiedad[(participacion/@propietario=$propietario_id) and (@id>="C00" and @id<="C99")])
  let $conteo_garajes := count(/comunidad/propiedades/propiedad[(participacion/@propietario=$propietario_id) and (@id>="G00" and @id<="G99")])
where $propietario/@alcorriente
order by $propietario_apellidos, $propietario_nombre
return       
      <tr>
        <td>{$propietario_id}</td> 
        <td>{$propietario_nombre_completo}</td>
        <td>{$conteo_viviendas}</td>
        <td>{$conteo_garajes}</td>
      </tr>
      }      
    </table>
    <h1>Listado de propiedades de propietarios morosos con cuota igual o superior al 50%</h1>
    <table border="1">
      <tr>
        <th>Id</th>
        <th>Tipo</th>
        <th>Propietario</th>
        <th>Contacto</th>
      </tr>
      {
for $participacion in /comunidad/propiedades/propiedad/participacion
  let $participacion_porcentaje := $participacion/@porcentaje/data()
  let $propietario_id := $participacion/@propietario/data()
  let $propietario := /comunidad/propietarios/propietario[@id=$propietario_id]
  let $propietario_nombre_completo := concat($propietario/@nombre," ",$propietario/@apellidos)
  let $alcorriente := $propietario/@alcorriente/data()
  let $propiedad_tipo := $participacion/../@tipo/data() 
  let $propiedad_id := $participacion/../@id/data() 
  let $propiedad_contacto_id := $participacion/../@contacto/data() 
  let $propiedad_contacto_nombre_completo := concat(/comunidad/propietarios/propietario[@id=$propiedad_contacto_id]/@nombre,' ',/comunidad/propietarios/propietario[@id=$propiedad_contacto_id]/@apellidos)
  where ($participacion_porcentaje >= 50) and not($alcorriente)
return
      <tr>
        <td>{$propiedad_id}</td>
        <td>{$propiedad_tipo}</td>
        <td>{$propietario_nombre_completo}</td>
        <td>{$propiedad_contacto_nombre_completo}</td>
      </tr>
      }
    </table>
  </body>
</html>