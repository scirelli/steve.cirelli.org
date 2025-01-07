<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html"/>
    <!--TODO: Tokenize() does not seem to work. item-at does not exist on wc3. Need a way to loop through/over a list of lvlType_ids 
                <xsl:template name="RecurseConvertChoicesToImages">
                    <xsl:param name="choices" />

                    <xsl:variable name="token"
                        select="substring-before($choices, ';#')" />
                    <xsl:variable name="nextToken"
                        select="substring-after($choices, ';#')" />

                    <xsl:if test="$token">
                        <img src="http://mysite/content-{$token}.jpg" />
                    </xsl:if>
                    <xsl:if test="$nextToken">
                        <xsl:call-template name="RecurseConvertChoicesToImages">
                            <xsl:with-param name="choices" select="$nextToken" />
                        </xsl:call-template>
                    </xsl:if>
                </xsl:template>
                <xsl:variable name="sampleString">XML,XSLT,XPath,SVG,XPointer</xsl:variable>
                <xsl:variable name="tokenizedSample" select="tokenize($sampleString,',+')"/>
                <xsl:value-of select="item-at($tokenizedSample,2)"/>
                <xsl:for-each select="$tokenizedSample">
                    1
                </xsl:for-each>
    -->
    <xsl:template match="/">
        <div id="courseContainer">
            <div id="coursesHeaderDiv">
                <div><span><h3>Diving Education Programs</h3></span></div> 
                <div>
                    We are the only <span class="fiveStarDC"><em><a href="http://www.padi.com/scuba/call-to-actions/locate-a-scuba-dive-shop/dive-shop-and-resort-levels/default.aspx">PADI 5 Star Dive Center</a></em></span> in the Southern Tier. 
                    Our on-site instructor's credentials range from Open Water Scuba Instructor to Master Instructor. All of our instructors 
                    are avid divers and have a wide range of experiences and expertise in different diving environments. Their knowledge 
                    together with the PADI program of diver education allows us to offer you the world's most distinguished SCUBA instruction. 
                    After completion of your Open Water or continuing education class you will have the confidence and ability to further 
                    explore the underwater world.
                </div>
            </div>
            <div id="coursesContentDiv" class="table">
                <div class="section">
                    <div class="tr">
                        <div class="th"><xsl:value-of select="pages/page[@name = 'courses']/courses/course/lvlType[@id=2]"/></div>
                        <div class="th">Cost</div>
                        <div class="th">Duration</div>
                        <div class="th">Start Date</div>
                    </div>
                    <xsl:for-each select="pages/page[@name = 'courses']/courses/course/lvlType[@id=2]">
                    <div class="tr">
                        <div class="td"><xsl:value-of select="../padiLevel"/></div> 
                        <div class="td"><xsl:text>$</xsl:text><xsl:value-of select="../cost"/></div> 
                        <div class="td"><xsl:value-of select="../duration"/><xsl:text> hr(s)</xsl:text></div> 
                        <div class="td"><xsl:value-of select="../startDate"/></div> 
                    </div>
                    </xsl:for-each>
                </div>

                <div class="section">
                    <div class="tr">
                        <div class="th"><xsl:value-of select="pages/page[@name = 'courses']/courses/course/lvlType[@id=3]"/></div>
                        <div class="th">Cost</div>
                        <div class="th">Duration</div>
                        <div class="th">Start Date</div>
                    </div>
                    <xsl:for-each select="pages/page[@name = 'courses']/courses/course/lvlType[@id=3]">
                    <div class="tr">
                        <div class="td"><xsl:value-of select="../padiLevel"/></div> 
                        <div class="td"><xsl:text>$</xsl:text><xsl:value-of select="../cost"/></div> 
                        <div class="td"><xsl:value-of select="../duration"/><xsl:text> hr(s)</xsl:text></div> 
                        <div class="td"><xsl:value-of select="../startDate"/></div> 
                    </div>
                    </xsl:for-each>
                </div>

                <div class="section">
                    <div class="tr">
                        <div class="th"><xsl:value-of select="pages/page[@name = 'courses']/courses/course/lvlType[@id=4]"/></div>
                        <div class="th">Cost</div>
                        <div class="th">Duration</div>
                        <div class="th">Start Date</div>
                    </div>
                    <xsl:for-each select="pages/page[@name = 'courses']/courses/course/lvlType[@id=4]">
                    <div class="tr">
                        <div class="td"><xsl:value-of select="../padiLevel"/></div> 
                        <div class="td"><xsl:text>$</xsl:text><xsl:value-of select="../cost"/></div> 
                        <div class="td"><xsl:value-of select="../duration"/><xsl:text> hr(s)</xsl:text></div> 
                        <div class="td"><xsl:value-of select="../startDate"/></div> 
                    </div>
                    </xsl:for-each>
                </div>

                <div class="section">
                    <div class="tr">
                        <div class="th"><xsl:value-of select="pages/page[@name = 'courses']/courses/course/lvlType[@id=5]"/></div>
                        <div class="th">Cost</div>
                        <div class="th">Duration</div>
                        <div class="th">Start Date</div>
                    </div>
                    <xsl:for-each select="pages/page[@name = 'courses']/courses/course/lvlType[@id=5]">
                    <div class="tr">
                        <div class="td"><xsl:value-of select="../padiLevel"/></div> 
                        <div class="td"><xsl:text>$</xsl:text><xsl:value-of select="../cost"/></div> 
                        <div class="td"><xsl:value-of select="../duration"/><xsl:text> hr(s)</xsl:text></div> 
                        <div class="td"><xsl:value-of select="../startDate"/></div> 
                    </div>
                    </xsl:for-each>
                </div>

                <div class="section">
                    <div class="tr">
                        <div class="th"><xsl:value-of select="pages/page[@name = 'courses']/courses/course/lvlType[@id=6]"/></div>
                        <div class="th">Cost</div>
                        <div class="th">Duration</div>
                        <div class="th">Start Date</div>
                    </div>
                    <xsl:for-each select="pages/page[@name = 'courses']/courses/course/lvlType[@id=6]">
                    <div class="tr">
                        <div class="td"><xsl:value-of select="../padiLevel"/></div> 
                        <div class="td"><xsl:text>$</xsl:text><xsl:value-of select="../cost"/></div> 
                        <div class="td"><xsl:value-of select="../duration"/><xsl:text> hr(s)</xsl:text></div> 
                        <div class="td"><xsl:value-of select="../startDate"/></div> 
                    </div>
                    </xsl:for-each>
                </div>

                <div class="section">
                    <div class="tr">
                        <div class="th"><xsl:value-of select="pages/page[@name = 'courses']/courses/course/lvlType[@id=7]"/></div>
                        <div class="th">Cost</div>
                        <div class="th">Duration</div>
                        <div class="th">Start Date</div>
                    </div>
                    <xsl:for-each select="pages/page[@name = 'courses']/courses/course/lvlType[@id=7]">
                    <div class="tr">
                        <div class="td"><xsl:value-of select="../padiLevel"/></div> 
                        <div class="td"><xsl:text>$</xsl:text><xsl:value-of select="../cost"/></div> 
                        <div class="td"><xsl:value-of select="../duration"/><xsl:text> hr(s)</xsl:text></div> 
                        <div class="td"><xsl:value-of select="../startDate"/></div> 
                    </div>
                    </xsl:for-each>
                </div>

                <div class="section">
                    <div class="tr">
                        <div class="th"><xsl:value-of select="pages/page[@name = 'courses']/courses/course/lvlType[@id=8]"/></div>
                        <div class="th">Cost</div>
                        <div class="th">Duration</div>
                        <div class="th">Start Date</div>
                    </div>
                    <xsl:for-each select="pages/page[@name = 'courses']/courses/course/lvlType[@id=8]">
                    <div class="tr">
                        <div class="td"><xsl:value-of select="../padiLevel"/></div> 
                        <div class="td"><xsl:text>$</xsl:text><xsl:value-of select="../cost"/></div> 
                        <div class="td"><xsl:value-of select="../duration"/><xsl:text> hr(s)</xsl:text></div> 
                        <div class="td"><xsl:value-of select="../startDate"/></div> 
                    </div>
                    </xsl:for-each>
                </div>

                <div class="section">
                    <div class="tr">
                        <div class="th"><xsl:value-of select="pages/page[@name = 'courses']/courses/course/lvlType[@id=10]"/></div>
                        <div class="th">Cost</div>
                        <div class="th">Duration</div>
                        <div class="th">Start Date</div>
                    </div>
                    <xsl:for-each select="pages/page[@name = 'courses']/courses/course/lvlType[@id=10]">
                    <div class="tr">
                        <div class="td"><xsl:value-of select="../padiLevel"/></div> 
                        <div class="td"><xsl:text>$</xsl:text><xsl:value-of select="../cost"/></div> 
                        <div class="td"><xsl:value-of select="../duration"/><xsl:text> hr(s)</xsl:text></div> 
                        <div class="td"><xsl:value-of select="../startDate"/></div> 
                    </div>
                    </xsl:for-each>
                </div>
            </div>
        </div>
    </xsl:template>
</xsl:stylesheet>
