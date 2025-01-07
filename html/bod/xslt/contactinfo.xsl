<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html"/>
    <xsl:template match="/">
        <div id="contactDivContainer">
            <div>
                <xsl:value-of select="./pages/page[@name = 'contact']/contactInfo/address[@part = 1]"/><br/>
                <xsl:value-of select="./pages/page[@name = 'contact']/contactInfo/address[@part = 2]"/><br/>
                <xsl:value-of select="./pages/page[@name = 'contact']/contactInfo/town"/>, <xsl:value-of select="./pages/page[@name = 'contact']/contactInfo/state"/> <xsl:value-of select="./pages/page[@name = 'contact']/contactInfo/zip"/>
            </div>
            <div>
                HOURS:
                <xsl:for-each select="pages/page[@name = 'contact']/hoursofOperation/days/day">
                    <p>
                        <xsl:value-of select="@name"/><xsl:text> </xsl:text><xsl:value-of select="./from"/> <xsl:value-of select="./from/@period"/> - <xsl:value-of select="./to"/> <xsl:value-of select="./to/@period"/> 
                    </p>
                </xsl:for-each>
            </div>
            <div>
                <xsl:value-of select="./pages/page[@name = 'contact']/contactInfo/phone[@type = 1]" disable-output-escaping="yes"/><xsl:text> / </xsl:text><xsl:value-of select="./pages/page[@name = 'contact']/contactInfo/phone[@type = 'fax']"/><xsl:text> (fax) </xsl:text>
            </div>
            <div>
                Information email address:<br/>
                <xsl:value-of select="./pages/page[@name = 'contact']/contactInfo/siteEmail" disable-output-escaping="yes"/>
            </div>
            <div id="map">
                <xsl:value-of select="./pages/page[@name = 'contact']/contactInfo/map" disable-output-escaping="yes"/>
            </div>
            <div>
                From all Locations:
                <xsl:value-of select="./pages/page[@name = 'contact']/contactInfo/directions" disable-output-escaping="yes"/>
            </div>
            <xsl:value-of select="./pages/page[@name = 'contact']/form" disable-output-escaping="yes"/>
        </div>
    </xsl:template>
</xsl:stylesheet>
