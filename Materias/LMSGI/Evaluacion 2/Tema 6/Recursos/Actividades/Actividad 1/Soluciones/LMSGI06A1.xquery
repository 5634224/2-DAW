<html>
  <body>
    <table border="1">
      <tr>
        <th>Periodo</th>
        <th>Desde fecha</th>
        <th>Desde lectura</th>
        <th>Hasta fecha</th>
        <th>Hasta lectura</th>
        <th>Consumo</th>
      </tr>
{
for $integrador in /MensajeFacturacion/Facturas/FacturaATR/Medidas/Aparato/Integrador[Magnitud="R1"]
  let $periodo_original := $integrador/CodigoPeriodo/data()
  let $periodo := $periodo_original - 60
  let $fecha_desde := $integrador/LecturaDesde/FechaHora/data()
  let $fecha_desde_formateada := format-dateTime(xs:dateTime($fecha_desde), "[D01]/[M01]/[Y0001]")
  let $valor_desde := $integrador/LecturaDesde/Lectura/data()
  let $fecha_hasta := $integrador/LecturaHasta/FechaHora/data()
  let $fecha_hasta_formateada := format-dateTime(xs:dateTime($fecha_hasta), "[D01]/[M01]/[Y0001]")
  let $valor_hasta := $integrador/LecturaHasta/Lectura/data()
  let $consumo := $integrador/ConsumoCalculado/data()
order by $periodo
return 
  <tr>
    <td>{$periodo}</td>
    <td>{$fecha_desde_formateada}</td>
    <td>{$valor_desde}</td>
    <td>{$fecha_hasta_formateada}</td>
    <td>{$valor_hasta}</td>
    <td>{$consumo}</td>    
  </tr>
}
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>
        {
        let $consumo_total := sum(/MensajeFacturacion/Facturas/FacturaATR/Medidas/Aparato/Integrador[Magnitud="R1"]/ConsumoCalculado) 
        return $consumo_total  
        } 
        </td>
      </tr>
    </table>
  </body>
</html>