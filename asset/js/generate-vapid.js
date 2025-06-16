const webpush = require('web-push');

const vapidKeys = webpush.generateVAPIDKeys();
console.log('Public Key:', vapidKeys.publicKey);
console.log('Private Key:', vapidKeys.privateKey);


// Public Key: BE6tPvnMLg3z-t39xrnkqUbtSDZguf839ISnOs8FNPR1-J4ifzYuv1CWM-DpRDni_HrUykF3DkQbmkMzRMJaoRo
// Private Key: B3OAGzU1Ia7y9N-Py0lXgzQn1dZMxg_13OxjOut1Z60