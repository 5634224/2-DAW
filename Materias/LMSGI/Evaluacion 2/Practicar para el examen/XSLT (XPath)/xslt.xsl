<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">
        <html>
            <body>
                <h1>Prueba</h1>
                <ul>
                    <xsl:if test="expression">
                        <xsl:for-each select="/catalogo/titulos/genero">
                            <li>
                                <xsl:value-of select="concat(@nombre, ' (', @anyo, ')')"></xsl:value-of> <!-- Nombre de la pelicula -->
                            </li>
                        </xsl:for-each>
                    </xsl:if>
                </ul>
            </body>
        </html>
    </xsl:template>

</xsl:stylesheet>