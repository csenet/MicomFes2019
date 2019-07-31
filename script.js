let localStream = null;
let peer = null;
let existingCall = null;

let media = navigator.mediaDevices.getUserMedia({
  video: {
    facingMode : {
      exact: "environment" //スマホのリアカメラにアクセス
    }
  },
  audio: true
});
media.then(function(stream) {
  // Success
  $('#my-video').get(0).srcObject = stream;
  localStream = stream;
});
media.catch(function(error) {
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
