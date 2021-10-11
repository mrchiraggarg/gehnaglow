<?php
if (isset($success)  && !empty($success) && !is_null($success)) echo
"<div id='message-bar' class='w-100 p-2 mb-3 text-center' style='border-radius:1rem;color:#000!important;background:#17a2b8!important'> $success  <span style='cursor:pointer;' onclick='messagehide();' id='close-message'>&times;</span></div>"
?>
<?php
if (isset($danger)  && !empty($danger) && !is_null($danger)) echo
"<div id='message-bar' class='w-100 p-2 mb-3 text-center' style='border-radius:1rem;color:#000!important;background:#dc3545!important'> $danger  <span style='cursor:pointer;' onclick='messagehide();' id='close-message'>&times;</span></div>"
?>
<script>
    function messagehide() {
        document.getElementById('message-bar').style.display = 'none';
    }
</script>