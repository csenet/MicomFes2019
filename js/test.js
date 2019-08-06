$(function() {
  let localStream = null;
  let peer = null;
  let existingCall = null;
  function stopScreen(){
    screenshare.stop();
  }
  function stopCamera(){
    stream.getVideoTracks().forEach((track) => {
      track.stop();
    });
    stream.getAudioTracks().forEach((track) => {
      track.stop();
    });
  }

  function screensharing() {
    //画面共有
    const screenshare = ScreenShare.create({
      debug: true
    });
    if (screenshare.isScreenShareAvailable() === false) {
      alert('Chorome拡張機能を追加してください');
      return;
    }
    screenshare.start({
        width: $('#Width').val(),
        height: $('#Height').val(),
        frameRate: $('#FrameRate').val(),
      })
      .then(stream => {
        $('#my-video')[0].srcObject = stream;

        if (existingCall !== null) {
          const peerid = existingCall.peer;
          existingCall.close();
          const call = peer.call(peerid, stream);
          step3(call);
        }
        localStream = stream;
      })
      .catch(error => {
        console.log(error);
      });
  }

  function camerastream() {
    //カメラ映像配信
    let media = navigator.mediaDevices.getUserMedia({
      video: true, audio: true
    })
    .then(stream => {
      // Success
      $('#my-video').get(0).srcObject = stream;
      localStream = stream;
    })
    .catch(error => {
      // Error
      console.error('mediaDevice.getUserMedia() error:', error);
      return;
    });
  }

  $('#changeCamera').click(function(){
    camerastream();
  });

  $('#changeScreen').click(function(){
    screensharing();
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

  function addVideo(call, stream) {
    $('#their-video').get(0).srcObject = stream;
  }

  function removeVideo(peerId) {
    $('#their-video').get(0).srcObject = undefined;
  }

  function setupMakeCallUI() {
    $('#make-call').show();
    $('#end-call').hide();
  }

  function setupEndCallUI() {
    $('#make-call').hide();
    $('#end-call').show();
  }

  function setupCallEventHandlers(call) {
    if (existingCall) {
      existingCall.close();
    };
    existingCall = call;
    call.on('stream', function(stream) {
      addVideo(call, stream);
      setupEndCallUI();
      $('#thir-id').text(call.remoteId);
    });
    call.on('close', function() {
      removeVideo(call.remoteId);
      setupMakeCallUI();
    });
  }

  $('#make-call').submit(function(e) {
    e.preventDefault();
    const call = peer.call($('#callto-id').val(), localStream);
    setupCallEventHandlers(call);
  });
  $('#end-call').click(function() {
    existingCall.close();
  })
  peer.on('call', function(call) {
    call.answer(localStream);
    setupCallEventHandlers(call);
  });
  peer.on('close', function() {
    existingCall.close();
  });
});
