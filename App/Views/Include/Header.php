<?php
$menu = BF::GenerateList(DataBase::GetMenu(), '<a href="?">?</a>', ["Link", "Name"]);
$contacts = BF::GenerateList(DataBase::GetContacts(), '<span>?</span>', ["phones_text"]);

$Header = <<<EOF
{$menu}<br /><br /><br />
{LOGO} {SEARCH} {$contacts}<br /><br /><br />
EOF;

print($Header);
