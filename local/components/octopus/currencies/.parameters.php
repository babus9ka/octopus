<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
    "PARAMETERS" => array(
        "MARKUP_USER" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("MARKUP_USER"),
            "TYPE" => "STRING",
            "DEFAULT" => null,
        ),
        "MARKUP" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("MARKUP"),
            "TYPE" => "STRING",
            "DEFAULT" => null,
        )
    ),
);
?>
