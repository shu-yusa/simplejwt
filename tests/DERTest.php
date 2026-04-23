<?php

namespace SimpleJWT;

use SimpleJWT\Util\ASN1\DER;
use PHPUnit\Framework\TestCase;

class DERTest extends TestCase {
    // Regression test for PHP 8.5: encodeInteger() previously called ord()
    // on a multi-byte string, which is deprecated in 8.5.
    // See https://www.php.net/manual/en/migration85.deprecated.php
    function testEncodeIntegerMultiByte() {
        // 256 -> gmp_export yields "\x01\x00" (two bytes)
        $this->assertEquals("\x01\x00", DER::encodeInteger(256));
        // 32768 -> gmp_export yields "\x80\x00" (two bytes, first byte > 127)
        $this->assertEquals("\x00\x80\x00", DER::encodeInteger(32768));
    }
}
