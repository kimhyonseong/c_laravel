<?php

function mark_down($text) {
    return app(ParsedownExtra::class)->text($text);
}

?>