let localStream = null;
let peer = null;
let existingCall = null;

let media = navigator.mediaDevices.getUserMedia({
  /*
  video: {
    facingMode : {
      exact: "environment" //スマホのリアカメラにアクセス
    }
  },*/
  video: true,
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
  key: '4852b666-0601-4aaf-b74c-1e099ce0860a',
  debug: 3
});
peer.on('open', function() {
  $('#my-id').text(peer.id);
});
peer.on('error', function(err) {
  console.log(err.message);
});
peer.on('disconnected', function() {});

function addVideo(call,stream){
  $('#their-video').get(0).srcObject = stream;
}
function removeVideo(peerId){
  $('#their-video').get(0).srcObject = undefined;
}
function setupMakeCallUI(){
    $('#make-call').show();
    $('#end-call').hide();
}

function setupEndCallUI() {
    $('#make-call').hide();
    $('#end-call').show();
}

function setupCallEventHandlers(call){
    if (existingCall) {
        existingCall.close();
    };
    existingCall = call;
    call.on('stream', function(stream){
      addVideo(call,stream);
      setupEndCallUI();
      $('#thir-id').text(call.remoteId);
    });
    call.on('close', function(){
        removeVideo(call.remoteId);
        setupMakeCallUI();
    });
}

$('#make-call').submit(function(e){
  e.preventDefault();
  const call = peer.call($('#callto-id').val(), localStream);
  setupCallEventHandlers(call);
});
$('#end-call').click(function(){
  existingCall.close();
})
peer.on('call', function(call){
  call.answer(localStream);
  setupCallEventHandlers(call);
});
peer.on('close', function() {
  existingCall.close();
});
