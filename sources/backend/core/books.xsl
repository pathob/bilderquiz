<?xml version="1.0"?>

<xsl:stylesheet
	version="2.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	
	<xsl:template match="/">
		<books>
			<xsl:apply-templates select="/persons/person/books/book"/>
		</books>
	</xsl:template>
	<xsl:template match="book">
		<book>
			<xsl:copy-of select="../../personID"/>
			<xsl:copy-of select="*"/>
		</book>
	</xsl:template>
</xsl:stylesheet>
