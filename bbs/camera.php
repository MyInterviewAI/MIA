<video autoplay="true"></video>

<style>
video {
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

p {
  color: red;
}
</style>

<script>
navigator.mediaDevices.getUserMedia({ video: true })
  .then(function (stream) {
  // Stream the camera feed to a video element on the page
  var videoElement = document.querySelector('video');
  videoElement.srcObject = stream;
})
  .catch(function (error) {
  alert(error)
  console.error('Error accessing the camera: ' + error);
});
</script>