<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <html>
            <body>
                <h1>Informe de siniestros</h1>
                <ul>
                    <li>Proveedor: <xsl:value-of select="/incidencias/cabecera/proveedor/@nombre" /></li>
                    <li>Fecha: <xsl:value-of select="/incidencias/cabecera/fechas/@desde" /> desde <xsl:value-of select="/incidencias/cabecera/fechas/@hasta" /> hasta </li>
                </ul>
                <h2>Listado de siniestros nuevos</h2>
                <table border="1">
                    <tr>
                        <th>Id</th>
                        <th>Cliente</th>
                        <th>Móvil</th>
                        <th>Descripción</th>
                    </tr>
                    <xsl:for-each select="/incidencias/siniestros/encurso/siniestro[@nuevo]">
                    <tr>                        
                        <td><xsl:value-of select="@id" /></td>
                        <td><xsl:value-of select="cliente/@nombre" /></td>
                        <td><xsl:value-of select="cliente/@movil" /></td>
                        <td><xsl:value-of select="descripcion" /></td>
                    </tr>
                    </xsl:for-each>
                </table>
                <h2>Listado de siniestros resueltos</h2>
                <table border="1">
                    <tr>
                        <th>Id</th>
                        <th>Fecha y hora</th>
                        <th>Notas de resolución</th>
                    </tr>
                    <xsl:for-each select="/incidencias/siniestros/actualizaciones/actualizacion[@estado='resuelto']">
                    <tr>                        
                        <td><xsl:value-of select="@siniestro" /></td>
                        <td><xsl:value-of select="@fecha" /></td>
                        <td><xsl:value-of select="." /></td>
                    </tr>
                    </xsl:for-each>
                </table>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>   