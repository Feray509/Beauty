<?php
    if (!isset($layoutParams)) {
        $layoutParams = [];
    }

    extract($layoutParams);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $pageTitle ?? element('title')->withContent('Document') ?>
    <?= implode("\n", $stylesheets ?? [])?>
    <?= implode("\n", $scripts ?? [])?>
</head>
<body>
    <?= implode($layoutBody ?? ["No content"])?>
</body>
</html>