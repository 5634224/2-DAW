for $propiedad in /comunidad/propiedades/propiedad
  let $suma_porcentajes := sum($propiedad/participacion/@porcentaje)
  where $suma_porcentajes != 101
return $suma_porcentajes