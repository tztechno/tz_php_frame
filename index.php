<?php
$directoryPath = '/Users/shun_ishii/Downloads/doc';

function listFiles($directoryPath) {
    $files = scandir($directoryPath);
    if ($files === false) {
        return 'Unable to scan directory';
    }

    $fileLinks = array_map(function($file) use ($directoryPath) {
        if ($file == '.' || $file == '..') {
            return '';
        }
        $filePath = $directoryPath . '/' . $file;
        return "<li><a href=\"/file.php?filename=" . urlencode($file) . "\">" . htmlspecialchars($file) . "</a></li>";
    }, $files);

    return implode('', $fileLinks);
}

$fileLinks = listFiles($directoryPath);
?>
<!DOCTYPE html>
<html>
<head>
    <title>File List</title>
</head>
<body>
    <h1>Files in <?php echo htmlspecialchars($directoryPath); ?></h1>
    <ul>
        <?php echo $fileLinks; ?>
    </ul>
</body>
</html>
