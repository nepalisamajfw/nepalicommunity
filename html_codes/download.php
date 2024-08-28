<?php
// List of files and their corresponding codes
$files = [
    'file1.pdf' => 'code1',
    'file2.docx' => 'code2',
    // Add more files and codes as needed
];

// Get the file and code from the POST request
$file = $_POST['file'];
$code = $_POST['code'];

// Check if the file exists and the code matches
if (isset($files[$file]) && $files[$file] === $code) {
    $filePath = '../uploads/' . $file;

    // Check if the file exists on the server
    if (file_exists($filePath)) {
        // Set headers to force download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "Invalid code.";
}
?>
