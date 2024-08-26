// server.js
const express = require('express');
const bodyParser = require('body-parser');
const fs = require('fs');

const app = express();
const PORT = 8080;

app.use(bodyParser.json());

// In-memory store (for simplicity, consider using a database like MongoDB for production)
let messages = [];

// Load messages from a file on server start (optional)
if (fs.existsSync('messages.json')) {
    messages = JSON.parse(fs.readFileSync('messages.json', 'utf8'));
}

// API to get messages
app.get('/api/get-messages', (req, res) => {
    res.json({ messages });
});

// API to post a new message
app.post('/api/post-message', (req, res) => {
    const { message } = req.body;
    if (message) {
        messages.push(message);

        // Save messages to a file (optional)
        fs.writeFileSync('messages.json', JSON.stringify(messages, null, 2));

        res.status(201).send('Message added.');
    } else {
        res.status(400).send('Message content is missing.');
    }
});

// Serve static files
app.use(express.static('public'));

app.listen(PORT, () => {
    console.log(`Server running on http://localhost:${PORT}`);
});