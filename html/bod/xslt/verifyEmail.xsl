<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html"/>
    <xsl:template match="/">
        <div>
            <div class="responseTitle"><h6>Verify Email Response</h6></div>
            <div class="responseMsg">For email '<xsl:value-of select="pages/page[@name = 'act_verifyEmail']/email" disable-output-escaping="yes"/>'</div>
            
            <div class="replymsgs">
                <ul>
                    <xsl:for-each select="pages/page[@name = 'act_verifyEmail']/replymsgs/replymsg">
                        <li><xsl:value-of select="." disable-output-escaping="yes"/></li>
                    </xsl:for-each>
                </ul>
            </div>
            <xsl:if test="pages/page[@name = 'act_verifyEmail']/errormsgs/errormsg">
            <div class="errormsgs">
                <div>Errors:</div>
                <ul>
                    <xsl:for-each select="pages/page[@name = 'act_verifyEmail']/errormsgs/errormsg">
                        <li><xsl:value-of select="." disable-output-escaping="yes"/></li>
                    </xsl:for-each>
                </ul>
                <div>Please contact an <a href="mailto:information@blueoceandivers.com">administrator</a>.</div>
            </div>
            </xsl:if>
        </div>
        <div id="divVerifyEmail_Ok"><button id="btnVerifyEmail_Ok">OK</button></div>
    </xsl:template> 
</xsl:stylesheet>
