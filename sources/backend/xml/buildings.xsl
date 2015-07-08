<?xml version="1.0"?>

<xsl:stylesheet
	version="2.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	
	<xsl:template match="/">
		<buildings>
			<xsl:apply-templates select="/persons/person/buildings/building"/>
		</buildings>
	</xsl:template>
	<xsl:template match="building">
		<building>
			<xsl:copy-of select="../../personID"/>
			<xsl:copy-of select="*"/>
		</building>
	</xsl:template>
</xsl:stylesheet>
