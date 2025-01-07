<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html"/>

<xsl:template match="/">
    <xsl:for-each select="pages/page[@name = 'staff']/staff">
        <xsl:if test="./@id != 1">
        <div class="staffContentDiv">
            <div>
                <h3>
                    <span><xsl:value-of select="firstName" disable-output-escaping="yes"/><xsl:text disable-output-escaping="yes"> </xsl:text></span>
                    <span><xsl:value-of select="lastName" disable-output-escaping="yes"/></span>
                </h3>
                <h5>
                    <span>A.K.A.</span><xsl:text disable-output-escaping="yes"> </xsl:text>
                    <span>"<xsl:value-of select="nickName" disable-output-escaping="yes"/>"</span>
                </h5>
            </div>
            <img src=".{./filePath}{./fileName}"/>
            <div class="story"> <xsl:value-of select="story" disable-output-escaping="yes"/> </div>
        </div>
        </xsl:if>
    </xsl:for-each>
</xsl:template>

</xsl:stylesheet>
