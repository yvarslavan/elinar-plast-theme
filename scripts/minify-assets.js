const fs = require('node:fs');
const path = require('node:path');
const postcss = require('postcss');
const cssnano = require('cssnano');
const UglifyJS = require('uglify-js');

const args = new Set(process.argv.slice(2));
const runCss = args.size === 0 || args.has('--css');
const runJs = args.size === 0 || args.has('--js');

const rootDir = process.cwd();

const cssInputPath = path.join(rootDir, 'style.css');
const cssOutputPath = path.join(rootDir, 'style.min.css');
const jsInputPath = path.join(rootDir, 'assets', 'js', 'main.js');
const jsOutputPath = path.join(rootDir, 'assets', 'js', 'main.min.js');

function formatBytes(bytes) {
  if (bytes < 1024) {
    return `${bytes} B`;
  }

  return `${(bytes / 1024).toFixed(2)} KB`;
}

async function minifyCss() {
  const sourceCss = fs.readFileSync(cssInputPath, 'utf8');
  const result = await postcss([
    cssnano({
      preset: 'default',
    }),
  ]).process(sourceCss, {
    from: cssInputPath,
    to: cssOutputPath,
    map: false,
  });

  fs.writeFileSync(cssOutputPath, result.css, 'utf8');

  const inputSize = Buffer.byteLength(sourceCss, 'utf8');
  const outputSize = Buffer.byteLength(result.css, 'utf8');
  const savedSize = inputSize - outputSize;

  console.log(
    `[CSS] ${path.relative(rootDir, cssOutputPath)}: ${formatBytes(inputSize)} -> ${formatBytes(outputSize)} (saved ${formatBytes(savedSize)})`
  );
}

function minifyJs() {
  const sourceJs = fs.readFileSync(jsInputPath, 'utf8');
  const result = UglifyJS.minify(sourceJs, {
    compress: {
      drop_console: true,
    },
    mangle: true,
    output: {
      comments: false,
    },
  });

  if (result.error) {
    throw result.error;
  }

  const minifiedJs = result.code || '';
  fs.writeFileSync(jsOutputPath, minifiedJs, 'utf8');

  const inputSize = Buffer.byteLength(sourceJs, 'utf8');
  const outputSize = Buffer.byteLength(minifiedJs, 'utf8');
  const savedSize = inputSize - outputSize;

  console.log(
    `[JS]  ${path.relative(rootDir, jsOutputPath)}: ${formatBytes(inputSize)} -> ${formatBytes(outputSize)} (saved ${formatBytes(savedSize)})`
  );
}

async function run() {
  if (!runCss && !runJs) {
    console.error('Unknown flags. Use --css and/or --js.');
    process.exit(1);
  }

  if (runCss) {
    await minifyCss();
  }

  if (runJs) {
    minifyJs();
  }
}

run().catch((error) => {
  console.error(error);
  process.exit(1);
});
