<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dark Mode Example</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  <style>
    :root {
      --background-color: #fff;
      --text-color: #000;
    }

    [data-theme="dark"] {
      --background-color: #121212;
      --text-color: #ffffff;
    }

    body {
      background-color: var(--background-color);
      color: var(--text-color);
    }

    .centered-container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
  </style>
</head>
<body><?php  echo form_open('scan/start'); ?>
  <div class="centered-container">
    <h1 class="title has-text-white">What would you like to hack today?</h1>
    <div class="field has-addons">
		
      <div class="control">
        <input class="input" type="text" name="url" placeholder="enter url here pls, thx" autofocus>
      </div>
      <div class="control">
        <input type="submit" class="button is-primary" value="Go"></input>
      </div>
    </div>
  </div></form>
</body>
</html>
