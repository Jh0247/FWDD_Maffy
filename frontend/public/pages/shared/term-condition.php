<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../src/stylesheets/shared/feedback.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/775f0ea71b.js" crossorigin="anonymous"></script>
  <title>Term & Condition</title>
</head>
<body>
  <div class="w-screen h-screen flex flex-row">
    <?php include '../shared/navbar.php';?>
    <div class="w-full overflow-auto">
      <div class="flex flex-col h-fit mx-6 sm:mx-12 text-left">
        <p class="term h-1/6 my-20 md:my-20 ml-3">Term & Condition</p>
        <div class="term-container">
        <?php
          $filePath = "../../term_condition/terms_condition.txt";

          $fileContents = file_get_contents($filePath);

          if ($fileContents !== false) {
              // Display the file contents
              echo nl2br($fileContents);
          } else {
              // Error occurred while reading the file
              echo 'Failed to read the file.';
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>