const fs = require('fs');
const path = require('path');

// Ensure dist directory exists and is clean
const distPath = path.join(__dirname, 'dist');
if (fs.existsSync(distPath)) {
    fs.rmSync(distPath, { recursive: true, force: true });
}
fs.mkdirSync(distPath);

// Helper to copy directory recursively
function copyDir(src, dest) {
    fs.mkdirSync(dest, { recursive: true });
    const entries = fs.readdirSync(src, { withFileTypes: true });
    for (let entry of entries) {
        const srcPath = path.join(src, entry.name);
        const destPath = path.join(dest, entry.name);
        if (entry.isDirectory()) {
            copyDir(srcPath, destPath);
        } else {
            fs.copyFileSync(srcPath, destPath);
        }
    }
}

// Copy static assets and folders to dist
copyDir(path.join(__dirname, 'assets'), path.join(distPath, 'assets'));
copyDir(path.join(__dirname, 'admin'), path.join(distPath, 'admin'));
copyDir(path.join(__dirname, 'content'), path.join(distPath, 'content'));
fs.copyFileSync(path.join(__dirname, 'index.html'), path.join(distPath, 'index.html'));
fs.copyFileSync(path.join(__dirname, 'style.css'), path.join(distPath, 'style.css'));

// Create posts directory in dist
const distPostsPath = path.join(distPath, 'posts');
fs.mkdirSync(distPostsPath);

// Read post template
const postTemplate = fs.readFileSync(path.join(__dirname, 'post.html'), 'utf8');

// Process all posts
const postsDir = path.join(__dirname, 'content', 'posts');
if (fs.existsSync(postsDir)) {
    const files = fs.readdirSync(postsDir);
    for (const file of files) {
        if (file.endsWith('.json')) {
            const slug = file.replace('.json', '');
            const postData = JSON.parse(fs.readFileSync(path.join(postsDir, file), 'utf8'));
            
            const title = postData.title || 'Bài viết';
            const excerpt = postData.excerpt || 'Đọc bài viết hay nhất tại Brian Crypto Việt';
            const image = postData.image || 'https://images.unsplash.com/photo-1621761191319-c6fb62004040?auto=format&fit=crop&w=1200&q=80';
            
            // Inject SEO meta tags into the template
            const seoMeta = `
    <!-- SEO and Social Sharing Media Previews (Facebook, Zalo, Telegram) -->
    <title>${title} - Brian Crypto Việt</title>
    <meta name="description" content="${excerpt.replace(/"/g, '&quot;')}">
    <meta property="og:type" content="article">
    <meta property="og:title" content="${title.replace(/"/g, '&quot;')}">
    <meta property="og:description" content="${excerpt.replace(/"/g, '&quot;')}">
    <meta property="og:image" content="${image}">
    <meta property="og:url" content="https://briancryptoviet.netlify.app/posts/${slug}.html">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="${title.replace(/"/g, '&quot;')}">
    <meta name="twitter:description" content="${excerpt.replace(/"/g, '&quot;')}">
    <meta name="twitter:image" content="${image}">
            `;
            
            // Replace <title> tag with the full SEO metadata block
            let compiledHtml = postTemplate.replace(/<title>.*?<\/title>/i, seoMeta);
            
            // Adjust relative links & assets for the subfolder (/posts/)
            compiledHtml = compiledHtml
                .replace(/href="style\.css"/g, 'href="../style.css"')
                .replace(/href="index\.html"/g, 'href="../index.html"')
                .replace(/src="assets\/images\/logo\.png"/g, 'src="../assets/images/logo.png"');
            
            // Write compiled HTML to dist/posts/[slug].html
            fs.writeFileSync(path.join(distPostsPath, `${slug}.html`), compiledHtml, 'utf8');
            console.log(`Generated pre-rendered HTML for post: ${slug}`);
        }
    }
}

// Copy original post.html to dist/post.html for local fallback compatibility
fs.copyFileSync(path.join(__dirname, 'post.html'), path.join(distPath, 'post.html'));

console.log("Static site build completed successfully!");
