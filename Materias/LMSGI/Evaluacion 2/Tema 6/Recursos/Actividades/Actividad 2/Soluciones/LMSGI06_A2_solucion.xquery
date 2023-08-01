<html lang="es">
  <head>
    <title>LMSGI06 - XQuery</title>
    <meta charset="utf-8"/>
  </head>
  <body>
    <h2>Listado de entradas del producto P001:</h2>
    <table border="1">
      <tr>
        <th>Fecha</th>
        <th>Id</th>
        <th>Socio</th>
        <th>Cantidad</th>
      </tr>
{
  for $entrada in db:open('ca')/ca/entradas/entrada
    let $id := $entrada/@id
    let $id_str := $id/data()
    let $fecha := $entrada/@fecha
    let $fecha_str := format-date(xs:date($fecha), "[D01]/[M01]/[Y0001]")
    let $id_socio := $entrada/@socio
    let $nombre_socio := db:open('ca')/ca/socios/socio[@id=$id_socio]/@nombre/data()
    let $cantidad := $entrada/@cantidad/data()
    where $entrada/@producto='P001'
    order by $entrada/@fecha , $id
    return
      <tr>
        <td>{$fecha_str}</td>
        <td>{$id_str}</td>
        <td>{$nombre_socio}</td>
        <td>{$cantidad}</td>
      </tr>}
    </table>
    <h2>Resumen por socio</h2>
    <table border="1">
      <tr>
        <th>Socio</th>
        <th>Subtotal</th>
      </tr>
{
  for $socio in db:open('ca')/ca/socios/socio
    let $nombre := $socio/@nombre/data()
    let $subtotal := sum(db:open('ca')/ca/entradas/entrada[(@socio=$socio/@id) and (@producto='P001')]/@cantidad)
    order by $subtotal descending
    return
      <tr>
        <td>{$nombre}</td>
        <td>{$subtotal}</td>
      </tr>}
    </table>
  </body>
</html>