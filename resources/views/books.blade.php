<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>รายละเอียดหนังสือ</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/4.2.0/mustache.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="book-details">
      </div>
  </div>

  <script>
    const book = {
      // Your book data here
      title: "The Lord of the Rings",
      author: "J.R.R. Tolkien",
      // ... other book properties
    };

    const template = document.getElementById("book-template").innerHTML;
    const renderedHtml = Mustache.render(template, book);

    // Assuming you have an element with ID "book-details"
    document.getElementById("book-details").innerHTML = renderedHtml;
  </script>

  <template id="book-template">
    <h1>{{ The Lord of the Rings }}</h1>
    <h2>By {{ author }}</h2>
    </template>
</body>
</html>
