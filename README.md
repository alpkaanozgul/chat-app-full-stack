<br/>
<p align="center">
  <a href="https://github.com/alpkaanozgul/chat-app-full-stack">
    
  </a>

  <h3 align="center">AlpChat</h3>

  <p align="center">
   AlpChat: Real-time chat with strong encryption and password hashing.
    <br/>
    <br/>
    <a href="https://github.com/alpkaanozgul/chat-app-full-stack/issues">Report Bug</a>
    .
    <a href="https://github.com/alpkaanozgul/chat-app-full-stack/issues">Request Feature</a>
  </p>
</p>

![Downloads](https://img.shields.io/github/downloads/alpkaanozgul/chat-app-full-stack/total) ![Contributors](https://img.shields.io/github/contributors/alpkaanozgul/chat-app-full-stack?color=dark-green) ![Issues](https://img.shields.io/github/issues/alpkaanozgul/chat-app-full-stack) ![License](https://img.shields.io/github/license/alpkaanozgul/chat-app-full-stack) 

## About The Project

![Screen Shot](https://i.ibb.co/NZqSZWk/Ekran-g-r-nt-s-2024-03-14-013544.png)
![Screen Shot](https://i.ibb.co/hWZ5qs0/Ekran-g-r-nt-s-2024-03-14-013750.png)
![Screen Shot](https://i.ibb.co/ns53ZJj/Ekran-g-r-nt-s-2024-03-14-013718.png)
![Screen Shot](https://i.ibb.co/VqkCxnv/Ekran-g-r-nt-s-2024-03-14-013810.png)
![Screen Shot](https://i.ibb.co/vLbpfPf/Ekran-g-r-nt-s-2024-03-14-014007.png)

## AlpChat: Secure Messaging Platform

AlpChat is a web-based chat application that allows users to communicate with each other in real-time. It provides features for user registration, login, and sending messages securely. The application is built using HTML, CSS, JavaScript for the frontend, PHP for server-side scripting, MySQL for database management, and Socket.IO for real-time communication.

### Features

- **User Registration:** Users can register for an account by providing a username, email, and password. Upon registration, an email verification link is sent to the provided email address for authentication.

- **User Login:** Registered users can log in to their accounts using their email and password.

- **Real-time Chat:** Once logged in, users can access the chat interface where they can send and receive messages in real-time.

- **Secure Messaging:** Messages sent between users are encrypted using AES-256 encryption to ensure privacy and security.

### Encryption and Hashing

In addition to AES-256 encryption for secure messaging, AlpChat employs hashing techniques to enhance the security of user passwords stored in the database.

- **Hashing Encryption:** AlpChat uses the bcrypt hashing algorithm to securely hash user passwords before storing them in the database. Bcrypt is a widely used and trusted algorithm known for its resistance to brute-force attacks and its ability to adaptively adjust its computational cost, making it suitable for secure password storage.

- **AES-256 Encryption:** Messages exchanged between users are encrypted using the AES-256 symmetric encryption algorithm. AES (Advanced Encryption Standard) is a widely adopted encryption standard known for its security and efficiency. AES-256 refers to the key size used in the encryption process, indicating the level of security provided.

### Technologies Used

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **Real-time Communication:** Socket.IO
- **Encryption:** AES-256
- **Hashing:** Bcrypt

### Database Security and IP Logs

AlpChat ensures database security by implementing best practices for data storage and access control. Additionally, the application logs IP addresses for security and audit purposes, helping to track and prevent unauthorized access to user accounts and messages.

