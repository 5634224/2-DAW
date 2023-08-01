<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:template match="/">
		<html>
			<body>
				<h1>Detalle de potencias contratadas en el punto de suministro:</h1>
				<ul>
					<li>
						Referencia CUPS: <xsl:value-of select="/MensajeFacturacion/Cabecera/Codigo" />
					</li>
					<li>
						Número de serie del contador: <xsl:value-of select="/MensajeFacturacion/Facturas/FacturaATR/Medidas/Aparato/NumeroSerie" />
					</li>
				</ul>
				<table>
					<tr>
						<th>Periodo</th>
						<th>Watios</th>
					</tr>
					<xsl:for-each select="/MensajeFacturacion/Facturas/FacturaATR/Potencia/TerminoPotencia/Periodo">
						<tr>
							<td>
								<xsl:value-of select="@nombre" />
							</td>
							<td>
								<xsl:value-of select="PotenciaContratada" />
							</td>	
						</tr>
					</xsl:for-each>
				</table>	
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>