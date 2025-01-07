<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html"/>
<xsl:template match="/">
    <div id="newsLetterArchiveContainer">
        <div id="newsLetterArchiveTitle"><h2>Newsletter Archives</h2></div>
        <div id="newsLetterNotetoUser">Sign up Today! Our once a month email newsletter will keep you informed about any special deals, future classes and diving excursions.</div>
        <div id="newsLetterFormContainer">
            <form name="fNewsletters" id="fNewsletters" method="POST">
                <div>
                    <input type="hidden" name="ffCategoryId" id="ffCategoryId" value="{pages/page[@name = 'newsletters']/letters/@category}"/>
                    <label for="ffEmail">Email: </label>
                    <input type="text" name="ffEmail" id="ffEmail" maxlength="200" value=""/>
                </div>
                <div>
                    <input type="submit" value="Subscribe"/>
                </div>
            </form> 
        </div>
        <div id="newsLettersContainer">
        <xsl:for-each select="pages/page[@name = 'newsletters']/letters/letter">
            <div class="newsLetter">
                <div class="newsLetterNote"></div>
                <div class="newsLetterLink">
                    <a href=".{./filePath}{./fileName}"><xsl:value-of select="@name"/></a>
                </div>
            </div>
        </xsl:for-each>
        </div>
    </div>
</xsl:template>

</xsl:stylesheet>
