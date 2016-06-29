<html>
  <head>
    <title>Live chat!</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="clientlogic.js"></script>
    <link rel="stylesheet" type="text/css" href="chat.css">
  </head>
  <body>
    <div id="titlebar">Welcome to the interwebs, <input type="textbox" id="username">! Have fun chatting with yourself.</div>
    <div id="content"></div>
    <div id="bottom">
      <div class="emotebox" id="emotepreview"></div>
      <textarea id="monogatari" rows="7" cols="150"></textarea>
      <div class="buttonbox">
        <button onclick="addemote()">Emote</button><br>
        <button onclick="clearmsg()">Never mind</button><br>
        <button onclick="sendmessage()">Fire!</button><br>
      </div>
    </div>
  </body>
</html>
