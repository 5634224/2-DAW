<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <html>
            <body>
                <h3>Listado de títulos disponibles para alquiler, agrupados por género:</h3>
                <ul>
                    <xsl:for-each select="/catalogo/titulos/genero">
                        <li>
                            <h4><xsl:value-of select="@nombre"></xsl:value-of></h4> <!-- Nombre del genero -->
                            <ul>
                                <xsl:for-each select="titulo[@alquiler]">
                                    <li>
                                        <xsl:value-of select="concat(@nombre, ' (', @anyo, ')')"></xsl:value-of> <!-- Nombre de la pelicula -->
                                        <!-- Datos sobre la pelicula -->
                                        <ul>
                                            <li>
                                                <xsl:value-of select="concat('Protagonista: ', reparto[@rol='protagonista']/@miembro)"></xsl:value-of>
                                            </li>
                                            <li>
                                                <xsl:value-of select="concat('Duración: ', @duracion, ' min')"></xsl:value-of>
                                            </li>
                                            <li>
                                                <b>
                                                    <xsl:value-of select="concat('Precio: ', @alquiler, ' €')"></xsl:value-of>
                                                </b>
                                            </li>
                                        </ul>
                                    </li>
                                </xsl:for-each>
                            </ul>
                        </li>
                    </xsl:for-each>
                </ul>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>