for $propiedad in /comunidad/propiedades/propiedad
  let $tipo := $propiedad/@tipo
  (: where $tipo="vivienda90" :)
  order by $tipo
return $propiedad