<html>
<body>
  <table border="1">
    <thead>
      <th>Genero</th>
      <th>Titulo</th>
      <th>Año</th>
      <th>Director</th>
      <th>Reparto</th>
      <th>Precio</th>
      <th>Incluida en plan</th>
    </thead>
    <tbody>
      {
        for $pelicula in /catalogo/titulos/genero/titulo[@compra]
          let $genero := $pelicula/../@nombre/data()
          let $nombrePelicula := $pelicula/@nombre/data()
          let $anyo := $pelicula/@anyo/data()
          let $precioCompra := $pelicula/@compra/data()
          let $idDirector := if ($pelicula/reparto[@rol="director"]) then $pelicula/reparto/@miembro/data() else /catalogo/elenco/miembro[@id=$pelicula/reparto/@miembro/data() and @rol_principal="director"]/@id/data()
          let $director := /catalogo/elenco/miembro[@id=$idDirector]/@nombre/data()
          let $miembrosReparto := /catalogo/elenco/miembro[@id=$pelicula/reparto/@miembro and @id!=$idDirector]/@nombre/data()
          let $plan := if ($pelicula[@plan]) then /catalogo/planes/plan[@id=$pelicula/@plan]/@nombre/data() else "no incluido"
          
          order by fn:number($precioCompra) descending, $nombrePelicula
        return
        <tr>
          <td>{$genero}</td>
          <td>{$nombrePelicula}</td>
          <td>{$anyo}</td>
          <td>{$director}</td>
          <td>{$miembrosReparto}</td>
          <td>{$precioCompra}</td>
          <td>{$plan}</td>
        </tr>
      }
    </tbody>
  </table>
</body>
</html>