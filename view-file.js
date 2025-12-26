// view-file.js
// JavaScript utility to read and display content of a file in Node.js environment

const fs = require('fs');
const path = require('path');

/**
 * Reads a file asynchronously and logs its content to the console.
 * @param {string} filePath - Relative or absolute path to the file.
 */
function viewFile(filePath) {
  // Resolve the absolute path
  const absolutePath = path.resolve(filePath);

  // Check if file exists
  fs.access(absolutePath, fs.constants.F_OK, (err) => {
    if (err) {
      console.error(\`File not found: \${absolutePath}\`);
      return;
    }

    // Read the file asynchronously
    fs.readFile(absolutePath, 'utf8', (readErr, data) => {
      if (readErr) {
        console.error(\`Error reading file: \${absolutePath}\`);
        console.error(readErr);
        return;
      }

      console.log(\`--- Content of \${absolutePath} ---\n\`);
      console.log(data);
      console.log(\`\n--- End of file ---\`);
    });
  });
}

// If running directly, take first argument as file path
if (require.main === module) {
  const fileToView = process.argv[2];
  if (!fileToView) {
    console.error('Usage: node view-file.js <file-path>');
    process.exit(1);
  }
  viewFile(fileToView);
}
  

module.exports = viewFile;

