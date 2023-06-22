for $propiedad in /comunidad/propiedades/propiedad[@id="C03"]
  let $suma_porcentajes := sum($propiedad/participacion/@porcentaje)
return $suma_porcentajes