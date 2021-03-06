`core:TargetedID`
=================

This filter generates the `eduPersonTargetedID` attribute for the user.

This filter will use the contents of the attribute set by the `attributename` option as the unique user ID.

Parameters
----------

`attributename`
:   The name of the attribute we should use for the unique user identifier.

    Note: only the first value of the specified attribute is being used for the generation of the identifier.

`nameId`
:   Set this option to `TRUE` to generate the attribute as in SAML 2 NameID format.
    This can be used to generate an Internet2 compatible `eduPersonTargetedID` attribute.
    Optional, defaults to `FALSE`.


Examples
--------

A custom attribute:

    'authproc' => array(
        50 => array(
            'class' => 'core:TargetedID',
            'attributename' => 'eduPersonPrincipalName'
        ),
    ),

Internet2 compatible `eduPersontargetedID`:

    /* In saml20-idp-hosted.php. */
    $metadata['__DYNAMIC:1__'] = array(
        'host' => '__DEFAULT__',
        'auth' => 'example-static',

        'authproc' => array(
            60 => array(
                'class' => 'core:TargetedID',
                'nameId' => TRUE,
            ),
            90 => array(
                'class' => 'core:AttributeMap',
                'name2oid',
            ),
        ),
        'attributes.NameFormat' => 'urn:oasis:names:tc:SAML:2.0:attrname-format:uri',
        'attributeencodings' => array(
            'urn:oid:1.3.6.1.4.1.5923.1.1.1.10' => 'raw', /* eduPersonTargetedID with oid NameFormat. */
        ),
    );
