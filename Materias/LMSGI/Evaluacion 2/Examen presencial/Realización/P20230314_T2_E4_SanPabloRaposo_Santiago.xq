<html>
<body>
  <ul>
    {
      for $ciudad in /prevision/ciudades/ciudad
        let $nombreCiudad := $ciudad/@nombre/data()
        let $dia := $ciudad/dia[@fecha="2023-03-14"]
        let $clima := $dia/@clima/data()
        let $nombreClima := /prevision/climas/clima[@id=$clima]/@descripcion
        let $temperaturaMinima := fn:number($dia/temperatura/@minima/data())
        let $temperaturaMaxima := fn:number($dia/temperatura/@minima/data())
        let $media := fn:avg(($temperaturaMinima, $temperaturaMaxima))
        let $lluvia := $dia/lluvia/@cantidad/data()
        order by $nombreCiudad
        return
        <li>
          {concat($ciudad/@nombre/data(), " (", $nombreClima, ")")}
          <ul>
            <li>
              Temperatura media: {concat($media, "ºC")}
            </li>
            <li>
              Precipitación: {
                if ($dia/lluvia) then concat($lluvia, " l/m2") else "Sin precipitaciones"
              }
            </li>
          </ul>
        </li>
    }
  </ul>
</body>
</html>