<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>

    <style>
    .content{
      width: 50%;
      padding: 5px;
      margin: 0 auto;
    }
    .content span{
      width: 250px;
    }
    .dz-message{
      text-align: center;
      font-size: 28px;
    }
    </style>
    <script>
    // Add restrictions
    Dropzone.options.fileupload = {
      acceptedFiles: 'image/*',
      maxFilesize: 10 // MB
    };
    </script>


    <div class='content'>
      <!-- Dropzone -->
      <form action="<?= base_url('index.php/Annonce/fileupload') ?>" class="dropzone" id="fileupload">
      </form> 
    </div> 
