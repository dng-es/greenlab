'use strict';

const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const snap = document.getElementById("snap");
const errorMsgElement = document.querySelector('span#errorMsg');

var width = 320,
	height = 240;

const constraints = {
  audio: false,
  video: {
	width: 1280, height: 720
  }
};

// Access webcam
async function init() {
  try {
	const stream = await navigator.mediaDevices.getUserMedia(constraints);
	handleSuccess(stream);
  } catch (e) {
	errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
  }
}

// Success
function handleSuccess(stream) {
  window.stream = stream;
  video.srcObject = stream;
}

// Load init
init();

// Draw image
var context = canvas.getContext('2d');
snap.addEventListener("click", function() {
	canvas.width = width;
	canvas.height = height;
	context.drawImage(video, 0, 0, width, height);
});

snapNew.addEventListener("click", function() {
	var container = document.getElementsByClassName('video-wrap');
	$(container).show();
	const context = canvas.getContext('2d');
	context.clearRect(0, 0, canvas.width, canvas.height);
});

function b64toBlob(b64Data, contentType, sliceSize) {
	contentType = contentType || '';
	sliceSize = sliceSize || 512;

	var byteCharacters = atob(b64Data);
	var byteArrays = [];

	for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
		var slice = byteCharacters.slice(offset, offset + sliceSize);

		var byteNumbers = new Array(slice.length);
		for (var i = 0; i < slice.length; i++) {
			byteNumbers[i] = slice.charCodeAt(i);
		}

		var byteArray = new Uint8Array(byteNumbers);

		byteArrays.push(byteArray);
	}

  var blob = new Blob(byteArrays, {type: contentType});
  return blob;
}

