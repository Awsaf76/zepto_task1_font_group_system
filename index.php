<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Font Group System (jQuery)</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style id="dynamic-fonts"></style>
</head>
<body class="bg-gray-100">
  <div class="container mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Upload Font (.ttf only)</h2>
    <form id="fontUploadForm" enctype="multipart/form-data">
      <input type="file" name="font_file" id="font_file" accept=".ttf" class="mb-4">
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Upload Font</button>
    </form>
    <div id="uploadResponse" class="my-4 text-green-600"></div>

    <h2 class="text-xl font-bold mt-6 mb-4">Uploaded Fonts</h2>
    <ul id="fontList" class="mb-6 border p-3 bg-gray-50"></ul>

    <h2 class="text-xl font-bold mb-4">Create Font Group</h2>
    <form id="fontGroupForm">
      <label for="font1" class="block">Select Font 1</label>
      <select name="font1" id="font1" class="mb-4 p-2 border w-full"></select>

      <label for="font2" class="block">Select Font 2</label>
      <select name="font2" id="font2" class="mb-4 p-2 border w-full"></select>

      <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Create Font Group</button>
    </form>
    <div id="groupResponse" class="my-4 text-green-600"></div>

    <h2 class="text-xl font-bold mt-6 mb-4">Font Groups</h2>
    <ul id="fontGroupsList" class="border p-3 bg-gray-50"></ul>
  </div>

<script>
function loadFonts() {
  $.getJSON("list_fonts.php", function(fonts) {
    $("#fontList").empty();
    $("#font1, #font2").empty().append("<option value=''>Select Font</option>");
    $("#dynamic-fonts").empty();

    fonts.forEach(function(font) {
      const fontUrl = `uploads/${font}`;
      const fontName = font.replace('.ttf', '');
      $("#dynamic-fonts").append(`@font-face { font-family: '${fontName}'; src: url('${fontUrl}'); }`);
      $("#fontList").append(
        `<li>
          <span>${font}</span>
          <button class='bg-red-500 text-white ml-4 px-2 py-1 rounded' onclick='deleteFont("${font}")'>Delete</button>
          <p style="font-family: '${fontName}'; font-size: 18px;">Preview: The quick brown fox jumps over the lazy dog</p>
        </li>`
      );
      $("#font1, #font2").append(`<option value="${font}">${font}</option>`);
    });
  });
}

function deleteFont(fontName) {
  $.ajax({
    url: "delete_font.php",
    method: "POST",
    contentType: "application/json",
    data: JSON.stringify({ fontName: fontName }),
    success: function(response) {
      $("#uploadResponse").text(response);
      loadFonts();
      deleteFontGroupsContaining(fontName);
    }
  });
}

function deleteFontGroupsContaining(fontName) {
  $.ajax({
    url: "delete_group_font.php",
    method: "POST",
    contentType: "application/json",
    data: JSON.stringify({ fontName: fontName }),
    success: function() {
      loadGroups();
    }
  });
}

function loadGroups() {
  $.get("fontGroups.php", function(html) {
    $("#fontGroupsList").html(html);
  });
}

$(document).ready(function() {
  loadFonts();
  loadGroups();

  $("#fontUploadForm").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      url: "upload.php",
      method: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function(data) {
        $("#uploadResponse").text(data);
        loadFonts();
      }
    });
  });

  $("#fontGroupForm").submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.post("fontGroups.php", formData, function() {
      loadGroups();
    });
  });
});
</script>
</body>
</html>
