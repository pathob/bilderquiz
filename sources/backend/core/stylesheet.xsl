<?xml version="1.0" encoding="iso-8859-1"?>
<xsl:stylesheet
    version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
>
	
	<xsl:template match="/Persons">
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
			<birthDE>
				<xsl:value-of select="birthDE" />
			</birthDE>
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
			<artworks>
				<xsl:for-each select="artworks/XML_Serializer_Tag" >	
					<artwork>
						<painting>
							<xsl:value-of select="artwork/value" />
						</painting>
						<thumbnail>
							<xsl:value-of select="thumbnail/value" />	
						</thumbnail>
						<name>
							<xsl:value-of select="name/value" />
						</name>
						<year>
							<xsl:value-of select="year/value" />
						</year>
						<abstract>
							<xsl:value-of select="wikilink/value" />
						</abstract>
					</artwork>
				</xsl:for-each>
			</artworks>
		</person>
    </xsl:template>
 
</xsl:stylesheet>