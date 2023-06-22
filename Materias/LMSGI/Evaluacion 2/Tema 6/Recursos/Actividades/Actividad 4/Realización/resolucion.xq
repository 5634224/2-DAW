<html>
  <body>
    <table border="1">
    <tr>
      <th>Siniestro</th>
      <th>Fecha</th>
      <th>Hora</th>
      <th>Cliente</th>
      <th>Total</th>
      <th>Estado</th>
      <th>Comentarios</th>
    </tr>
    
    {
      for $actualizacion in /incidencias/siniestros/actualizaciones/actualizacion
        let $act_siniestro_id := $actualizacion/@siniestro/data()
        let $act_fechayhora := $actualizacion/@fecha/data()
        let $act_fecha := format-dateTime($act_fechayhora, "[D01]/[M01]/[Y0001]")
        let $act_hora := format-dateTime($act_fechayhora, "[H01]:[m01]")
        let $estado := $actualizacion/@estado/data()
        let $estado := if ($estado = "resuelto") then "Resuelto" else "Atención"
        let $comentarios := $actualizacion/data()
        let $siniestro := /incidencias/siniestros/encurso/siniestro[@id=$act_siniestro_id]
        let $cliente_nombre := $siniestro/cliente/@nombre/data()
        let $pto_desplazamiento := if ($siniestro/presupuesto/@desplazamiento) then $siniestro/presupuesto/@desplazamiento/data() else 0
        let $pto_importe := if ($siniestro/presupuesto/@importe) then $siniestro/presupuesto/@importe/data() else 0
        let $importe := $pto_desplazamiento + $pto_importe
        let $importe_formateado := if ($importe = 0) then "" else concat($importe, " €")
        
        order by $act_siniestro_id, $act_fechayhora descending
        
        return 
          <tr>
            <td>{$act_siniestro_id}</td>
            <td>{$act_fecha}</td>
            <td>{$act_hora}</td>
            <td>{$cliente_nombre}</td>
            <td>{$importe_formateado}</td>
            <td>{$estado}</td>
            <td>{$comentarios}</td>
          </tr>
    }
    </table>
  </body>
</html>