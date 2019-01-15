<?xml version="1.0" encoding="UTF-8"?>
<!-- TEI -->
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns:foxml="info:fedora/fedora-system:def/foxml#" xmlns:tei="http://www.tei-c.org/ns/1.0">

   <xsl:template match="foxml:datastream[starts-with(@ID, 'TEI-') and contains(@ID, '_1')]/foxml:datastreamVersion[last()]" name="index_TEI1">
    <xsl:param name="content"/>
    <xsl:param name="prefix">TEI_</xsl:param>
    <xsl:param name="suffix">_ms</xsl:param>

    <field name="tei_title_ms">
	<xsl:value-of select="$content//tei:teiHeader/tei:fileDesc/tei:titleStmt/tei:title"/>
    </field>

    <field name="tei_title_first_line_ms">
	<xsl:value-of select="$content//tei:teiHeader/tei:fileDesc/tei:titleStmt/tei:title[@type='first_line']"/>
    </field>

    <field name="tei_bibl_title_ms">
	<xsl:value-of select="$content//tei:teiHeader/tei:fileDesc/tei:sourceDesc/tei:bibl/tei:title"/>
    </field>

    <field name="tei_bibl_author_composer_ms">
	<xsl:value-of select="$content//tei:teiHeader/tei:fileDesc/tei:sourceDesc/tei:bibl/tei:author[@role='composer']"/>
    </field>

    <field name="tei_bibl_author_poet_ms">
	<xsl:value-of select="$content//tei:teiHeader/tei:fileDesc/tei:sourceDesc/tei:bibl/tei:author[@role='poet']"/>
    </field>

    <field name="tei_bibl_pub_place_ms">
	<xsl:value-of select="$content//tei:teiHeader/tei:fileDesc/tei:sourceDesc/tei:bibl/tei:pubPlace"/>
    </field>

    <field name="tei_bibl_date_ms">
	<xsl:value-of select="$content//tei:teiHeader/tei:fileDesc/tei:sourceDesc/tei:bibl/tei:date[@type='publication']"/>
    </field>

    <field name="tei_idno_wing_ms">
	<xsl:value-of select="$content//tei:teiHeader/tei:fileDesc/tei:sourceDesc/tei:bibl/tei:idno[@type='wing']"/>
    </field>

    <field name="tei_idno_callnum_ms">
	<xsl:value-of select="$content//tei:teiHeader/tei:fileDesc/tei:sourceDesc/tei:bibl/tei:idno[@type='call_number']"/>
    </field>

    <field name="tei_bibl_leaf_ms">
	<xsl:value-of select="$content//tei:teiHeader/tei:fileDesc/tei:sourceDesc/tei:bibl/tei:biblScope[@unit='leaf']"/>
    </field>

    <field name="tei_bibl_page_ms">
	<xsl:value-of select="$content//tei:teiHeader/tei:fileDesc/tei:sourceDesc/tei:bibl/tei:biblScope[@unit='page']"/>
    </field>

  </xsl:template>
</xsl:stylesheet>



