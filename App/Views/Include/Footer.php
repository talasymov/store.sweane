<?php
$Footer = <<<EOF
<hr />
Footer
EOF;

BF::IncludeScripts([
    "jquery/jquery-3.1.0.min",
    "bootstrap-3.3.7/js/bootstrap",
    "core/bootbox.min",
    "core/core"
]);

print($script);

print($Footer);
