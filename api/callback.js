const https = require('https');

module.exports = (req, res) => {
  const code = req.query.code;
  const client_id = process.env.OAUTH_CLIENT_ID;
  const client_secret = process.env.OAUTH_CLIENT_SECRET;

  if (!client_id || !client_secret) {
    res.status(500).send("Configuration Error: OAUTH_CLIENT_ID or OAUTH_CLIENT_SECRET environment variable is missing on Vercel.");
    return;
  }

  if (!code) {
    res.status(400).send("Error: Missing authorization code from GitHub.");
    return;
  }

  const postData = JSON.stringify({
    client_id,
    client_secret,
    code
  });

  const options = {
    hostname: 'github.com',
    path: '/login/oauth/access_token',
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'Content-Length': Buffer.byteLength(postData)
    }
  };

  const request = https.request(options, (response) => {
    let body = '';
    response.on('data', (chunk) => {
      body += chunk;
    });

    response.on('end', () => {
      try {
        const data = JSON.parse(body);
        if (data.error) {
          res.status(400).send(`GitHub OAuth Error: ${data.error_description || data.error}`);
          return;
        }

        const token = data.access_token;
        const provider = 'github';

        // Render the script that sends the token back to Decap CMS window
        res.setHeader('Content-Type', 'text/html; charset=utf-8');
        res.status(200).send(`
          <!DOCTYPE html>
          <html>
            <head>
              <title>Xác thực thành công</title>
            </head>
            <body>
              <script>
                (function() {
                  function postMessage(state, data) {
                    window.opener.postMessage(
                      'authorization:' + provider + ':' + state + ':' + JSON.stringify(data),
                      window.origin
                    );
                  }
                  
                  const token = "${token}";
                  if (token) {
                    postMessage('success', { token: token, provider: provider });
                    window.close();
                  } else {
                    postMessage('error', { message: 'Failed to retrieve access token' });
                    window.close();
                  }
                })();
              </script>
              <p style="text-align: center; margin-top: 50px; font-family: sans-serif; color: #475569;">
                Đăng nhập thành công! Đang chuyển hướng quay lại quản trị...
              </p>
            </body>
          </html>
        `);
      } catch (err) {
        res.status(500).send("Failed to parse token response from GitHub.");
      }
    });
  });

  request.on('error', (err) => {
    res.status(500).send(`Request error: ${err.message}`);
  });

  request.write(postData);
  request.end();
};
