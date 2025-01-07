<?xml version="1.0" encoding="iso-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html" encoding="iso-8859-1"/>
	<xsl:template match="/">
		<ul id="faqQList" class="showFaq">
			<xsl:for-each select="faqs/faq">
				<li><a href="javascript:void(0);" faqid="{./question/@ID}" onclick="sendRequestAnswer({./question/@ID});"><xsl:value-of select="question"/></a></li>
			</xsl:for-each>
		</ul>
	</xsl:template>
</xsl:stylesheet>

<?xml version="1.0" encoding="iso-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html" encoding="iso-8859-1"/>
	<xsl:template match="/">
			<xsl:for-each select="faqs/faq">
				<div>
					<xsl:value-of select="answer"/>
				</div>
			</xsl:for-each>
	</xsl:template>
</xsl:stylesheet>


<?xml version="1.0" encoding="iso-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html" encoding="iso-8859-1"/>
	<xsl:template match="/">
		<span>Supported Locations</span>
		<ul id="baseListUl">
			<xsl:for-each select="bases/base">
				<li id="baseListLi_{./name/@ID}"><a href="javascript:void(0)" bid="{./name/@ID}" onclick="sendRequestBaseClick({./name/@ID});"><xsl:value-of select="name"/><xsl:text>, </xsl:text><xsl:value-of select="state"/></a></li>
			</xsl:for-each>
		</ul>
	</xsl:template>
</xsl:stylesheet>

