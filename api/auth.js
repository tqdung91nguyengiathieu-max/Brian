module.exports = (req, res) => {
  const host = req.headers.host;
  const protocol = host.startsWith('localhost') ? 'http' : 'https';
  const client_id = process.env.OAUTH_CLIENT_ID;
  
  if (!client_id) {
    res.status(500).send("Configuration Error: OAUTH_CLIENT_ID environment variable is missing on Vercel.");
    return;
  }

  const redirect_uri = `${protocol}://${host}/api/callback`;
  
  res.writeHead(302, {
    Location: `https://github.com/login/oauth/authorize?client_id=${client_id}&scope=repo,user&redirect_uri=${redirect_uri}`
  });
  res.end();
};
