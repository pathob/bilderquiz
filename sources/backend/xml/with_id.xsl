<?xml version="1.0"?>

<xsl:stylesheet
	version="2.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	
	<xsl:template match="@*|node()">
		<xsl:copy>
			<xsl:apply-templates select="@*|node()"/>
		</xsl:copy> 
	</xsl:template>
	<xsl:template match="person">
		<xsl:copy>
			<personID ID="{generate-id()}" />
				
			<xsl:apply-templates select="@* | *"/>
		</xsl:copy> 		
	</xsl:template>
</xsl:stylesheet>
