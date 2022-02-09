const { OAuth2Client } = require("google-auth-library");

function verify(token) {
  if (token) {
    const client = new OAuth2Client(token);
    const CLIENT_ID =
      "392248596012-t846ug2h9503p1h3f8p9b82vhq2moveh.apps.googleusercontent.com";

    let isVerified = true;
    client
      .verifyIdToken({
        idToken: token,
        audience: CLIENT_ID,
      })
      .then((response) => {
        const payload = response.payload;
        if (
          !payload.aud === CLIENT_ID ||
          !payload.iss.includes("accounts.google.com") ||
          payload.exp < Date.now()
        ) {
          isVerified = false;
        }
      })
      .catch((error) => {
        console.log(error);
        isVerified = false;
      });
    return isVerified;
  }
}

module.exports = { verify };
