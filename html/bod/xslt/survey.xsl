<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html"/>
<xsl:template match="/">
  <xsl:for-each select="pages/page[@name = 'surveys']/surveys/survey">
                <div id="surveyDiv">
                    <div><h3><xsl:value-of select="./@surveyName"/></h3></div>
                    <div class="msg"><xsl:value-of select="message" disable-output-escaping="yes"/></div>
                    <form name="{./@formName}" id="{./@formName}" method="POST" action="{./@action}">
                        <ol>
                            <xsl:for-each select="./question">
                                <li>
                                    <label class="surveyQuestion" for="ffQ_{./@id}"><xsl:value-of select="./questionText"/></label><br/>
                                    <xsl:if test="./@answerType = 'select multiple'">
                                        <select class="surveyAnswer" name="ffQ_{./@id}" id="ffQ_{./@id}" multiple="multiple">
                                            <option value=""> </option>
                                            <xsl:for-each select="./answer">
                                                <xsl:variable name="cnt" select="count(preceding-sibling::*)"/>
                                                <option value="{./@value}"><xsl:value-of select="."/></option>
                                            </xsl:for-each>
                                        </select>
                                    </xsl:if>

                                    <xsl:if test="./@answerType = 'select'">
                                        <select class="surveyAnswer" name="ffQ_{./@id}" id="ffQ_{./@id}">
                                            <option value=""> </option>
                                            <xsl:for-each select="./answer">
                                                <xsl:variable name="cnt" select="count(preceding-sibling::*)"/>
                                                <option value="{./@value}"><xsl:value-of select="."/></option>
                                            </xsl:for-each>
                                        </select>
                                    </xsl:if>

                                    <xsl:for-each select="./answer">
                                        <xsl:variable name="cnt" select="count(preceding-sibling::*)"/>
                                        <xsl:choose>
                                            <xsl:when test="./@type = 'text'">
                                                <input class="surveyAnswer" type="text" name="ffQ_{../@id}" id="ffQ_{../@id}" value=""/>
                                            </xsl:when>

                                            <xsl:when test="./@type = 'radio'">
                                                <label class="surveyAnswerText" for="ffQ_{../@id}"><xsl:value-of select="."/></label>
                                                <input class="surveyAnswer" type="radio" name="ffQ_{../@id}" id="ffQ{$cnt}_{../@id}" value="{./@value}"/><br/>
                                            </xsl:when>

                                            <xsl:when test="./@type = 'checkbox'">
                                                <label class="surveyAnswerText" for="ffQ{$cnt}_{../@id}"><xsl:value-of select="."/></label>
                                                <input class="surveyAnswer" type="checkbox" name="ffQ{$cnt}_{../@id}" id="ffQ{$cnt}_{../@id}" value="{./@value}"/><br/>
                                            </xsl:when>
                                            
                                            <xsl:when test="./@type = 'password'">
                                                <input class="surveyAnswer" type="password" name="ffQ_{../@id}" id="ffQ_{../@id}" value=""/>
                                            </xsl:when>
                                            
                                            <xsl:when test="./@type = 'submit'">
                                                <input class="surveyAnswer" type="submit" name="ffQ_{../@id}" id="ffQ_{../@id}" value=""/>
                                            </xsl:when>

                                            <xsl:when test="./@type = 'textarea'">
                                                <textarea class="surveyAnswer" name="ffQ_{../@id}" id="ffQ_{../@id}"></textarea>
                                            </xsl:when>

                                            <xsl:otherwise>
                                            </xsl:otherwise>
                                        </xsl:choose>
                                    </xsl:for-each>
                                </li>
                            </xsl:for-each>
                        </ol>
                        <div><input type="submit" value="Submit"/></div>
                    </form>
                </div>
    <xsl:value-of select="title"/>
    <xsl:value-of select="artist"/>
  </xsl:for-each>
</xsl:template>

</xsl:stylesheet>
