<html>
  <body>
  <table>
    <tr>
      <th>Id</th>
      <th>tipo</th>
      <th>Propietarios</th>
    </tr>
    {
      for $propiedad in /comunidad/propiedades/propiedad
      let $propiedad_id := $propiedad/@id/data()
      let $propiedad_tipo := $propiedad/@tipo/data()
      let $propiedad_props := $propiedad/participacion/@propietario/data()
      return 
      <tr>
        <td>{$propiedad_id}</td>
        <td>{$propiedad_tipo}</td>
        <td>{$propiedad_props}</td>
      </tr>
    }
  </table>
  </body>
</html>