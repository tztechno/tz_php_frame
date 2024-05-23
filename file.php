<?php
require 'vendor/autoload.php'; // Composerのオートロードファイルを読み込む

use Parsedown;

$directoryPath = '/Users/shun_ishii/Downloads/doc';
$filename = isset($_GET['filename']) ? $_GET['filename'] : '';
$filePath = $directoryPath . '/' . $filename;

if (!file_exists($filePath)) {
    http_response_code(404);
    echo 'File not found';
    exit;
}

$content = file_get_contents($filePath);
if ($content === false) {
    http_response_code(500);
    echo 'Unable to read file';
    exit;
}

$parsedown = new Parsedown();
$isMarkdown = pathinfo($filePath, PATHINFO_EXTENSION) === 'md';

?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($filename); ?></title>
</head>
<body>
    <?php if ($isMarkdown): ?>
        <?php echo $parsedown->text($content); ?>
    <?php else: ?>
        <pre><?php echo htmlspecialchars($content); ?></pre>
    <?php endif; ?>
</body>
</html>
