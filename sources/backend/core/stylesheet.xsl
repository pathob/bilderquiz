<?xml version="1.0" encoding="iso-8859-1"?>
<xsl:stylesheet
    version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
>
	
	<xsl:template match="/">
		<xsl:apply-templates select="Person"/>
	</xsl:template>
    <xsl:template match="Person">
		<person>
			<name>
				<xsl:value-of select="name" />
			</name>
			<variantName>
				<xsl:for-each select="variantName/XML_Serializer_Tag">
					<name>
						<xsl:apply-templates />
					</name>
				</xsl:for-each>
			</variantName>
			<thumbnail>
				<xsl:value-of select="thumbnail" />
			</thumbnail>
			<birthEN>
				<xsl:value-of select="birthEN" />
			</birthEN>
			<birthDE>
				<xsl:value-of select="birthDE" />
			</birthDE>
			<deathEN>
				<xsl:value-of select="deathEN" />
			</deathEN>
			<deathDE>
				<xsl:value-of select="deathDE" />
			</deathDE>
			<birthPlace>
				<xsl:value-of select="birthPlace" />
			</birthPlace>
			<deathPlace>
				<xsl:value-of select="deathPlace" />
			</deathPlace>
			<professions>
				<xsl:for-each select="professionOrOccupation/XML_Serializer_Tag" >
					<profession>
						<xsl:apply-templates />
					</profession>
				</xsl:for-each>
			</professions>
			<abstract>
				<xsl:value-of select="abstract" />
			</abstract>
		</person>
    </xsl:template>
 
</xsl:stylesheet>