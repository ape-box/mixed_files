<?php

    if (!isset($argc, $argv)) {
        exit(0);
    }

    if ($argc !== 2) {
        echo basename(__FILE__) . " can't parse arguments!\r\n";
        exit(0);
    }

    $subject      = $argv[1];

    if (is_file($subject)) {
        $subject = file_get_contents($subject);
    }

    $tag_p        = '<p(?:|\ [^>]*)>
                      (?:|&nbsp;| )*
                      <\/p>';
    $tag_br       = '<(?:b|h)r(?:|\ [^>]*)>';
    $line_endings = '[\r\n]+';

    $alternations = "(?:{$line_endings}|{$tag_br}|{$tag_p})+";
    $pattern      = "/(?:^{$alternations}|{$alternations}$)/ixD";
    $replacement  = '';

    $clean_text   = preg_replace($pattern, $replacement, $subject);

    echo "\r\n-----------------------------------------------------\r\n";
    echo $clean_text;
    echo "\r\n-----------------------------------------------------\r\n";
    echo "See file clean_text.txt\r\n";

    file_put_contents('clean_text.txt', $clean_text);

    exit(1);
