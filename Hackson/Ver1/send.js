'use strict'
$(function() {
  let localStream = null;
  let peer = null;
  let existingCall = null;
  let constraints = {
    video: {},
    audio: true
  };
  constraints.video.width = {
    min: 320,
    max: 320
  };
  constraints.video.height = {
    min: 240,
    max: 240
  };

  function Camera() {
    navigator.mediaDevices.getUserMedia(constraints)
      .then(function(stream) {
        $('#myStream').get(0).srcObject = stream;
        localStream = stream;
      }).catch(function(error) {
        console.error('mediaDevice.getUserMedia() error:', error);
        return;
      });
  }

  function Screen() {
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
        $('#myStream')[0].srcObject = stream;
        localStream = stream;
      })
      .catch(error => {
        console.log(error);
      });
  }

  $('#switch-camera').click(function() {
    Camera();
  });

  $('#switch-screen').click(function() {
    Screen();
  });

  function setupCallEventHandlers(call) {
    if (existingCall) {
      existingCall.close();
    };
    existingCall = call;
    call.on('stream', function(stream) {});
    call.on('peerLeave', function(peerId) {});
    call.on('close', function() {});
  }

  peer = new Peer({
    key: '4852b666-0601-4aaf-b74c-1e099ce0860a',
    debug: 3
  });

  $('#send').click(()=>{
    const room = peer.joinRoom('fes2019', {
      mode: 'sfu',
      stream: localStream,
    });
    setupCallEventHandlers(room);
    $('#status').text("配信中");
  });

  $('#end').click(()=>{
    existingCall.close();
    $('#status').text("未配信");
  });

  peer.on('open', function() {
    $('#my-id').text(peer.id);
  });





});
