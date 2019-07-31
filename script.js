let localStream = null;
let peer = null;
let existingCall = null;

let media = navigator.mediaDevices.getUserMedia({
  video: true,
  audio: true
}).then(function(stream) {
  // Success
  my-video.srcObject = stream;
  $('#my-video').get(0).srcObject = stream;
  localStream = stream;
}).catch(function(error) {
  // Error
  console.error('mediaDevice.getUserMedia() error:', error);
  return;
});
peer = new Peer({
  ket: '',
  debug: 3
});
peer.on('open', function() {
  $('#my-id').text(peer.id);
});
peer.on('error', function(err) {
  console.log(err.message);
});
peer.on('close', function() {});
peer.on('disconnected', function() {});
