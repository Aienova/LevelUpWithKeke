// Server-side code (Node.js with Express)

const express = require('express');
const app = express();
const port = 5000;

// Dummy data or database connection here

app.get('/api/data', (req, res) => {
  // Fetch data from the database or provide dummy data
  const data = [
    { id: 1, name: 'Item 1' },
    { id: 2, name: 'Item 2' },
    // ...
  ];

  res.json(data);
});

app.listen(port, () => {
  console.log(`Server is running on http://localhost:${port}`);
});