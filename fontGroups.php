<?php
session_start();
if (!isset($_SESSION['groups'])) {
    $_SESSION['groups'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $font1 = $_POST['font1'];
    $font2 = $_POST['font2'];
    if (!empty($font1) && !empty($font2) && $font1 !== $font2) {
        $_SESSION['groups'][] = [$font1, $font2];
    }
}

foreach ($_SESSION['groups'] as $index => $group) {
    echo "<li>{$group[0]} & {$group[1]} 
            <button onclick='deleteGroup($index)' class='bg-red-500 text-white ml-4 px-2 py-1 rounded'>Delete Group</button>
          </li>";
}
?>

<script>
function deleteGroup(groupIndex) {
  fetch("delete_group.php", {
    method: "POST",
    body: JSON.stringify({ index: groupIndex }),
    headers: { "Content-Type": "application/json" }
  })
  .then(res => res.text())
  .then(response => {
    console.log(response);
    loadGroups(); // dynamic reload
  });
}
</script>
