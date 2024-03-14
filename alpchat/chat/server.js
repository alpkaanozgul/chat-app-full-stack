// server.js

const express = require('express');
const { exec } = require('child_process');
const mysql = require('mysql');
const crypto = require('crypto');

const app = express();
const server = app.listen(3000);
const io = require('socket.io')(server);

app.use(express.static('public'));

// MySQL connection
const db = mysql.createConnection({
    host: '127.0.0.1',
    user: 'root',
    password: '',
    database: 'alpchat_chat'
});

db.connect((err) => {
    if (err) throw err;
    console.log('Connected to MySQL');
});

const encryptionKey = crypto.scryptSync('yourEncryptionKey', 'salt', 32); // 32 bytes key

function encrypt(text) {
    const iv = crypto.randomBytes(16); // Generate random IV
    const cipher = crypto.createCipheriv('aes-256-cbc', encryptionKey, iv);
    let encrypted = cipher.update(text);
    encrypted = Buffer.concat([encrypted, cipher.final()]);
    return iv.toString('hex') + ':' + encrypted.toString('hex');
}

// Function to decrypt data
function decrypt(text) {
    const parts = text.split(':');
    const iv = Buffer.from(parts.shift(), 'hex');
    const encryptedText = Buffer.from(parts.join(':'), 'hex');
    const decipher = crypto.createDecipheriv('aes-256-cbc', encryptionKey, iv);
    let decrypted = decipher.update(encryptedText);
    decrypted = Buffer.concat([decrypted, decipher.final()]);
    return decrypted.toString();
}

// Save message to database
function saveMessageToDB(data) {
    const { message, sender } = data;
    const encryptedMessage = encrypt(message); // Encrypt message before saving
    const encryptedSender = encrypt(sender); // Encrypt sender before saving
    const query = "INSERT INTO messages (sender, message) VALUES (?, ?)";
    db.query(query, [encryptedSender, encryptedMessage], (err, result) => {
        if (err) throw err;
        console.log("Message saved to database");
    });
}

function getMessagesFromDB(callback) {
    const query = "SELECT * FROM messages";
    db.query(query, (err, result) => {
        if (err) throw err;
        const decryptedMessages = result.map(row => ({
            sender: decrypt(row.sender), // Decrypt sender
            message: decrypt(row.message) // Decrypt message
        }));
        callback(decryptedMessages);
    });
}

io.on('connection', (socket) => {
    console.log(socket.id);

    socket.on('chat', (data) => {
        io.sockets.emit('chat', data); // Broadcast message to all clients
        saveMessageToDB(data); // Save message to database
    });

    socket.on('typing', (data) => {
        socket.broadcast.emit('typing', data);
    });

    // Retrieve messages from database when a user connects
    socket.on('requestInitialMessages', () => {
        getMessagesFromDB((messages) => {
            socket.emit('initialMessages', messages);
        });
    });
});
