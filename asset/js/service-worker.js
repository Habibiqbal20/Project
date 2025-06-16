self.addEventListener('install', function (event) {
    console.log('[Service Worker] Installed');
    self.skipWaiting(); // langsung aktif
  });
  
  self.addEventListener('activate', function (event) {
    console.log('[Service Worker] Activated');
  });
  
  self.addEventListener('push', function (event) {
    const data = event.data ? event.data.json() : {
      title: "Notifikasi Default",
      body: "Isi pesan tidak tersedia.",
      icon: "https://via.placeholder.com/100"
    };
  
    const options = {
      body: data.body,
      icon: data.icon
    };
  
    event.waitUntil(
      self.registration.showNotification(data.title, options)
    );
  });
  