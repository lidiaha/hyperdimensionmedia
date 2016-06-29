var emoted = "";
var mostrecentJS = false;
var mostrecentMySQL;

function dateconvert(mysqldate) {
  var t = mysqldate.split(/[- :]/);
  return new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
}

function addemote() {
  emoted = "kyubey";
  updateEmotePreview();
}

function updateEmotePreview() {
  $("#emotepreview").css("background-image", "url('emotes/" + emoted + ".png')");
  $("#emotepreview").css("background-position", "center center");
  $("#emotepreview").css("background-size", "contain");
}

function clearmsg() {
  $("#monogatari").val("");
  emoted = "";
  $("#emotepreview").css("background-image", "none");
}

function scrollBottom() {
  $("#content").animate({ scrollTop: $("#content").prop("scrollHeight") }, "slow");
}

function displayMessage(msg) {
  var emoteimg = "none";
  if (msg.emote != "") {
    emoteimg = "url('emotes/" + msg.emote + ".png');";
  }
  text = msg.message.replace(/\n/g,"<br>");
  if (emoteimg != "none") {
    $("#content").append("<div class='messageitem'>" +
    "<div class='msgemote' style=\"background-image: " + emoteimg + "; background-position: center center; background-size: contain;\"></div>" +
    "<div class='msgnotimg'><div class='msgname'>" + msg.user + "</div><div class='msgdate'>" + msg.time + "</div>" +
    "<div class='msgtext'>" + text + "</div>" +
    "</div></div>")
  } else {
    $("#content").append("<div class='messageitem'>" +
    "<div class='msgname'>" + msg.user + "</div><div class='msgdate'>" + msg.time + "</div>" +
    "<div class='msgtext'>" + text + "</div>" +
    "</div>")
  }
  scrollBottom();
}
function processMessage(msg) {
  if (mostrecentJS) {
    msgdate = dateconvert(msg.time);
    if (msgdate > mostrecentJS) {
      mostrecentJS = msgdate;
      mostrecentMySQL = msg.time;
      displayMessage(msg);
    }
  }
  else {
    mostrecentJS = dateconvert(msg.time);
    mostrecentMySQL = msg.time;
    displayMessage(msg);
  }
}

function sendmessage() {
  var username = $("#username").val();
  var message = $("#monogatari").val();
  $.post("controller/write.php", {
    user: username,
    message: message,
    emote: emoted
  }, function(data) {
    if (data != "ok") {
      alert(data);
    } else {
      clearmsg();
    }
  });
}

function updateOnce() {
  $.post("controller/read.php", function(data) {
    var newmessages = JSON.parse(data);
    newmessages.forEach(processMessage);
  });
}

function updateAgain() {
  $.post("controller/read.php", {
    after: mostrecentMySQL
  }, function(data) {
    var newmessages = JSON.parse(data);
    newmessages.forEach(processMessage);
  });
}

$(document).ready(function() {
  $("#username").val("User-" + Math.round(Math.random()*500));
  updateOnce();
  window.setInterval(updateAgain, 1000);
});
