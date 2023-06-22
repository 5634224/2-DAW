for $propiedad in /comunidad/propiedades/propiedad
  let $tipo := upper-case($propiedad/@tipo,1,3)
  let $cto := $propiedad/@contacto/data()
  let $cto2 := if($cto) then $cto else "sin contacto"
  order by $tipo
(: return concat($tipo,' ',$cto) :)
return concat($tipo,' ',$cto2)