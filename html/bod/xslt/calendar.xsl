<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html"/>
    <xsl:template match="/">
        <xsl:for-each select="pages/page[@name = 'calendar']/calendars/calendar">
            <div class="calendar">
                <xsl:value-of select="." disable-output-escaping="yes"/>
            </div>
        </xsl:for-each>
    </xsl:template>
</xsl:stylesheet>
