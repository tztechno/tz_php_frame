<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Markdown Viewer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        textarea {
            width: 100%;
            height: 200px;
            margin-bottom: 20px;
            font-family: monospace;
        }
        #output {
            border: 1px solid #ccc;
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>Markdown Viewer</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file" accept=".md">
        <button type="submit">Upload</button>
    </form>

    <textarea id="markdown-input" placeholder="Enter your markdown text here..."><?php
        if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['file']['tmp_name'];
            $markdownText = file_get_contents($fileTmpPath);
            echo htmlspecialchars($markdownText);
        }
    ?></textarea>
    <div id="output"></div>

    <!-- Marked.jsライブラリをCDNから読み込む -->
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const markdownText = document.getElementById('markdown-input').value;
            if (markdownText) {
                const htmlContent = marked.parse(markdownText);
                document.getElementById('output').innerHTML = htmlContent;
            }
        });

        document.getElementById('markdown-input').addEventListener('input', function () {
            const markdownText = this.value;
            const htmlContent = marked.parse(markdownText);
            document.getElementById('output').innerHTML = htmlContent;
        });
    </script>
</body>
</html>
