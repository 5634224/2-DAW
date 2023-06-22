<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">
        <html>
            <body>
                <h3>Prevision de temperaturas para Madrid</h3>
                <table>
                    <theader>
                        <th>Fecha</th>
                        <th>Mínima</th>
                        <th>Máxima</th>
                        <th>Observaciones</th>
                    </theader>
                    <tbody>
                        <xsl:for-each select="/prevision/ciudades/ciudad[@nombre='Madrid']/dia">
                            <tr>
                                <td>
                                    <xsl:value-of select="@fecha"></xsl:value-of>
                                </td>
                                <td>
                                    <xsl:value-of select="temperatura/@minima"></xsl:value-of>
                                </td>
                                <td>
                                    <xsl:value-of select="temperatura/@maxima"></xsl:value-of>
                                </td>
                                <td>
                                    <xsl:value-of select="observaciones"></xsl:value-of>
                                </td>
                            </tr>
                        </xsl:for-each>
                    </tbody>
                </table>
            </body>
        </html>
    </xsl:template>

</xsl:stylesheet>