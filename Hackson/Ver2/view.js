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

  function setupCallEventHandlers(call) {
    if (existingCall) {
      existingCall.close();
    };
    existingCall = call;

    call.on('stream', stream => {
      addVideo(stream);
    });

    call.on('peerLeave', function(peerId) {
      removeVideo(peerId);
    });

    call.on('close', function() {
      removeAllRemoteVideos();
    });
  }

  function joinRoom(roomName) {
    const room = peer.joinRoom(roomName, {
      mode: 'sfu',
      videoReceiveEnabled : true,
    });
    setupCallEventHandlers(room);
  }

  peer = new Peer({
    key: '4852b666-0601-4aaf-b74c-1e099ce0860a',
    debug: 3
  });

  peer.on('open', function() {
    $('#my-id').text(peer.id);
    joinRoom('fes2019');
  });

  peer.on('error', error => {
    alert(error);
  });
});
