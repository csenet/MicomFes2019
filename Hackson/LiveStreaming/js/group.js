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

  peer = new Peer({
    key: '4852b666-0601-4aaf-b74c-1e099ce0860a',
    debug: 3
  });

  peer.on('open', function() {
    $('#my-id').text(peer.id);
  });

  peer.on('error', function(err) {
    alert(err.message);
  });

  $('#make-call').submit(function(e) {
    e.preventDefault();
    let roomName = $('#join-room').val();
    if (!roomName) {
      return;
    }
    const call = peer.joinRoom(roomName, {
      mode: 'sfu',
      stream: localStream
    });
    setupCallEventHandlers(call);
  });

  $('#end-call').click(function() {
    existingCall.close();
  });

  function setupCallEventHandlers(call) {
    if (existingCall) {
      existingCall.close();
    }
      existingCall = call;
    setupEndCallUI();
    $('#room-id').text(call.name);

    call.on('stream', function(stream) {
      addVideo(stream);
    });

    call.on('peerLeave', function(peerId) {
      removeVideo(peerId);
    });

    call.on('close', function() {
      removeAllRemoteVideos();
      setupMakeCallUI();
    });
  }

  function addVideo(stream) {
    const videoDom = $('<video autoplay muted="true" playsinline>');
    videoDom.attr('id', stream.peerId);
    videoDom.get(0).srcObject = stream;
    $('.videosContainer').append(videoDom);
  }

  function removeVideo(peerId) {
    $('#' + peerId).remove();
  }

  function removeAllRemoteVideos() {
    $('.videosContainer').empty();
  }

  function setupMakeCallUI() {
    $('#make-call').show();
    $('#end-call').hide();
  }

  function setupEndCallUI() {
    $('#make-call').hide();
    $('#end-call').show();
  }

});
