<?xml version="1.0"?>

<xsl:stylesheet
	version="2.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	
	<xsl:template match="/">
		<artworks>
			<xsl:apply-templates select="/persons/person/artworks/artwork"/>
		</artworks>
	</xsl:template>
	<xsl:template match="artwork">
		<artwork>
			<xsl:copy-of select="../../personID"/>
			<xsl:copy-of select="*"/>
		</artwork>
	</xsl:template>
</xsl:stylesheet>
